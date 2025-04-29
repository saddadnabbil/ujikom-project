<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\DashboardChartExpenditureRepository;

class DashboardChartExpenditureController extends Controller
{
    public function __construct(
        private DashboardChartExpenditureRepository $dashboardChartRepository,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $data = $this->dashboardChartRepository->sumCashTransactionExpenditurePerMonths();

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $data
        ]);
    }
}
