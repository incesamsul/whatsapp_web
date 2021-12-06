<?php

namespace App\Http\Controllers;

use App\Models\AbsensiModel;
use App\Models\AdminMenu;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Cache\DynamoDbLock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class Main extends Controller
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }


    public function home()
    {
        $data['chat'] = [];
        $data['friendList'] = $this->userModel->getFriendList();
        return view('chat.home', $data);
    }
}
