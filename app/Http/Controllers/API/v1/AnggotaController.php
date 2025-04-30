<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Anggota;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnggotaEditResource;
use App\Http\Resources\AnggotaShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AnggotaController extends Controller implements APIInterface
{
    /**
     * Show the details of a specific product.
     */
    public function show(int $id): JsonResponse
    {
        $anggota = Anggota::where('id', $id)->firstOrFail();
        $resource = new AnggotaShowResource($anggota);

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
        $anggota = Anggota::where('id', $id)->firstOrFail();
        $resource = new AnggotaEditResource($anggota);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $resource
        ]);
    }
}
