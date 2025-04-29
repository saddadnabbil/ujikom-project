<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\DetailFaktur;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DetailFakturController extends Controller implements APIInterface
{
    /**
     * Show the details of a specific DetailFaktur.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $detailFaktur = DetailFaktur::with(['faktur', 'produk'])->findOrFail($id);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => [
                'id' => $detailFaktur->id,
                'faktur_id' => $detailFaktur->faktur_id,
                'produk' => $detailFaktur->produk->nama_produk ?? '-',
                'jumlah' => $detailFaktur->jumlah,
                'harga_satuan' => $detailFaktur->harga_satuan,
                'subtotal' => $detailFaktur->subtotal,
            ],
        ]);
    }

    /**
     * Edit the details of a specific DetailFaktur.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $detailFaktur = DetailFaktur::with(['faktur', 'produk'])->findOrFail($id);

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => [
                'id' => $detailFaktur->id,
                'faktur_id' => $detailFaktur->faktur_id,
                'produk_id' => $detailFaktur->produk_id,
                'jumlah' => $detailFaktur->jumlah,
                'harga_satuan' => $detailFaktur->harga_satuan,
                'subtotal' => $detailFaktur->subtotal,
            ],
        ]);
    }
}
