<?php

namespace App\Livewire\Guest\Pengajuan\Steps;

use App\Jobs\DeleteImageJob;
use App\Traits\Guest\Pengajuan\Forms\FamilyForm;
use Livewire\WithFileUploads;
use Spatie\LivewireWizard\Components\StepComponent;

class FamilyDataStep extends StepComponent
{
    use WithFileUploads, FamilyForm;

    public array $inputs = [];
    public int $inputIndex = 0;

    public function __construct() 
    {
        $this->put_form_session();
    }

    public function addInput()
    {
        $this->inputs[] = $this->inputIndex;
        session()->put('form-keluarga-input-index', $this->inputs);

        $this->inputIndex++;
    }

    public function save()
    {
        $this->validate();
        $this->validate_image_request();

        DeleteImageJob::dispatch($this->foto_kk)->delay(now()->addMinutes(env('QUEUE_DELETING_IMAGE_TIME', 360)));

        $this->update_keluarga();
        $this->nextStep();
    }

    public function getSessionData()
    {
        return session()->get('keluarga');
    }

    public function mergeDataKeluarga($familiesData) 
    {
        return array_map(
            function($nik, $nama, $jenis_kelamin, $tempat_tanggal_lahir, $umur, $nomor_telepon, $penghasilan)
            {
                return [
                    'nik' => $nik,
                    'nama'=> $nama,
                    'jenis_kelamin'=> $jenis_kelamin,
                    'tempat_tanggal_lahir'=> $tempat_tanggal_lahir,
                    'umur'=> $umur,
                    'nomor_telepon'=> $nomor_telepon,
                    'penghasilan'=> $penghasilan,
                ];
            }, 
            $familiesData["nik"], 
            $familiesData["nama"], 
            $familiesData["jenis_kelamin"], 
            $familiesData["tempat_tanggal_lahir"], 
            $familiesData["umur"],
            $familiesData["nomor_telepon"],
            $familiesData["penghasilan"],
        );
    }

    public function render()
    {
        $familiesData = $this->getSessionData();
        $applicantData = session()->get('kepala-keluarga');
        $formIndex = session()->get('form-keluarga-input-index');

        return view('livewire.guest.pengajuan.steps.family-data-step', $familiesData ? [
            'families' => $this->mergeDataKeluarga($familiesData)
        ] : [])
            ->with('aplicant', $applicantData)
            ->with('forms', $formIndex ?? $this->inputs);
    }
}
