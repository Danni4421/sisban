<form action="" class="m-4">

    {{ $formWizard->render() }}

    <div class="card card-secondary">
        <div class="card-header">
            <h5 class="card-title">{{ $headerTitle }}</h5>
        </div>

        <div class="card-body px-4">
            @if ($currentStep == 1)
                @include('guest.components.forms.form-data-diri')
            @endif

            @if ($currentStep == 2)
                @include('guest.components.forms.form-data-keluarga')
            @endif

            <div class="row gap-3 mx-2 mt-3">
                <button type="button" class="col btn btn-secondary" wire:click="updateStep(-1)">Back</button>
                <button type="button" class="col btn btn-primary" wire:click="updateStep(1)">Next</button>
            </div>
        </div>
    </div>
</form>
