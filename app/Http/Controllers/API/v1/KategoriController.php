<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Kategori;
use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriEditResource;
use App\Http\Resources\KategoriShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class KategoriController extends Controller implements APIInterface
{
    /**
     * Show the details of a specific product.
     */
    public function show(int $id): JsonResponse
    {
        $kategori = Kategori::where('id', $id)->firstOrFail();
        $resource = new KategoriShowResource($kategori);

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
        $kategori = Kategori::where('id', $id)->firstOrFail();
        $resource = new KategoriEditResource($kategori);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $resource
        ]);
    }
}
