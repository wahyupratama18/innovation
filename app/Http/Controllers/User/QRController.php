<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};

class QRController extends Controller
{
    public function index(): Response
    {
        $account = Account::select('id')->where('user_id', Auth::id())->first();

        return Inertia::render('User/QR', [
            'id' => $account->id,
            'qr' => $account->qr
        ]);
    }
}
