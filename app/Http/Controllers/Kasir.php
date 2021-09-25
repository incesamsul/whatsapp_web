<?php

namespace App\Http\Controllers;

use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Cache\DynamoDbLock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class Kasir extends Controller
{

    public function home()
    {
        if (auth()->user()->role_id == 1) {
            return redirect('/admin/dashboard');
        }
        Carbon::setLocale('id');
        $data['menu']  = AdminMenu::all();
        $data['bulan'] = $data['bulan'] = [
            'januari', 'febriari', 'maret', 'april', 'mei',
            'juni', 'juli', 'agustus', 'september', 'november', 'oktober', 'desember'
        ];
        return view('kasir.home', $data);
    }

    public function cekabsen()
    {
        if (auth()->user()->role_id == 1) {
            return redirect('/admin/dashboard');
        }
        $absensi = $this->getTodaysAbsen()['absensi'];
        return view('absensi.cekabsen', compact('absensi'));
    }

    public function checkin(Request $request)
    {

        $tanggal = $this->getTodaysAbsen()['tanggal'];
        $localTime = $this->getTodaysAbsen()['localtime'];
        $absensi = $this->getTodaysAbsen()['absensi'];
        if ($absensi) {
            // return redirect('/cekabsen')->with('absen_message', 'anda sudah melakukan absen hari ini');
            return redirect('/kasir')->with('absen_message', 'anda sudah melakukan absen hari ini');
        } else {
            AbsensiModel::create([
                'user_id' => auth()->user()->id,
                'kondisi_checkin' => $request->kondisi,
                'status_kerja_checkin' => $request->statuskerja,
                'posisi_checkin' => $request->posisi,
                'latitude_checkin' => $request->latitude,
                'longitude_checkin' => $request->longitude,
                'tgl' => $tanggal,
                'checkin' => $localTime
            ]);
        }
        return redirect('/kasir')->with('absen_message', 'absen berhasil terekam');
    }

    public function updatePosisiPertama(Request $request)
    {
        $absensi = $this->getTodaysAbsen()['absensi'];
        if (!$absensi->lapor_posisi_1) {
            $absensi->update([
                'kondisi_lapor_posisi_1' => $request->kondisi,
                'status_kerja_lapor_posisi_1' => $request->statuskerja,
                'posisi_lapor_posisi_1' => $request->posisi,
                'latitude_lapor_posisi_1' => $request->latitude,
                'longitude_lapor_posisi_1' => $request->longitude,
                'lapor_posisi_1' => $this->getTodaysAbsen()['localtime'],
            ]);
            return redirect('/kasir')->with('absen_message', 'lapor posisi 1 berhasil terekam');
        } else {
            return redirect('/kasir')->with('absen_message', 'lapor posisi 1 telah terekam sebelumnya');
        }
    }

    public function updatePosisiKedua(Request $request)
    {
        $absensi = $this->getTodaysAbsen()['absensi'];
        if (!$absensi->lapor_posisi_2) {
            $absensi->update([
                'kondisi_lapor_posisi_2' => $request->kondisi,
                'status_kerja_lapor_posisi_2' => $request->statuskerja,
                'posisi_lapor_posisi_2' => $request->posisi,
                'latitude_lapor_posisi_2' => $request->latitude,
                'longitude_lapor_posisi_2' => $request->longitude,
                'lapor_posisi_2' => $this->getTodaysAbsen()['localtime']
            ]);
            return redirect('/kasir')->with('absen_message', 'lapor posisi 2 berhasil terekam');
        } else {
            return redirect('/kasir')->with('absen_message', 'lapor posisi 2 telah terekam sebelumnya');
        }
    }

    public function checkout(Request $request)
    {
        $absensi = $this->getTodaysAbsen()['absensi'];
        if (!$absensi->checkout) {
            $absensi->update([
                'kondisi_checkout' => $request->kondisi,
                'status_kerja_checkout' => $request->statuskerja,
                'posisi_checkout' => $request->posisi,
                'latitude_checkout' => $request->latitude,
                'longitude_checkout' => $request->longitude,
                'checkout' => $this->getTodaysAbsen()['localtime']
            ]);
            return redirect('/kasir')->with('absen_message', 'check out telah tersimpan');
        } else {
            return redirect('/kasir')->with('absen_message', 'anda sudah melakukan check out hari ini');
        }
    }



    public function getTodaysAbsen()
    {
        $timezone = 'Asia/Makassar';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');
        $localTime = $date->format('H:i:s');
        $absensi = AbsensiModel::where([
            ['user_id', '=', auth()->user()->id],
            ['tgl', '=', $tanggal]
        ])->first();
        $todaysAbsen = [
            'absensi' => $absensi,
            'tanggal' => $tanggal,
            'localtime' => $localTime
        ];
        return $todaysAbsen;
    }

    public function getLogPresensi()
    {
        // $presensi = AbsensiModel::with('user')->get()->where('user.id', '=', auth()->user()->id)->take(3);
        $presensi = AbsensiModel::orderBy('tgl', 'desc')->where('user_id', '=', auth()->user()->id)->get()->take(3);
        return $presensi;
    }
}
