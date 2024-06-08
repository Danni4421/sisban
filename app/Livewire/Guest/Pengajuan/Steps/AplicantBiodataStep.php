<?php

namespace App\Livewire\Guest\Pengajuan\Steps;

use App\Traits\Guest\Pengajuan\Forms\AplicantForm;
use Spatie\LivewireWizard\Components\StepComponent;
use Livewire\WithFileUploads;

class AplicantBiodataStep extends StepComponent
{
    use WithFileUploads, AplicantForm;

    public function __construct()
    {
        $this->load_data();
    }

    public function save()
    {
        $this->validate();
        $this->validate_image_request();
        $this->put_data();


        $this->nextStep();
    }

    public function getSessionData()
    {
        return session()->get('kepala-keluarga');
    }

    public function render()
    {
        return view('livewire.guest.pengajuan.steps.aplicant-biodata-step');
    }
}
