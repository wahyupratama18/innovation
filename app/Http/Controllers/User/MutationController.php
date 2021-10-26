<?php

namespace App\Http\Controllers\User;

use App\Actions\Admin\Report;
use App\Http\Controllers\Controller;
use App\Models\Mutation;
use Illuminate\Http\Request;
use Inertia\{Inertia, Response};

class MutationController extends Controller
{
    use Report;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return Inertia::render('User/Mutation/Index', [
            /* 'mutations' => Mutation::where('account_id', auth()->user()->account->id)
            ->where('updated_at') */
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function show(Mutation $mutation): Response
    {
        return Inertia::render('User/Mutation/Show', [
            'mutation' => $mutation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function edit(Mutation $mutation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mutation $mutation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mutation $mutation)
    {
        //
    }
}
