<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrcodeModel extends Model
{
    use HasFactory;
    protected $table = 'qrcode';
    protected $fillable = ['token', 'username', 'password'];
}
