<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use App\Models\PelangganModel;
use App\Models\StokMasukModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\VarDumper\VarDumper;

class StokMasuk extends Controller
{
    public function home()
    {
        $data = [
            'menu' => AdminMenu::all(),
            'stok_masuk' => StokMasukModel::all(),
        ];
        return view('stok_masuk.home', $data);
    }
    public function tambah(Request $request)
    {
        // remove the space from name and assign it in username
        StokMasukModel::create([
            'tanggal' => $request->tanggal,
            'barcode' => $request->barcode,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/admin/stok-masuk')->with('message', 'Data Telah Di tambahkan');
    }

    public function ubah(Request $request)
    {
        $data = StokMasukModel::where([
            ['id', '=', $request->id]
        ])->first();
        $data->update([
            'tanggal' => $request->tanggal,
            'barcode' => $request->barcode,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/admin/stok-masuk')->with('message', 'Data Telah Di ubah');
    }

    public function hapus(Request $request)
    {
        StokMasukModel::destroy($request->idUser);
        return 1;
    }
}
