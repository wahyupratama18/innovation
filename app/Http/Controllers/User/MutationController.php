<?php

namespace App\Http\Controllers\User;

use App\Actions\Admin\Report;
use App\Actions\Tellers\FindMutation;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ValidateMutationHistoryRequest;
use App\Models\Mutation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\{Inertia, Response};

class MutationController extends Controller
{
    use FindMutation, Report;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return Inertia::render('User/Mutation/Index', [
            'periods' => [
                'latest' => 'Transaksi Terakhir',
                'week' => '1 Pekan',
                'month' => '1 Bulan'
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateMutationHistoryRequest $request): JsonResponse
    {
        return response()->json('10-4');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function show(int $mutation): Response
    {
        $mutation = $this->finder($mutation);

        $this->authorize('view', $mutation);

        return Inertia::render('User/Mutation/Show', [
            'mutation' => $mutation->only(['name', 'type_read', 'reference', 'amount', 'qr'])
        ]);
    }
}
