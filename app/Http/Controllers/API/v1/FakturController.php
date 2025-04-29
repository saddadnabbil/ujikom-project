<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Faktur;
use App\Http\Controllers\Controller;
use App\Http\Resources\FakturShowResource;
use App\Http\Resources\FakturEditResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FakturController extends Controller implements APIInterface
{
    /**
     * Show the details of a specific invoice.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $faktur = Faktur::with(['customer', 'perusahaan'])->findOrFail($id);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => [
                'id' => $faktur->id,
                'customer' => $faktur->customer->nama_customer ?? '-',
                'perusahaan' => $faktur->perusahaan->nama_perusahaan ?? '-',
                'tanggal_faktur' => $faktur->tanggal_faktur,
                'total' => $faktur->total,
            ],
        ]);
    }

    /**
     * Edit the details of a specific invoice.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $faktur = Faktur::with(['customer', 'perusahaan'])->findOrFail($id);
        $fakturResource = new FakturEditResource($faktur);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $fakturResource,
        ]);
    }
}
