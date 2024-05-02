<button 
    type="{{ $type }}" 
    class="btn btn-{{ $buttonColor }} @if (!empty($class)) {{ $class }} @endif"
    wire:click="{{ $action }}"
>
    {{ $slot }}
</button>
