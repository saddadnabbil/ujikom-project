<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Faktur;
use App\Http\Controllers\Controller;
use App\Http\Resources\FakturEditResource;
use App\Http\Resources\FakturShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FakturController extends Controller implements APIInterface
{
    /**
     * Show the basic details of a specific invoice.
     */
    public function show(int $id): JsonResponse
    {
        $faktur = new FakturShowResource(Faktur::findOrFail($id));
        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $faktur
        ]);
    }

    /**
     * Provide all necessary data to edit the invoice (faktur).
     */
    public function edit(int $id): JsonResponse
    {
        $faktur = new FakturEditResource(Faktur::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $faktur
        ]);
    }
}
