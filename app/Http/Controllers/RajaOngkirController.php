<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([

            'Accept' => 'application/json',
            'key' => getenv('RAJAONGKIR_API_KEY'),

        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');


        if ($response->successful()) {


            $provinces = $response->json()['data'] ?? [];
        }

        // returning the view with provinces data
        return view('rajaongkir', compact('provinces'));
    }

    /**
     * Mengambil data kota berdasarkan ID provinsi
     *
     * @param int $provinceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($provinceId)
    {

        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => getenv('RAJAONGKIR_API_KEY'),

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/city/{$provinceId}");

        if ($response->successful()) {

            // Mengambil data kota dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return response()->json($response->json()['data'] ?? []);
        }
    }

    /**
     * Mengambil data kecamatan berdasarkan ID kota
     *
     * @param int $cityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts($cityId)
    {
        // Mengambil data kecamatan berdasarkan ID kota dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => getenv('RAJAONGKIR_API_KEY'),

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/district/{$cityId}");

        if ($response->successful()) {

            // Mengambil data kecamatan dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return response()->json($response->json()['data'] ?? []);
        }
    }

    /**
     * Menghitung ongkos kirim berdasarkan data yang diberikan
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOngkir(Request $request)
    {
        $data = $request->validate([
            'alamat_id' => 'required',
            'courier' => 'required|in:jne,tiki,pos'
        ]);

        $alamat = Alamat::find($request->alamat_id);
        $keranjangs = Keranjang::with(['Produk'])->where('user_id', auth()->user()->id)->get();
        $weight = 0;
        foreach ($keranjangs as $keranjang) {
            $weight += $keranjang->Produk->berat;
        }

        $response = Http::asForm()->withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => getenv('RAJAONGKIR_API_KEY'),

        ])->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
            'origin' => 444,
            'destination' => $alamat->id,
            'courier' => $data['courier'],
            'weight' => $weight * 1000
        ]);

        if ($response->successful()) {

            // Mengambil data ongkos kirim dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return $response->json()['data'] ?? [];
        }
    }
}
