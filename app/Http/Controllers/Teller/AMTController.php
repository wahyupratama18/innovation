<?php

namespace App\Http\Controllers\Teller;

use App\Actions\Tellers\FindMutation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teller\{StoreAMTRequest, UpdateAMTRequest};
use App\Models\Mutation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{Auth, DB};
use Inertia\{Inertia, Response};

class AMTController extends Controller
{
    use FindMutation;

    public function index(): Response
    {
        return Inertia::render('Teller/AMT/Index');
    }

    public function store(StoreAMTRequest $request): RedirectResponse
    {
        $mutation = DB::transaction(function () use ($request) {          

            return Mutation::create(
                array_merge($request->validated(), [
                    'name' => 'Tarik Tunai',
                    'type' => 1,
                    'user_id' => Auth::id()
                ])
            );

        });

        return redirect()->route('amt.show', ['amt' => $mutation->reference]);
    }

    public function show($amt): Response
    {
        $mutation = $this->finder($amt);

        $this->authorize('viewAMT', $mutation);

        return Inertia::render('Teller/AMT/Show', [
            'amount' => $mutation->amount_format,
            'name' => $mutation->account->user->name,
            'date' => $mutation->updated_at->translatedFormat('j F Y H:i'),
            'qr' => $mutation->qr
        ]);
    }

    public function update(UpdateAMTRequest $request, Mutation $amt): RedirectResponse
    {
        DB::transaction(function () use ($request, $amt) {

            $request->validated();
    
            $amt->update([
                'status' => 1,
                'user_id' => Auth::id()
            ]);
        });

        return redirect()->route('amt.show', ['amt' => $amt->reference]);
    }
}
