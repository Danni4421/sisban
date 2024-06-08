<?php

namespace App\Livewire\Guest\Pengajuan;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\Guest\Pengajuan\FormDataDiri as HasFormDataDiri;
use App\Livewire\Guest\Wizard as FormWizard;

class MainWizardForm extends Component
{
    use HasFormDataDiri, WithFileUploads;

    /**
     * Form Wizard
     * 
     * @var FormWizard
     */
    private $formWizard;

    /**
     * @var int
     */
    public $currentStep = 1, $totalSteps = 4;

    /**
     * @var string
     */
    public $headerTitle;

    public function __construct()
    {
        $this->currentStep = session()->get('current-form-step') ?? 1;

        $this->formWizard = app()->make(FormWizard::class, ['formIndex' => $this->currentStep]);
    }

    public function updateStep($direction)
    {
        $this->currentStep = max(1, min($this->totalSteps, $this->currentStep + $direction));
        session()->put('current-form-step', $this->currentStep);

        $this->formWizard->update(newFormIndex: $this->currentStep);
    }

    public function render()
    {
        return view('livewire.guest.pengajuan.main-wizard-form')
            ->with('currentStep', $this->currentStep)
            ->with('headerTitle', $this->headerTitle)
            ->with('formWizard', $this->formWizard);
    }
}
