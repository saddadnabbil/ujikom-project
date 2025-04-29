<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Perusahaan;
use App\Http\Controllers\Controller;
use App\Http\Resources\PerusahaanEditResource;
use App\Http\Resources\PerusahaanShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PerusahaanController extends Controller implements APIInterface
{
    /**
     * Show the details of a specific company.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $perusahaan = new PerusahaanShowResource(Perusahaan::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $perusahaan
        ]);
    }

    /**
     * Edit the details of a specific company.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $perusahaan = new PerusahaanEditResource(Perusahaan::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $perusahaan
        ]);
    }
}
