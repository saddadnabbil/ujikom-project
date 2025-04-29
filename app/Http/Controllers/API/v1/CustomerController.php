<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Customer;
use App\Models\DetailFaktur;
use App\Contracts\APIInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerEditResource;
use App\Http\Resources\CustomerShowResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\DetailFakturEditResource;
use App\Http\Resources\DetailFakturShowResource;

class CustomerController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $detailFaktur = DetailFaktur::with(['faktur', 'produk'])->findOrFail($id);
        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => new DetailFakturShowResource($detailFaktur),
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $detailFaktur = DetailFaktur::with(['faktur', 'produk'])->findOrFail($id);
        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => new DetailFakturEditResource($detailFaktur),
        ]);
    }
}
