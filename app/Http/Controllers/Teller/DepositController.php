<?php

namespace App\Http\Controllers\Teller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teller\StoreDepositRequest;
use App\Models\Mutation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use Inertia\{Inertia, Response};

class DepositController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Teller/Deposit');
    }

    public function store(StoreDepositRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            Mutation::create(
                array_merge($request->validated(), [
                    'name' => 'Setoran Tunai',
                    'type' => 0,
                    'user_id' => Auth::id(),
                ])
            );

        });

        return redirect()->route('deposit.index');
    }
}
