<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Withdrawing;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreWithdrawRequest;
use App\Models\Mutation;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\DB;
use Inertia\{Inertia, Response};

class WithdrawController extends Controller
{
    use Withdrawing;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
        return Inertia::render('User/Withdraw/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWithdrawRequest $request): RedirectResponse
    {
        return DB::transaction(function () use ($request) {
            Mutation::create(
                array_merge($request->validated(), [
                    'account_id' => auth()->user()->account->id,
                    'name' => 'Tarik Tunai',
                    'type' => 1,
                    'status' => 0
                ])
            );

            return redirect()->route('withdraw.show');
        });

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $mutation = $this->existing(auth()->user());

        return Inertia::render('User/Withdraw/Show', [
            'id' => $mutation->reference,
            'qr' => $mutation->qr
        ]);
    }

}
