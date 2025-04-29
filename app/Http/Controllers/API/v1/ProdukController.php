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
     */
    public function show(int $id): JsonResponse
    {
        $produk = Produk::where('id_produk', $id)->firstOrFail();
        $resource = new ProdukShowResource($produk);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $resource
        ]);
    }

    /**
     * Edit the details of a specific product.
     */
    public function edit(int $id): JsonResponse
    {
        $produk = Produk::where('id_produk', $id)->firstOrFail();
        $resource = new ProdukEditResource($produk);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $resource
        ]);
    }
}
