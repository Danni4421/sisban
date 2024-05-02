<?php

namespace App\Livewire\Guest\Pengajuan;

use Livewire\Attributes\On;
use App\Traits\Guest\Pengajuan\StayInStep;
use Spatie\LivewireWizard\Components\WizardComponent;
use Spatie\LivewireWizard\Exceptions\NoNextStep;
use Spatie\LivewireWizard\Exceptions\NoPreviousStep;

// Steps
use App\Livewire\Guest\Pengajuan\Steps\AplicantBiodataStep;
use App\Livewire\Guest\Pengajuan\Steps\FamilyDataStep;
use App\Livewire\Guest\Pengajuan\Steps\FamilyAssetsStep;
use App\Livewire\Guest\Pengajuan\Steps\EconomyConditionStep;
use App\Livewire\Guest\Pengajuan\Steps\PreviewFormStep;

class PengajuanWizardComponent extends WizardComponent
{
    use StayInStep;

    public function steps(): array
    {
        return [
            AplicantBiodataStep::class,
            FamilyDataStep::class,
            FamilyAssetsStep::class,
            EconomyConditionStep::class,
            PreviewFormStep::class,
        ];
    }

    #[On('previousStep')]
    public function previousStep(array $currentStepState)
    {
        $this->decreaseStepIndex();

        parent::previousStep($currentStepState);
    }

    #[On('nextStep')]
    public function nextStep(array $currentStepState)
    {
        $this->increaseStepIndex();
        
        parent::nextStep($currentStepState);
    }
}
