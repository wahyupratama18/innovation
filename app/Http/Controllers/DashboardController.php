<?php

namespace App\Http\Controllers;

use App\Actions\Admin\Report;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};

class DashboardController extends Controller
{
    use Report;

    public function index(): Response
    {
        return match(Auth::user()->role) {
            1 => $this->admin(),
            2 => $this->teller(),
            default => $this->user()
        };
    }
    
    private function admin(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'debits' => $this->dashboard(1),
            'credits' => $this->dashboard(0),
            'users' => [
                ['role' => 'Siswa', 'count' => User::where('role', 3)->count()],
                ['role' => 'Organisasi / Merchant', 'count' => User::where('role', 4)->count()]
            ],
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

        return Inertia::render('User/Dashboard', [
            'balance' => $account->balance_format,
            'graph' => $this->userReport($account)
        ]);
    }
}
