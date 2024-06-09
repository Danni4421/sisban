<?php

namespace App\Livewire\Guest\Pengajuan\Steps;

use App\Traits\Guest\Pengajuan\Forms\FamilyAssetForm;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Spatie\LivewireWizard\Components\StepComponent;

class FamilyAssetsStep extends StepComponent
{
    use WithFileUploads, FamilyAssetForm;

    public array $inputs = [];
    public int $inputIndex = 0;

    public function __construct()
    {
        $this->load_data();

        if (session()->has('form-asset-input-index')) {
            $this->inputIndex = session()->get('form-asset-input-index');
        }

        $this->inputs = $this->inputIndex > 0 ? range(0, $this->inputIndex - 1) : [0];
    }

    public function addInput()
    {
        $this->inputs[] = $this->inputIndex;
        session()->put('form-aset-input-index', $this->inputIndex);
        
        $this->inputIndex++;
    }

    public function save()
    {
        $this->validate();
        $this->update_aset();

        $this->dispatch('alert', 'Berhasil memperbarui data Aset');
    }

    public function saveAndNext() {
        $this->validate();
        $this->update_aset();

        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.guest.pengajuan.steps.family-assets-step');
    }
}
