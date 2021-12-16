<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMerchantRequest;
use App\Models\{Account, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Hash};
use Inertia\{Inertia, Response};

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Merchants/Index', [
            'merchants' => User::select('id', 'name')
            ->merchant()
            ->with('account')->get()
            ->map(fn($user) => (object) [
                'id' => $user->id,
                'name' => $user->name,
                'account' => $user->account->id
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Merchants/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMerchantRequest $request)
    {
        DB::transaction(function () use ($request) {
            
            $user = User::create(
                array_merge($request->validated(), [
                    'password' => Hash::make($request->password),
                    'role' => 4
                ])
            );
    
            Account::create([
                'id' => "0000".random_int(100000,999999),
                'user_id' => $user->id,
                'transaction_password' => ''
            ]);
        });

        return redirect()->route('merchants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('deleteMerchant', $user);

        $user->account->delete();
        $user->delete();
        
        return redirect()->route('merchants.index');
    }
}
