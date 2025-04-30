<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Peminjaman;
use App\Http\Controllers\Controller;
use App\Http\Resources\PeminjamanEditResource;
use App\Http\Resources\PeminjamanShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PeminjamanController extends Controller implements APIInterface
{
    /**
     * Show the details of a specific product.
     */
    public function show(int $id): JsonResponse
    {
        $kategori = Peminjaman::where('id', $id)->firstOrFail();
        $resource = new PeminjamanShowResource($kategori);

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
        $kategori = Peminjaman::where('id', $id)->firstOrFail();
        $resource = new PeminjamanEditResource($kategori);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $resource
        ]);
    }
}
