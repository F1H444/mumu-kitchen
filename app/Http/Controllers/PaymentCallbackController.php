<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Services\Midtrans\CallbackService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $pembayaran = $callback->getOrder();

            if ($callback->isSuccess()) {
                // Update status pembayaran langsung ke selesai
                Pembayaran::where('id', $pembayaran->id)->update([
                    'payment_status' => 'sudahbayar',
                    'status' => 'pesananselesai'
                ]);

                // Kirim email invoice ke customer
                try {
                    $pembayaranData = Pembayaran::with(['user', 'pengiriman.provinsi', 'pengiriman.kota', 'pesanan.produk'])->find($pembayaran->id);

                    if ($pembayaranData && $pembayaranData->user && $pembayaranData->user->email) {
                        Mail::send('emails.invoice', ['pembayaran' => $pembayaranData], function ($message) use ($pembayaranData) {
                            $message->to($pembayaranData->user->email)
                                ->subject('Invoice Pembayaran #' . $pembayaranData->no_pemesanan . ' - Mumu Kitchen');
                        });

                        Log::info('Invoice email sent successfully to: ' . $pembayaranData->user->email);
                    }
                } catch (\Exception $e) {
                    Log::error('Failed to send invoice email: ' . $e->getMessage());
                }
            }

            if ($callback->isExpire()) {
                Pembayaran::where('id', $pembayaran->id)->update([
                    'payment_status' => 'kadaluarsa',
                    'status' => 'pesananbatal'
                ]);
            }

            if ($callback->isCancelled()) {
                Pembayaran::where('id', $pembayaran->id)->update([
                    'payment_status' => 'kadaluarsa',
                    'status' => 'pesananbatal'
                ]);
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }
}
