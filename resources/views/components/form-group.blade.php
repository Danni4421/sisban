<div class="@if (!empty($class)) {{ $class }} @endif">
    <div class="form-group">
        {{ $slot }}
    </div>

    @if (isset($otherErrorName))
        @error($otherErrorName)
            <div>
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
    @endif

    @error($errorName)
        <div>
            <span class="text-danger">{{ $message }}</span>
        </div>
    @enderror
</div>
