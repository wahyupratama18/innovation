<?php

namespace App\Http\Controllers;

use App\Actions\Admin\Report;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};

class DashboardController extends Controller
{
    use Report;

    public function index(): Response
    {
        switch (Auth::user()->role) {
            case 1:
                return $this->admin();
                break;
            
            case 2:
                return $this->teller();
                break;
            default:
                return $this->user();
                break;
        }
    }
    
    private function admin(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'debits' => $this->dashboard(1),
            'credits' => $this->dashboard(0),
        ]);
    }

    public function teller(): Response
    {
        $debits = $this->managedByTeller(1);
        $credits = $this->managedByTeller(0);

        return Inertia::render('Teller/Dashboard', [
            'debits' => (object) [
                'flow' => $debits->pluck('mount'),
                'date' => $debits->pluck('date')
            ],
            'credits' => (object) [
                'flow' => $credits->pluck('mount'),
                'date' => $credits->pluck('date')
            ],
        ]);
    }

    public function user(): Response
    {
        $account = Auth::user()->account;
        $reports = $this->userReport($account);

        return Inertia::render('User/Dashboard', [
            'balance' => $account->balance,
            'graph' => $reports->pluck('balance'),
            'date' => $reports->pluck('updated_at')->map(fn($item) => $item->format('m/d/Y H:i'))
        ]);
    }
}
