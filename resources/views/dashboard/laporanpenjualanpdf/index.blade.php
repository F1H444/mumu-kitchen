<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan {{ auth()->user()->nm_user }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.4;
        }

        table {
            width: 100%;
        }

        table.main td {
            padding: 0.25rem 0.5rem;
            vertical-align: start;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body>


    {{-- <div>{{ $setting->nm_perusahaan }}</div> --}}

    {{-- <div style="margin-bottom: 3rem">
        <span>Total Tagihan:</span>
        <h2 style="margin-top: 0"> Rp. {{ number_format($pembayaran->total_harga, 0, ',', '.') }}
        </h2>
        <span>Metode Pembayaran: <strong>{{ $checkout->metode_pembayaran_text }}</strong></span>
    </div> --}}

    <div>
        <div style="margin-bottom: 1rem; margin-top: 20px">Rincian Produk Yang Dibeli :</div>
        <div>
            <table class="main" border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th style="min-width: 200px">Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $item)
                    <tr>
                        <td>
                            <div>
                                <strong>
                                    @foreach ($item->pesanan as $value)

                                    <li style="list-style: none">{{ $value->produk->nama_produk }}</li>
                                    @endforeach
                                </strong>
                            </div>
                        </td>
                        <td class="text-end">
                            @foreach ($item->pesanan as $value)

                            <span>Rp.
                            {{ number_format ($value->produk->harga, 0, '.', '.') }}</>
                           </span>
                            @endforeach
                        </td>
                        <td class="text-end">
                            @foreach ($item->pesanan as $value)

                            <li style="list-style: none">{{ $value->kuantitas }}</li>
                            @endforeach
                        </td>
                        </td>
                        <td class="text-end">
                                <span>
                                    @foreach ($item->pesanan as $value)

                                    <span>Rp.
                                        {{ number_format ($value->sub_total, 0, '.', '.') }}</>
                                       </span>
                                    @endforeach
                                </span>

                            <br><br>
                            <span>Ongkir : Rp.
                                {{ number_format($item->pengiriman->harga_ongkir, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" class="text-end">Total Belanja</td>
                        <td class="text-end">
                            <h3 style="margin: 0"> Rp.
                                {{ number_format($item->harga, 0, ',', '.') }}
                            </h3>
                        </td>
                        @endforeach

                    </tr>

                    <tr>
                        <td colspan="3" class="text-end">Total Pendapatan</td>
                        <td class="text-end">
                            <h3 style="margin: 0"> Rp.
                                {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </h3>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
