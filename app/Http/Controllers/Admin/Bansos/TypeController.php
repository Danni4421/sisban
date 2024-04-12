<?php

namespace App\Http\Controllers\Admin\Bansos;

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
        return view('admin.pages.bansos.types.index')
            ->with('bansos', $bansos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.bansos.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->createNewBansos(request: $request);
        return redirect('admin/bansos/jenis');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $bansos = Bansos::find($id);
        return $bansos;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $bansos = Bansos::find($id);
        return view('admin.pages.bansos.types.edit')
            ->with('bansos', $bansos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $this->updateExistingBansos(request: $request, id: $id);
        return redirect('admin/bansos/jenis');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->deleteExistingBansos(id: $id);
        return redirect('admin/bansos/jenis');
    }
}
