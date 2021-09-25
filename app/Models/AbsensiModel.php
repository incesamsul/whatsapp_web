<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiModel extends Model
{
    use HasFactory;
    protected $table = "absensi";
    protected $primaryKy = "id";
    protected $fillable = ['user_id', 'tgl', 'kondisi_checkin', 'status_kerja_checkin', 'posisi_checkin', 'latitude_checkin', 'longitude_checkin', 'checkin', 'kondisi_lapor_posisi_1', 'status_kerja_lapor_posisi_1', 'posisi_lapor_posisi_1', 'latitude_lapor_posisi_1', 'longitude_lapor_posisi_1', 'lapor_posisi_1', 'kondisi_lapor_posisi_2', 'status_kerja_lapor_posisi_2', 'posisi_lapor_posisi_2', 'latitude_lapor_posisi_2', 'longitude_lapor_posisi_2', 'lapor_posisi_2', 'kondisi_checkout', 'status_kerja_checkout', 'posisi_checkout', 'latitude_checkout', 'longitude_checkout', 'checkout'];
    protected $dates = ['tgl'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
