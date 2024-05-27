<?php

namespace App\Http\Controllers\RT\Bansos;

use App\Http\Controllers\Controller;
use App\Models\Bansos;
use App\Traits\ManageBansos;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    use ManageBansos;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bansos = Bansos::all();
        return view('rt.pages.bansos.types.index')
            ->with('bansos', $bansos);
    }
}
