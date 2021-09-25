<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\VarDumper\VarDumper;

class Admin extends Controller
{
    public function home()
    {
        $data['menu']  = AdminMenu::all();
        $data['bulan'] = $data['bulan'] = [
            'januari', 'febriari', 'maret', 'april', 'mei',
            'juni', 'juli', 'agustus', 'september', 'november', 'oktober', 'desember'
        ];
        $data['user'] = User::where('name', '!=', 'admin')->get();
        return view('admin.dashboard', $data);
    }

    public function user()
    {
        $data = [
            'menu' => AdminMenu::all(),
            'user' => User::where('name', '!=', 'admin')->get(),
        ];
        return view('admin.user', $data);
    }

    public function tambahUser(Request $request)
    {
        // remove the space from name and assign it in username
        $username = preg_replace('/\s+/', '', $request->nama);
        $password = md5(preg_replace('/\s+/', '', $request->nama));
        $password = password_hash($password, CRYPT_SHA256);
        User::create([
            'role_id' => 2,
            'name' => $request->nama,
            'username' => $username,
            'email' => $request->email,
            'password' => $password
        ]);
        return redirect('/admin/managementuser')->with('message', 'User Telah Di tambahkan');
    }

    public function ubahUser(Request $request)
    {
        $username = preg_replace('/\s+/', '', $request->nama);
        $password = bcrypt(preg_replace('/\s+/', '', $request->nama));
        $user = User::where([
            ['id', '=', $request->id]
        ])->first();
        $user->update([
            'name' => $request->nama,
            'username' => $username,
            'email' => $request->email,
            'password' => $password
        ]);
        return redirect('/admin/managementuser')->with('message', 'User Telah Di ubah');
    }

    public function hapusUser(Request $request)
    {
        User::destroy($request->idUser);
        return 1;
    }

    public function laporanHarian(Request $request)
    {

        $data['menu'] = AdminMenu::all();
        if (!$request->tgl) {
            $data['absensi'] = AbsensiModel::with('user')->where('tgl', date('Y-m-d'))->get();
        } else {
            $data['absensi'] = AbsensiModel::with('user')->where('tgl', $request->tgl)->get();
        }

        Carbon::setLocale('id');
        return view('admin.laporan.laporan_harian', $data);
    }

    public function laporanPerPegawai(Request $request)
    {

        $data['menu'] = AdminMenu::all();
        $data['user'] = User::where('name', '!=', 'admin')->get();
        if (!$request->user_id) {
            $data['absensi'] = AbsensiModel::with('user')->where('user_id', 1)->get();
        } else {
            $data['absensi'] = AbsensiModel::with('user')->where('user_id', $request->user_id)->get();
        }
        Carbon::setLocale('id');
        return view('admin.laporan.laporan_per_pegawai', $data);
    }

    public function laporanBulanan(Request $request)
    {
        $data['lastDay'] = DB::table('absensi')
            ->select(DB::raw('last_day(tgl) as tgl_akhir'))
            ->where(DB::raw('MONTH(tgl)'), '=', 7)
            ->first();

        $data['menu'] = AdminMenu::all();
        $data['user'] = User::where('name', '!=', 'admin')->get();
        $data['bulan'] = ['januari', 'febriari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'november', 'oktober', 'desember'];
        // $data['absensi'] = AbsensiModel::with('user')->get();
        // $data['absensi'] =  AbsensiModel::where(DB::raw('MONTH(tgl)'), '=', 5)->get();

        Carbon::setLocale('id');
        return view('admin.laporan.laporan_bulanan', $data);
    }
}
