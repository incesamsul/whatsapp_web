<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use App\Models\PelangganModel;
use App\Models\TransaksiModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\VarDumper\VarDumper;

class Transaksi extends Controller
{
    public function home()
    {
        $data = [
            'menu' => AdminMenu::all(),
            'transaksi' => TransaksiModel::all(),
        ];
        return view('transaksi.home', $data);
    }
    public function tambah(Request $request)
    {
        // remove the space from name and assign it in username
        TransaksiModel::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ]);
        return redirect('/admin/transaksi')->with('message', 'Data Telah Di tambahkan');
    }

    public function ubah(Request $request)
    {
        $data = TransaksiModel::where([
            ['id', '=', $request->id]
        ])->first();
        $data->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ]);
        return redirect('/admin/transaksi')->with('message', 'Data Telah Di ubah');
    }

    public function hapus(Request $request)
    {
        TransaksiModel::destroy($request->idUser);
        return 1;
    }
}
