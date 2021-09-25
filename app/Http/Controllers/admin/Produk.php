<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use App\Models\PelangganModel;
use App\Models\ProdukModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\VarDumper\VarDumper;

class Produk extends Controller
{
    public function home()
    {
        $data = [
            'menu' => AdminMenu::all(),
            'produk' => ProdukModel::all(),
        ];
        return view('produk.home', $data);
    }

    public function tambah(Request $request)
    {
        // remove the space from name and assign it in username
        ProdukModel::create([
            'barcode' => $request->barcode,
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        return redirect('/admin/produk')->with('message', 'Data Telah Di tambahkan');
    }

    public function ubah(Request $request)
    {
        $data = ProdukModel::where([
            ['id', '=', $request->id]
        ])->first();
        $data->update([
            'barcode' => $request->barcode,
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        return redirect('/admin/produk')->with('message', 'Data Telah Di ubah');
    }

    public function hapus(Request $request)
    {
        ProdukModel::destroy($request->idUser);
        return 1;
    }
}
