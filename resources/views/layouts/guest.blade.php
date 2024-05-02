<!DOCTYPE html>
<html lang="en">

    @include('layouts.includes.guest.head')

    <body>
        <div id="header">
            @livewire('guest.navbar')
        </div>

        <div>
            @yield('content')
        </div>

        @livewire('guest.footer')
        @include('layouts.includes.guest.foot')
    </body>

</html>
