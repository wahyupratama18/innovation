<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Report;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TellerRangeRequest;
use Illuminate\Http\JsonResponse;
use Inertia\{Inertia, Response};

class TellerReportController extends Controller
{
    use Report;

    public function index(): Response
    {
        return Inertia::render('Admin/Report');
    }

    public function range(TellerRangeRequest $request): JsonResponse
    {
        $request->validated();

        return response()->json([
            'debits' => $this->rangeQuery(1, $request->from, $request->to),
            'credits' => $this->rangeQuery(0, $request->from, $request->to),
        ]);
    }

}
