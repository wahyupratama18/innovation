<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\JsonResponse;

class FindAccountController extends Controller
{
    public function index(Account $account): JsonResponse
    {
        return response()->json([
            'id' => $account->id,
            'name' => $account->user->name
        ]);
    }
}
