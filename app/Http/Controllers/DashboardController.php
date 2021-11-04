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

        return Inertia::render('Teller/Dashboard', [
            'debits' => $this->managedByTeller(1),
            'credits' => $this->managedByTeller(0),
        ]);
    }

    public function user(): Response
    {
        $account = Auth::user()->account;
        $reports = $this->userReport($account);

        return Inertia::render('User/Dashboard', [
            'balance' => $account->balance_format,
            'graph' => $this->userReport($account)
        ]);
    }
}
