<?php

namespace App\Http\Controllers\Teller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teller\{StoreAMTRequest, UpdateAMTRequest};
use App\Models\{Account, Mutation};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use Inertia\{Inertia, Response};

class AMTController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Teller/AMT');
    }

    public function store(StoreAMTRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {          

            Mutation::create(
                array_merge($request->validated(), [
                    'name' => 'Tarik Tunai',
                    'type' => 1,
                    'user_id' => Auth::id()
                ])
            );

        });

        return redirect()->route('amt.index');
    }

    public function update(UpdateAMTRequest $request, Mutation $amt): RedirectResponse
    {
        DB::transaction(function () use ($request, $amt) {

            $request->validated();
    
            $amt->update(['status' => 1]);
        });

        return redirect()->route('amt.index');
    }
}
