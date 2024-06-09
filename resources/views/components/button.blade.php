<button 
    type="{{ $type }}" 
    class="btn btn-{{ $buttonColor }} @if (!empty($class)) {{ $class }} @endif"
    @if (!empty($action)) wire:click="{{ $action }}" @endif
    @if (!empty($onclick)) onclick="{{ $onclick }}" @endif  
>
    {{ $slot }}
</button>
