<?php

namespace App\Livewire\Guest\Pengajuan\Steps;

use App\Traits\Guest\Pengajuan\Forms\EconomyConditionForm;
use Livewire\WithFileUploads;
use Spatie\LivewireWizard\Components\StepComponent;

class EconomyConditionStep extends StepComponent
{
    use WithFileUploads, EconomyConditionForm;

    public array $hutangs = [];
    public int $hutangIndex = 0;

    public function __construct()
    {
        $this->load_data();

        if (session()->has('form-economy-loan-index')) {
            $this->hutangIndex = session()->get('form-economy-loan-index');
        }

        $this->hutangs = $this->hutangIndex > 0 ? range(0, $this->hutangIndex - 1) : [];
    }

    public function addHutang()
    {
        $this->hutangs[] = $this->hutangIndex;
        session()->put('form-economy-loan-index', $this->hutangIndex);

        $this->hutangIndex++;
    }

    public function save()
    {
        $this->validate();
        $this->update_data();

        $this->dispatch('alert', 'Berhasil menyimpan informasi Kondisi Ekonomi');
    }

    public function saveAndNext()
    {
        $this->validate();
        $this->update_data();

        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.guest.pengajuan.steps.economy-condition-step');
    }
}
