<div class="form-check">
    <input 
        class="form-check-input" 
        type="radio" 
        id="{{ $name }}"
        name="{{ $name }}" 
        value="{{ $value }}"

        @if (!empty($checked) && ($checked == $value))
            checked
        @endif

        @if (!empty($model))
            wire:model="{{ $model }}" 
        @endif

        @if (!empty($disabled) && $disabled == 'true') disabled @endif
    />
    <label 
        class="form-check-label" 
        for="{{ $name }}"
        >
        {{ $content }}
    </label>
</div>