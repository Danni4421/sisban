<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function main()
    {
        return view('rw.pages.rt.member');
    }
}
