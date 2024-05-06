<?php

namespace App\Traits\Guest\Pengajuan\Forms;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

trait EconomyConditionForm {

    #[Validate(
        rule: [
            'daya_listrik' => 'required|in:none,450,900,1300'
        ],
        message: [
            'required' => 'Daya listrik perlu untuk diisi',
            'in' => 'Daya listrik antara None, 450, 900, 1300'
        ]
    )]
    public $daya_listrik;

    #[Validate(
        rule: [
            'biaya_listrik' => 'required|integer',
        ],
        message: [
            'required' => 'Biaya listrik perlu untuk diisi',
            'integer' => 'Biaya listrik harus berupa angka'
        ]
    )]
    public $biaya_listrik;

    #[Validate(
        rule: [
            'biaya_air' => 'required|integer',
        ],
        message: [
            'required' => 'Biaya air perlu untuk diisi',
            'integer' => 'Biaya air harus berupa angka'
        ]
    )]
    public $biaya_air;
    
    #[Validate(
        rule: [
            'hutang' => 'required|integer',
        ],
        message: [
            'required' => 'Hutang perlu untuk diisi',
            'integer' => 'Hutang harus berupa angka'
        ]
    )]
    public $hutang;

    #[Validate(
        rule: [
            'pengeluaran' => 'required|integer',
        ],
        message: [
            'required' => 'Pengeluaran perlu untuk diisi',
            'integer' => 'Pengeluaran harus berupa angka'
        ]
    )]
    public $pengeluaran;

    public function put_form_session()
    {
        session()->put('kondisi-ekonomi-keluarga', [
            'daya_listrik' => $this->daya_listrik,
            'biaya_listrik'=> $this->biaya_listrik,
            'biaya_air' => $this->biaya_air,
            'hutang' => $this->hutang,
            'pengeluaran' => $this->pengeluaran
        ]);
    }

    public function load_from_session()
    {
        $sessionData = session()->get('kondisi-ekonomi-keluarga');

        if (!empty($sessionData)) {
            $this->daya_listrik = $sessionData['daya_listrik'];
            $this->biaya_listrik = $sessionData['biaya_listrik'];
            $this->biaya_air = $sessionData['biaya_air'];
            $this->hutang = $sessionData['hutang'];
            $this->pengeluaran = $sessionData['pengeluaran'];
        }
    }
}