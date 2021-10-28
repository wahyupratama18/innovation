<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Report;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TellerRangeRequest;
use Carbon\Carbon;
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

        $to = Carbon::parse($request->to)->addDay()->toDateString();

        return response()->json([
            'debits' => $this->toChart(
                $this->rangeQuery(1, $request->from, $to)
            ),
            'credits' => $this->toChart(
                $this->rangeQuery(0, $request->from, $to)
            ),
        ]);
    }

}
