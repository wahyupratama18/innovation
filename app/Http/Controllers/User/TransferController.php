<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreTransferRequest;
use App\Models\{Account, Mutation, User};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\{Inertia, Response};

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return Inertia::render('User/Transfer/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Account $account): Response
    {
        return Inertia::render('User/Transfer/Create', [
            'account' => $account->id,
            'user' => $account->user->name
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferRequest $request): RedirectResponse
    {
        $mutation = DB::transaction(function () use ($request) {
            $sender = User::with('account:id,user_id')->find(auth()->id());
            $receiver = Account::with('user')->find($request->account_id);

            Mutation::create(
                array_merge($request->validated(), [
                    'name' => 'Terima uang dari '.$sender->name.'('.$sender->account->id.')',
                    'type' => 0
                ])
            );

            return Mutation::create([
                'account_id' => $sender->account->id,
                'name' => 'Kirim uang ke '.$receiver->user->name.'('.$request->account_id.')',
                'type' => 1,
                'amount' => $request->amount
            ]);
        });

        return redirect()->route('mutations.show', ['mutation' => $mutation->reference]);
    }

    public function scan(): Response
    {
        return Inertia::render('User/Transfer/Scan');
    }

    public function accounts(): Response
    {
        return Inertia::render('User/Transfer/Accounts');
    }

}
