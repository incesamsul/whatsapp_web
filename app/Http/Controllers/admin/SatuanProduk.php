<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use App\Models\PelangganModel;
use App\Models\SatuanModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\VarDumper\VarDumper;

class SatuanProduk extends Controller
{
    public function home()
    {
        $data = [
            'menu' => AdminMenu::all(),
            'satuan' => SatuanModel::all(),
        ];
        return view('satuan.home', $data);
    }

    public function tambah(Request $request)
    {
        // remove the space from name and assign it in username
        SatuanModel::create([
            'satuan' => $request->satuan,
        ]);
        return redirect('/admin/satuan-produk')->with('message', 'Data Telah Di tambahkan');
    }

    public function ubah(Request $request)
    {
        $data = SatuanModel::where([
            ['id', '=', $request->id]
        ])->first();
        $data->update([
            'satuan' => $request->satuan,
        ]);
        return redirect('/admin/satuan-produk')->with('message', 'Data Telah Di ubah');
    }

    public function hapus(Request $request)
    {
        SatuanModel::destroy($request->idUser);
        return 1;
    }
}
