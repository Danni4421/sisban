<?php

namespace App\Http\Controllers\RW;

use App\DataTables\RW\DataRtDataTable;
use App\Traits\ManageRT;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    use ManageRT;

    public ?DataRtDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = app()->make(DataRtDataTable::class);
    }

    public function index()
    {
        return $this->dataTable->render('rw.pages.rt.member');
    }

    public function create()
    {
        return view('rw.pages.rt.member_tambah');
    }

    public function store(Request $request)
    {
        $this->storeRT(request: $request);
        return redirect('rw/data-rt');
    }

    public function edit(int $id)
    {
        $rt = $this->getRT($id);
        return view('rw.pages.rt.member_ubah', ['data' => $rt]);
    }

    public function update(Request $request, int $id)
    {
        $this->updateRT(request: $request, id: $id);
        return redirect('rw/data-rt');
    }

    public function destroy(int $id)
    {
        $this->deleteRT(id: $id);
    }
}

