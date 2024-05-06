<?php

namespace App\Livewire\Guest\Pengajuan\Steps;

use App\Traits\Guest\Pengajuan\Forms\FamilyAssetForm;
use Spatie\LivewireWizard\Components\StepComponent;

class FamilyAssetsStep extends StepComponent
{
    use FamilyAssetForm;

    public array $inputs = [];
    public int $inputIndex = 0;

    public function __construct()
    {
        if (session()->has('form-aset-input-index')) {
            $this->inputs = session()->get('form-aset-input-index');
        } else {
            $this->inputs[] = $this->inputIndex;
        }

        $this->load_from_session();
        $this->inputIndex++;
    }

    public function addInput()
    {
        $this->inputs[] = $this->inputIndex;
        session()->put('form-aset-input-index', $this->inputs);

        $this->inputIndex++;
    }

    public function save()
    {
        $this->validate();
        $this->put_form_session();

        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.guest.pengajuan.steps.family-assets-step');
    }
}
