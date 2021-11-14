<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};

class QRController extends Controller
{
    public function index(): Response
    {
        $user = User::with('account:id,user_id')->find(Auth::id());

        return Inertia::render('User/QR', [
            'id' => $user->account->id,
            'qr' => $user->account->qr
        ]);
    }
}
