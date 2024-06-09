<div>
    <input class="form-control p-3 @if (!empty($class)) {{ $class }} @endif"
        type="{{ $type }}" @if (!empty($size)) size="{{ $size }}" @endif
        @if (!empty($minLength)) minlength="{{ $minLength }}" @endif
        @if (!empty($maxLength)) maxlength="{{ $maxLength }}" @endif
        @if (!empty($pattern)) pattern="{{ $pattern }}" @endif
        @if (!empty($placeholder)) placeholder="{{ $placeholder }}" @endif
        @if (!empty($name)) name="{{ $name }}" @endif
        @if (!empty($id)) id="{{ $id }}" @endif
        @if (!empty($model)) wire:model="{{ $model }}" @endif
        @if (!empty($wireInput)) wire:input.debounce.500ms="{{ $wireInput }}" @endif
        @if (!empty($value)) value="{{ $value }}" @endif
        @if (!empty($disabled) && $disabled == 'true') disabled @endif 
        @if (!empty($readonly) && $readonly == 'true') readonly @endif 
        @if (!empty($required) && $required == 'true') required @endif 
    />
</div>
