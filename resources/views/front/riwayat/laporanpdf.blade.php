<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pembayaran {{ auth()->user()->nm_user }}</title>
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
    <table style="width: 100%;" cellspacing="0" cellpadding="0">
        <tr>
            <td style="text-align: left;">
                <h1>INVOICE</h1>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                {{-- <img width="100px" class="fa-4x ms-0" src="{{ asset('assets/img/logomini.png') }}"> --}}
            </td>
        </tr>
    </table>

    <hr>

    {{-- <div>{{ $setting->nm_perusahaan }}</div> --}}
    <table>
        <tr>
            <td style="margin-left: 20px;text-align: right;">
                <div>No. Invoice : # {{ $pembayaran->no_invoice }}</div>
            </td>
        </tr>
        <table style="padding-top: 10px;">
            <tr>
                <td>Dipesan Kepada</td>
                <td>:</td>
                <td>{{ $pembayaran->pengiriman->nama_penerima }}</td>
            </tr>
            <tr>
                <td>No. Telepon </td>
                <td>:</td>
                <td>{{ $pembayaran->pengiriman->no_hp }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $pembayaran->pengiriman->alamat }},
                    {{ $pembayaran->pengiriman->Kota->nama_kota }},{{ $pembayaran->pengiriman->Provinsi->nama_provinsi }}</td>
            </tr>
            <tr>
                <td>Tanggal pesan</td>
                <td>:</td>
                <td>{{ Carbon\Carbon::parse($pembayaran->created_at)->format('d-M-Y') }}</td>
            </tr>
        </table>
        </td>
        </tr>
    </table>

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
                    <tr>
                        <td>
                            <div>
                                <strong>
                                    @foreach ($pembayaran->pesanan as $pesanan)
                                        <li style="list-style: none">{{ $pesanan->produk->nama_produk }}</li>
                                    @endforeach
                                </strong>
                            </div>
                        </td>
                        <td class="text-end">
                            @foreach ($pembayaran->pesanan as $pesanan)
                                <li style="list-style: none"> <span> Rp.
                                        {{ number_format($pesanan->produk->harga, 0, ',', '.') }}</span></li>
                            @endforeach
                        </td>
                        <td class="text-end">
                            @foreach ($pembayaran->pesanan as $pesanan)
                                <li style="list-style: none"><span>{{ $pesanan->kuantitas }}</span></li>
                            @endforeach
                        </td>
                        <td class="text-end">
                            @foreach ($pembayaran->pesanan as $pesanan)
                                <span>
                                    <li style="list-style: none"> Rp.
                                        {{ number_format($pesanan->sub_total, 0, ',', '.') }}</li>
                                </span>
                            @endforeach
                            <br><br>
                            <span>Ongkir : Rp.
                                {{ number_format($pembayaran->pengiriman->harga_ongkir, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end">Total Belanja</td>
                        <td class="text-end">
                            <h3 style="margin: 0"> Rp.
                                {{ number_format($pembayaran->harga, 0, ',', '.') }}
                            </h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
