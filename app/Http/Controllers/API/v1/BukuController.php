<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Buku;
use App\Http\Controllers\Controller;
use App\Http\Resources\BukuEditResource;
use App\Http\Resources\BukuShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BukuController extends Controller implements APIInterface
{
    /**
     * Show the details of a specific product.
     */
    public function show(int $id): JsonResponse
    {
        $produk = Buku::where('id', $id)->firstOrFail();
        $resource = new BukuShowResource($produk);

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
        $produk = Buku::where('id', $id)->firstOrFail();
        $resource = new BukuEditResource($produk);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $resource
        ]);
    }
}
