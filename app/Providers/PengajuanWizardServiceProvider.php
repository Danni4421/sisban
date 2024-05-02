<?php

namespace App\Providers;

use App\Livewire\Guest\Pengajuan\PengajuanWizardComponent;
use App\Livewire\Guest\Pengajuan\Steps\AplicantBiodataStep;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class PengajuanWizardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Livewire::component('pengajuan-wizard', PengajuanWizardComponent::class);
        Livewire::component('aplicant-biodata-step', AplicantBiodataStep::class);
    }
}
