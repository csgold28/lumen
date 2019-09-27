<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Produk;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createKategori(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $name = $request->input('name');

        $kategori = Kategori::create([
            'name' => $name
        ]);

        if ($kategori) {
            return response()->json([
                'success' => true,
                'message' => 'Penambahan kategori berhasil!',
                'data' => $kategori
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Penambahan kategori GAGAL!',
            ], 400);
        }
    }
}
