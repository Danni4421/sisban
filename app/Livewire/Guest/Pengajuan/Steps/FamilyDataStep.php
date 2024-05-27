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

        if (session()->has('form-keluarga-input-index')) {
            $this->inputIndex = session()->get('form-keluarga-input-index');
        }

        if (session()->has('form-keluarga-inputs')) {
            $this->inputs = session()->get('form-keluarga-inputs');
        }
    }

    public function addInput()
    {
        $this->inputs[] = $this->inputIndex;
        session()->put('form-keluarga-inputs', $this->inputs);
        session()->put('form-keluarga-input-index', $this->inputIndex);

        $this->inputIndex++;
    }

    public function save()
    {
        $this->validate();
        $this->validate_image_request();

        DeleteImageJob::dispatch($this->foto_kk)->delay(now()->addMinutes(env('QUEUE_DELETING_IMAGE_TIME', 360)));

        if (!empty($this->slip_gaji)) {
            foreach ($this->slip_gaji as $value) {
                DeleteImageJob::dispatch($value)->delay(now()->addMinutes(env('QUEUE_DELETING_IMAGE_TIME', 360)));
            }
        }

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
            function ($nik, $nama, $jenis_kelamin, $tempat_tanggal_lahir, $umur, $nomor_telepon, $status, $penghasilan) {
                return [
                    'nik' => $nik,
                    'nama' => $nama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tempat_tanggal_lahir' => $tempat_tanggal_lahir,
                    'umur' => $umur,
                    'nomor_telepon' => $nomor_telepon,
                    'status' => $status,
                    'penghasilan' => $penghasilan,
                ];
            },
            $familiesData["nik"],
            $familiesData["nama"],
            $familiesData["jenis_kelamin"],
            $familiesData["tempat_tanggal_lahir"],
            $familiesData["umur"],
            $familiesData["nomor_telepon"],
            $familiesData["status"],
            $familiesData["penghasilan"],
        );
    }

    public function render()
    {
        $familiesData = $this->getSessionData();
        $applicantData = session()->get('kepala-keluarga');

        return view('livewire.guest.pengajuan.steps.family-data-step', $familiesData ? [
            'families' => $this->mergeDataKeluarga($familiesData)
        ] : [])
            ->with('aplicant', $applicantData);
    }
}
