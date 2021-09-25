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

class LaporanStokKeluar extends Controller
{
    public function home()
    {
        $data = [
            'menu' => AdminMenu::all(),
            'stok_keluar' => StokKeluarModel::all(),
        ];
        return view('laporan_stok_keluar.home', $data);
    }
}
