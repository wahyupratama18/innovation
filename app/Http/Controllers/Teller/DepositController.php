<?php

namespace App\Http\Controllers\Teller;

use App\Actions\Tellers\FindMutation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teller\StoreDepositRequest;
use App\Models\Mutation;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use Inertia\{Inertia, Response};

class DepositController extends Controller
{
    use FindMutation;

    public function index(): Response
    {
        return Inertia::render('Teller/Deposit/Index');
    }

    public function store(StoreDepositRequest $request): RedirectResponse
    {
        $mutation = DB::transaction(function () use ($request) {
            return Mutation::create(
                array_merge($request->validated(), [
                    'name' => 'Setoran Tunai',
                    'type' => 0,
                    'user_id' => Auth::id(),
                ])
            );

        });

        return redirect()->route('deposit.show', ['deposit' => $mutation->reference]);
    }

    public function show($deposit): Response
    {
        $mutation = $this->finder($deposit);
        
        $this->authorize('viewDeposit', $mutation);

        return Inertia::render('Teller/Deposit/Show', [
            'amount' => $mutation->amount_format,
            'name' => $mutation->account->user->name,
            'date' => $mutation->updated_at->translatedFormat('j F Y H:i'),
            'qr' => $mutation->qr
        ]);
    }
}
