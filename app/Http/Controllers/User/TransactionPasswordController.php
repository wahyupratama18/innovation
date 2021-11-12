<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreTransactionPasswordRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\{Inertia, Response};

class TransactionPasswordController extends Controller
{
    private function rendering(array $data): Response
    {
        return Inertia::render('Profile/Overlay', $data);
    }

    public function index(): Response
    {
        return $this->rendering([
            'alreadyHave' => auth()->user()->account->transaction_password ? true : false,
            'title' => 'Perbarui Kata Sandi Transaksi',
            'view' => 'transaction',
        ]);
    }

    public function store(StoreTransactionPasswordRequest $request)
    {
        $valid = $request->validated();

        Account::where('user_id', auth()->id())
        ->first()->updatePass($valid['password']);

        return back()->with('status', 'Update success!');
    }
}
