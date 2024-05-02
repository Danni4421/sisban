<?php

namespace App\Traits\Guest\Pengajuan;

trait StayInStep {

    public ?int $currentStepIndex;
    public int $maxStepIndex = 4;

    public function __construct()
    {
        $this->currentStepIndex = $this->getSessionState();
        $this->currentStepName = $this->stepNames()[$this->currentStepIndex];
    }
    
    public function getSessionState(): int
    {
        return session()->get('currentStepIndex') ?? 0;
    }

    public function increaseStepIndex(): void
    {
        $this->currentStepIndex++;

        if ($this->currentStepIndex > $this->maxStepIndex) {
            $this->currentStepIndex = $this->maxStepIndex;
        }

        session()->put('currentStepIndex', $this->currentStepIndex);
    }

    public function decreaseStepIndex(): void
    {
        $this->currentStepIndex--;

        if ($this->currentStepIndex < 0) {
            $this->currentStepIndex = 0;
        }

        session()->put('currentStepIndex', $this->currentStepIndex);
    }
}