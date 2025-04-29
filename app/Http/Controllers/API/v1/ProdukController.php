<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Produk;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukEditResource;
use App\Http\Resources\ProdukShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProdukController extends Controller implements APIInterface
{
    /**
     * Show the details of a specific product.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $produk = new ProdukShowResource(Produk::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $produk
        ]);
    }

    /**
     * Edit the details of a specific product.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $produk = new ProdukEditResource(Produk::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $produk
        ]);
    }
}
