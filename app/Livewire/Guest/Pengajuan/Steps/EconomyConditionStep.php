<?php

namespace App\Livewire\Guest\Pengajuan\Steps;

use App\Traits\Guest\Pengajuan\Forms\EconomyConditionForm;
use Spatie\LivewireWizard\Components\StepComponent;

class EconomyConditionStep extends StepComponent
{
    use EconomyConditionForm;

    public function __construct()
    {
        $this->load_from_session();
    }

    public function save()
    {
        $this->validate();
        $this->put_form_session();

        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.guest.pengajuan.steps.economy-condition-step');
    }
}
