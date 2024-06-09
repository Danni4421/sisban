<!DOCTYPE html>
<html lang="en">

    @livewireStyles
    @include('layouts.includes.guest.head')

    <body>
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
