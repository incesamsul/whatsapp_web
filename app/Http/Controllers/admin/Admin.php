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
        return view('admin.home');
    }
}
