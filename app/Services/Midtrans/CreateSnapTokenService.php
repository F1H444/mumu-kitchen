<?php

namespace App\Services\Midtrans;

use App\Models\Pesanan;


use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $pembayaran;

    public function __construct($pembayaran)
    {
        parent::__construct();

        $this->pembayaran = $pembayaran;
    }

    public function getSnapToken()
    {
        $pesanans = pesanan::with(['produk'])->where('pembayaran_id', $this->pembayaran->id)->get();
        $item_details = [];
        foreach ($pesanans as $item) {
            $item_details[] = [
                'id' => $item->uuid,
                'price' => $item->produk->harga,
                'quantity' => $item->kuantitas,
                'name' => $item->produk->nama_produk
            ];
        }
        $item_details[] = [
            'id' => $this->pembayaran->pengiriman->id,
            'price' => $this->pembayaran->pengiriman->harga_ongkir,
            'name' => 'Ongkir',
            'quantity' => 1
        ];
        $params = [
            'transaction_details' => [
                'order_id' => $this->pembayaran->uuid,
                'gross_amount' => $this->pembayaran->total_harga,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
