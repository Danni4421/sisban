<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\FaqDataTable;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index()
    {
        $id_user = auth()->user()->id_user;
        $faqs = Faq::where('id_user', $id_user)->orderBy('created_at', 'desc')->get();

        return view('generals.faq')->with('faqs', $faqs);
    }

    public function admin_index()
    {
        return app()->make(FaqDataTable::class)->render('admin.pages.faq');
    }

    public function admin_show($id_faq)
    {
        $faqs = Faq::with('user')->where('id_faq', $id_faq)->first();
        return $faqs;
    }

    public function admin_update(Request $request, int $id_faq) {
        Faq::find($id_faq)->update([
            'jawaban' => $request->jawaban,
            'is_solved' => 1,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
            rules: [
                'pertanyaan' => 'required|string'
            ],
            messages: [
                'pertanyaan.required' => 'Mohon untuk memasukkan pertanyaan',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Faq::create([
            'id_user' => auth()->user()->id_user,
            'pertanyaan' => $request->pertanyaan,
        ]);

        return redirect()->to('/faq')->with('success','Berhasil menambahkan pertanyaan');
    }
}
