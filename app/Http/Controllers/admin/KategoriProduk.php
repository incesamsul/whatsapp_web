<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use App\Models\KategoriModel;
use App\Models\PelangganModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\VarDumper\VarDumper;

class KategoriProduk extends Controller
{
    public function home()
    {
        $data = [
            'menu' => AdminMenu::all(),
            'kategori' => KategoriModel::all(),
        ];
        return view('kategori.home', $data);
    }

    public function tambah(Request $request)
    {
        // remove the space from name and assign it in username
        KategoriModel::create([
            'kategori' => $request->kategori,
        ]);
        return redirect('/admin/kategori-produk')->with('message', 'Data Telah Di tambahkan');
    }

    public function ubah(Request $request)
    {
        $data = KategoriModel::where([
            ['id', '=', $request->id]
        ])->first();
        $data->update([
            'kategori' => $request->kategori,
        ]);
        return redirect('/admin/kategori-produk')->with('message', 'Data Telah Di ubah');
    }

    public function hapus(Request $request)
    {
        KategoriModel::destroy($request->idUser);
        return 1;
    }
}
