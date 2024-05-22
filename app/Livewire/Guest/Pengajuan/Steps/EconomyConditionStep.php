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
        $this->load_from_session();

        $this->hutangIndex = session()->get('form-economy-loan-index') ?? 0;

        if (session()->has('form-economy-loan')) {
            $this->hutangs = session()->get('form-economy-loan');
        }
    }

    public function addHutang()
    {
        $this->hutangs[] = $this->hutangIndex;
        session()->put('form-economy-loan', $this->hutangs);
        session()->put('form-economy-loan-index', $this->hutangIndex);

        $this->hutangIndex++;
    }

    public function save()
    {
        $this->validate();
        $this->validate_image_request();

        $this->put_form_session();

        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.guest.pengajuan.steps.economy-condition-step');
    }
}
