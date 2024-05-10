<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DataRtDataTable;
use App\Traits\ManageRT;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RTController extends Controller
{
    use ManageRT;

    public ?DataRtDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = app()->make(DataRtDataTable::class);
    }

    public function index()
    {
        return $this->dataTable->render('admin.pages.rt.index');
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
    }
}
