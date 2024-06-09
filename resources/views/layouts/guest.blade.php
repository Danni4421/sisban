<!DOCTYPE html>
<html lang="en">

    @livewireStyles
    @include('layouts.includes.guest.head')

    <body>
        {{-- Pre loader --}}
        <div class="loader-container" id="loading">
            <span class="loader"></span>
        </div>
        
        <div id="header">
            @livewire('guest.navbar')
        </div>

        <div>
            @yield('content')
        </div>

        @livewireScripts
        @livewire('guest.footer')
        @include('layouts.includes.guest.foot')
    </body>

</html>
