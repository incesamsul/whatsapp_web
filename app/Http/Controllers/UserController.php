<?php

namespace App\Http\Controllers;

use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use App\Models\ChatModel;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Cache\DynamoDbLock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{

    public function registration()
    {
        return view('registration.index');
    }

    public function sendMessage(Request $request)
    {
        ChatModel::create([
            'id_pengirim' => auth()->user()->id,
            'id_penerima' => $request->id_penerima,
            'pesan' => $request->pesan,
        ]);
        return 1;
    }

    public function postRegister(Request $request)
    {
        $dataUser = User::where([
            'email' => $request->username . '@mail.com',
        ])->first();
        if (!$dataUser) {
            User::create([
                'name' => $request->username,
                'email' => $request->username . '@mail.com',
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role_id' => 2
            ]);
        }
        return redirect('/login-biasa')->with('message', 'okemi man');
    }

    public function fetchDataChat(Request $request)
    {

        if ($request->ajax()) {
            $data['chat'] = DB::table('chat')
                ->where('id_pengirim', auth()->user()->id)
                ->Where('id_penerima', $request->idFriend)
                ->orWhere('id_pengirim', $request->idFriend)
                ->Where('id_penerima', auth()->user()->id)
                ->get();
            $data['friend'] = DB::table('users')
                ->Where('id', $request->idFriend)
                ->first();
            return view('chat.data_chat', $data)->render();
        }
    }
}
