<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Denda;
use App\Http\Controllers\Controller;
use App\Http\Resources\DendaEditResource;
use App\Http\Resources\DendaShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DendaController extends Controller implements APIInterface
{
    /**
     * Show the details of a specific product.
     */
    public function show(int $id): JsonResponse
    {
        $kategori = Denda::where('id', $id)->firstOrFail();
        $resource = new DendaShowResource($kategori);

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
        $kategori = Denda::where('id', $id)->firstOrFail();
        $resource = new DendaEditResource($kategori);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $resource
        ]);
    }
}
