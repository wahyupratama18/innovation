<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\{StoreTellerRequest, UpdateTellerRequest};
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\{Inertia, Response};

class TellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Teller/Index', [
            'tellers' => User::select('id', 'name')
            ->where('role', 2)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Teller/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTellerRequest $request)
    {
        User::create(
            array_merge($request->validated(), [
                'role' => 2,
                'password' => Hash::make($request->password)
            ])
        );

        return redirect()->route('tellers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $teller): Response
    {
        $this->authorize('teller', $teller);
        
        return Inertia::render('Admin/Teller/Show', [
            'teller' => $teller
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $teller): Response
    {
        $this->authorize('teller', $teller);

        return Inertia::render('Admin/Teller/Edit', [
            'teller' => (object) [
                'id' => $teller->id,
                'name' => $teller->name,
                'email' => $teller->email,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTellerRequest $request, User $teller)
    {
        $teller->update(
            array_merge($request->validated(), ['password' => Hash::make($request->password)])
        );
        
        return redirect()->route('tellers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teller)
    {
        $this->authorize('delete', $teller);

        $teller->delete();

        return redirect()->route('tellers.index');
    }
}
