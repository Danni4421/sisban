<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $aset = Aset::all();
        return view('test')->with('aset', $aset);
    }
}
