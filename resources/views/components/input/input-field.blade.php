<div>
    <input class="form-control p-3 @if (!empty($class)) {{ $class }} @endif"
        type="{{ $type }}" @if (!empty($size)) size="{{ $size }}" @endif
        @if (!empty($minLength)) minlength="{{ $minLength }}" @endif
        @if (!empty($maxLength)) maxlength="{{ $maxLength }}" @endif
        @if (!empty($pattern)) pattern="{{ $pattern }}" @endif
        @if (!empty($placeholder)) placeholder="{{ $placeholder }}" @endif
        @if (!empty($name)) name="{{ $name }}" @endif
        @if (!empty($model)) wire:model.live="{{ $model }}" @endif
        @if (!empty($value)) value="{{ $value }}" @endif
        @if (!empty($disabled) && $disabled == 'true') disabled @endif 
    />
</div>