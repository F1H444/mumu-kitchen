<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembayaran - Mumu Kitchen</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: 'Segoe UI', Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <!-- Container -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">

                    <!-- Header dengan Gradient -->
                    <tr>
                        <td
                            style="background: linear-gradient(135deg, #1c2e26 0%, #2d4a3a 100%); padding: 40px 30px; text-align: center;">
                            <!-- Logo/Icon Area -->
                            <div style="margin-bottom: 20px;">
                                <!--
                                OPSI 1: Gunakan Emoji (Recommended - tidak perlu upload gambar)
                                -->
                                <h1 style="font-size: 48px; margin: 0; padding: 0;">🍽️</h1>

                                <!--
                                OPSI 2: Gunakan Gambar Logo (jika punya)
                                Upload logo ke folder public/images/logo.png
                                Lalu uncomment baris ini dan comment emoji di atas:
                                
                                <img src="{{ asset('images/logo.png') }}" alt="Mumu Kitchen Logo" style="max-width: 120px; height: auto;">
                                -->
                            </div>

                            <h1 style="color: #d97706; font-size: 32px; margin: 10px 0; font-weight: 700;">MUMU KITCHEN
                            </h1>
                            <p style="color: rgba(255,255,255,0.9); margin: 0; font-size: 16px;">Terima kasih atas
                                pembelian Anda!</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">

                            <!-- Greeting -->
                            <p style="font-size: 16px; color: #333; margin: 0 0 20px;">
                                Halo <strong>{{ $pembayaran->user->name ?? 'Customer' }}</strong>,
                            </p>

                            <p style="font-size: 14px; color: #666; line-height: 1.6; margin: 0 0 30px;">
                                Pembayaran Anda telah berhasil diproses. Berikut adalah detail invoice pesanan Anda:
                            </p>

                            <!-- Invoice Info Box -->
                            <table width="100%" cellpadding="15"
                                style="background: #f8f9fa; border-left: 4px solid #d97706; margin-bottom: 30px; border-radius: 6px;">
                                <tr>
                                    <td>
                                        <h2 style="color: #1c2e26; font-size: 18px; margin: 0 0 15px;">📋 Detail Invoice
                                        </h2>

                                        <table width="100%" cellpadding="8" style="font-size: 14px;">
                                            <tr style="border-bottom: 1px solid #e0e0e0;">
                                                <td style="color: #666; padding: 10px 0;">No. Invoice</td>
                                                <td
                                                    style="color: #1c2e26; font-weight: 600; text-align: right; padding: 10px 0;">
                                                    {{ $pembayaran->no_invoice }}</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #e0e0e0;">
                                                <td style="color: #666; padding: 10px 0;">No. Pemesanan</td>
                                                <td
                                                    style="color: #1c2e26; font-weight: 600; text-align: right; padding: 10px 0;">
                                                    #{{ $pembayaran->no_pemesanan }}</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #e0e0e0;">
                                                <td style="color: #666; padding: 10px 0;">Tanggal</td>
                                                <td
                                                    style="color: #1c2e26; font-weight: 600; text-align: right; padding: 10px 0;">
                                                    {{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d F Y, H:i') }}
                                                    WIB</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #666; padding: 10px 0;">Status</td>
                                                <td style="text-align: right; padding: 10px 0;">
                                                    <span
                                                        style="background: #22c55e; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">✓
                                                        LUNAS</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Products Section -->
                            <h3
                                style="color: #1c2e26; font-size: 16px; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 2px solid #d97706;">
                                📦 Produk yang Dipesan
                            </h3>

                            @foreach ($pembayaran->pesanan as $item)
                                <table width="100%" cellpadding="15"
                                    style="background: #f8f9fa; margin-bottom: 10px; border-radius: 6px;">
                                    <tr>
                                        <td width="70%">
                                            <h4 style="color: #1c2e26; font-size: 15px; margin: 0 0 5px;">
                                                {{ $item->produk->nama_produk }}</h4>
                                            <p style="color: #666; font-size: 13px; margin: 0;">
                                                {{ $item->kuantitas }} x Rp
                                                {{ number_format($item->sub_total / $item->kuantitas, 0, ',', '.') }}
                                            </p>
                                        </td>
                                        <td width="30%" align="right">
                                            <span style="color: #d97706; font-size: 16px; font-weight: 700;">
                                                Rp {{ number_format($item->sub_total, 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach

                            <!-- Shipping Info -->
                            <h3
                                style="color: #1c2e26; font-size: 16px; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 2px solid #d97706;">
                                🚚 Informasi Pengiriman
                            </h3>

                            <table width="100%" cellpadding="20"
                                style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; margin-bottom: 20px;">
                                <tr>
                                    <td>
                                        <h4 style="color: #1c2e26; margin: 0 0 10px; font-size: 15px;">
                                            {{ $pembayaran->pengiriman->nama_penerima }}</h4>
                                        <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 5px 0;">
                                            📞 {{ $pembayaran->pengiriman->no_hp }}
                                        </p>
                                        <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 5px 0;">
                                            📍 {{ $pembayaran->pengiriman->alamat }}
                                        </p>
                                        <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 5px 0;">
                                            {{ $pembayaran->pengiriman->kota->nama_kota ?? '' }},
                                            {{ $pembayaran->pengiriman->provinsi->nama_provinsi ?? '' }}
                                            {{ $pembayaran->pengiriman->kode_pos }}
                                        </p>
                                        <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 10px 0 0;">
                                            <strong>Ekspedisi:</strong>
                                            {{ strtoupper($pembayaran->pengiriman->nama_ekspedisi) }} -
                                            {{ $pembayaran->pengiriman->paket_layanan }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            @if ($pembayaran->catatan)
                                <table width="100%" cellpadding="15"
                                    style="background: #f8f9fa; border-left: 4px solid #d97706; margin-bottom: 20px; border-radius: 6px;">
                                    <tr>
                                        <td>
                                            <h4 style="color: #1c2e26; margin: 0 0 10px; font-size: 15px;">📝 Catatan
                                            </h4>
                                            <p style="color: #666; font-size: 14px; margin: 0; line-height: 1.6;">
                                                {{ $pembayaran->catatan }}</p>
                                        </td>
                                    </tr>
                                </table>
                            @endif

                            <!-- Total Section -->
                            @php
                                $subtotal = 0;
                                foreach ($pembayaran->pesanan as $item) {
                                    $subtotal += $item->sub_total;
                                }
                            @endphp

                            <table width="100%" cellpadding="25"
                                style="background: #1c2e26; color: white; border-radius: 8px; margin: 30px 0;">
                                <tr>
                                    <td>
                                        <table width="100%" style="font-size: 14px;">
                                            <tr>
                                                <td style="padding: 8px 0;">Subtotal Produk</td>
                                                <td align="right" style="padding: 8px 0;">Rp
                                                    {{ number_format($subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0;">Biaya Pengiriman</td>
                                                <td align="right" style="padding: 8px 0;">Rp
                                                    {{ number_format($pembayaran->pengiriman->harga_ongkir, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr
                                                style="border-top: 2px solid #d97706; font-size: 20px; font-weight: 700;">
                                                <td style="padding: 15px 0 0;">TOTAL PEMBAYARAN</td>
                                                <td align="right" style="padding: 15px 0 0; color: #d97706;">
                                                    Rp {{ number_format($pembayaran->harga, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <table width="100%" cellpadding="20">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/riwayat/pembayaran/' . $pembayaran->id . '/detail') }}"
                                            style="display: inline-block; background: #d97706; color: white; padding: 15px 40px; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 16px;">
                                            Lihat Detail Pesanan
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background: #f8f9fa; padding: 30px; text-align: center;">
                            <p style="color: #1c2e26; font-weight: 600; font-size: 16px; margin: 0 0 10px;">Mumu Kitchen
                            </p>
                            <p style="color: #666; font-size: 14px; margin: 5px 0;">Terima kasih telah mempercayai kami!
                            </p>
                            <p style="color: #666; font-size: 14px; margin: 5px 0;">
                                Jika ada pertanyaan, hubungi kami di
                                <a href="mailto:mumuuu112233@gmail.com"
                                    style="color: #d97706; text-decoration: none;">mumuuu112233@gmail.com</a>
                            </p>
                            <p style="color: #999; font-size: 12px; margin: 20px 0 0;">
                                Email ini dikirim otomatis, mohon tidak membalas email ini.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
