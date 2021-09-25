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

class LaporanPenjualan extends Controller
{
    public function home()
    {
        $data = [
            'menu' => AdminMenu::all(),
            'penjualan' => TransaksiModel::all(),
        ];
        return view('laporan_penjualan.home', $data);
    }
}
