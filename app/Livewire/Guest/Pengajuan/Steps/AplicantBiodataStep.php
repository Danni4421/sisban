<?php

namespace App\Livewire\Guest\Pengajuan\Steps;

use App\Jobs\DeleteImageJob;
use App\Traits\Guest\Pengajuan\Forms\AplicantForm;
use Livewire\WithFileUploads;
use Spatie\LivewireWizard\Components\StepComponent;

class AplicantBiodataStep extends StepComponent
{
    use WithFileUploads, AplicantForm;    

    public function __construct()
    {
        $this->load_from_session();
    }

    public function save()
    {
        $this->validate();
        $this->validate_image_request();

        DeleteImageJob::dispatch($this->foto_ktp)->delay(now()->addMinutes(env('QUEUE_DELETING_IMAGE_TIME', 360)));

        $this->put_form_session();

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
