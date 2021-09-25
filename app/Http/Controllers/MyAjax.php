<?php

namespace App\Http\Controllers;

use App\Models\QrcodeModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class MyAjax extends Controller
{
    public function qrcodeCheck()
    {
        $qrcode = QrcodeModel::all()->last();
        echo json_encode($qrcode);
    }

    public function loginQrcode()
    {
        $token = $_POST['token'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        QrcodeModel::create([
            'token' => $token,
            'username' => $username,
            'password' => $password
        ]);
    }

    public function ajaxPostLogin()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = User::where('username', $username)->first();
        if ($user->password == $password) {
            QrcodeModel::where('username', $username)->delete();
            Auth::login($user);
            echo 1;
        } else {
            $password = false;
        }
    }
}
