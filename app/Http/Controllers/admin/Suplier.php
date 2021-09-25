<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use App\Models\PelangganModel;
use App\Models\SuplierModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\VarDumper\VarDumper;

class Suplier extends Controller
{
    public function home()
    {
        $data = [
            'menu' => AdminMenu::all(),
            'suplier' => SuplierModel::all(),
        ];
        return view('suplier.home', $data);
    }

    public function tambah(Request $request)
    {
        // remove the space from name and assign it in username
        SuplierModel::create([
            'role_id' => 2,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
        ]);
        return redirect('/admin/suplier')->with('message', 'Data Telah Di tambahkan');
    }

    public function ubah(Request $request)
    {
        $data = SuplierModel::where([
            ['id', '=', $request->id]
        ])->first();
        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
        ]);
        return redirect('/admin/suplier')->with('message', 'Data Telah Di ubah');
    }

    public function hapus(Request $request)
    {
        SuplierModel::destroy($request->idUser);
        return 1;
    }
}
