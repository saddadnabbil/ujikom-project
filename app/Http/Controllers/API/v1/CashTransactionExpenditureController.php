<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\CashTransactionExpenditure;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CashTransactionExpenditureEditResource;
use App\Http\Resources\CashTransactionExpenditureShowResource;

class CashTransactionExpenditureController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $cash_transaction_expenditures = new CashTransactionExpenditureShowResource(CashTransactionExpenditure::with('users:id,name')->findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $cash_transaction_expenditures
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $cash_transaction_expenditures = new CashTransactionExpenditureEditResource(CashTransactionExpenditure::with('users:id,name')->findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $cash_transaction_expenditures
        ]);
    }
}
