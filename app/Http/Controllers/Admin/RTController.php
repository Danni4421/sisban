<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ManageRT;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RTController extends Controller
{
    use ManageRT;

    public function index()
    {
        $rt = $this->getRT();
        return view('admin.pages.rt.index')
            ->with('rts', $rt);
    }

    public function create()
    {
        return view('admin.pages.rt.create');
    }

    public function store(Request $request)
    {
        $this->storeRT(request: $request);
        return redirect('admin/data-rt');
    }

    public function edit(int $id)
    {
        $rt = $this->getRT($id);
        return view('admin.pages.rt.edit')
            ->with('rt', $rt);
    }

    public function update(Request $request, int $id)
    {
        $this->updateRT(request: $request, id: $id);
        return redirect('admin/data-rt');
    }

    public function destroy(int $id)
    {
        $this->deleteRT(id: $id);
        return redirect('admin/data-rt');
    }
}
