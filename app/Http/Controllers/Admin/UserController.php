<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Models\{Account, Department, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Hash};
use Inertia\{Inertia, Response};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return Inertia::render('Admin/User/Index', [
            'users' => User::select('id', 'name')
            ->siswa()
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
        return Inertia::render('Admin/User/Create', [
            'angkatans' => collect(range(2019, date('Y')))
            ->map(fn($item) => ['id' => substr($item, 2, 2), 'text' => $item]),
            'departments' => Department::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            
            $user = User::create(
                array_merge($request->validated(), [
                    'password' => Hash::make($request->password)
                ])
            );
    
            Account::create([
                'id' => str_pad($request->angkatan, 2, "0", STR_PAD_LEFT)
                .str_pad($request->department, 2, "0", STR_PAD_LEFT)
                .random_int(100000,999999),
                'user_id' => $user->id,
                'transaction_password' => ''
            ]);
        });

        return redirect()->route('users.index');
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
        $this->authorize('delete', $user);

        $user->account->delete();
        $user->delete();
        
        return redirect()->route('users.index');
    }
}
