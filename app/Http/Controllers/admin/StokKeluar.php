<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use App\Models\PelangganModel;
use App\Models\StokKeluarModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\VarDumper\VarDumper;

class StokKeluar extends Controller
{
    public function home()
    {
        $data = [
            'menu' => AdminMenu::all(),
            'stok_keluar' => StokKeluarModel::all(),
        ];
        return view('stok_keluar.home', $data);
    }

    public function tambah(Request $request)
    {
        // remove the space from name and assign it in username
        StokKeluarModel::create([
            'tanggal' => $request->tanggal,
            'barcode' => $request->barcode,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/admin/stok-keluar')->with('message', 'Data Telah Di tambahkan');
    }

    public function ubah(Request $request)
    {
        $data = StokKeluarModel::where([
            ['id', '=', $request->id]
        ])->first();
        $data->update([
            'tanggal' => $request->tanggal,
            'barcode' => $request->barcode,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/admin/stok-keluar')->with('message', 'Data Telah Di ubah');
    }

    public function hapus(Request $request)
    {
        StokKeluarModel::destroy($request->idUser);
        return 1;
    }
}
