<nav class="navbar navbar-expand-lg fixed-top px-3 " style="background-color: rgba(18, 23, 165, 0.75);">
    <div class="container-fluid">
        <div class="logo">
            <a href="/" alt="logo">
                <span class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/img/Logo1_RBG.png') }}" style="width: 50px;">
                    <h2>Sisban</h2>
                </span>
            </a>
        </div>

        <nav id="navbar" class="navbar">
            @if (!empty($NAVIGATION_ITEMS))
                <ul class="nav">
                    @foreach ($NAVIGATION_ITEMS as $navItem)
                        @if (isset($navItem->children))
                            <li
                                class="nav-link 

                                    {{-- Jika user sudah login maka beberapa navigation item akan tidak ditampilkan --}}
                                    @if ($is_user_authed) 
                                        {{ $navItem->on_user_logged_in }}
                                    @endif 

                                    {{-- Jika punya childs, maka navigation item ini merupakan dropdown --}}
                                    @if (!empty($navItem->children)) 
                                        dropdown 
                                    @endif
                                ">
                                <a 
                                    href="{{ $navItem->href }}" 
                                    class="
                                        {{-- Jika merupakan item active maka akan memiliki class active --}}
                                        @if ($ACTIVE_ITEM == $navItem->active) active @endif 

                                        {{-- Jika merupakan dropdown maka akan diberikan toggle untuk menandakan bahwa merupakan item dropdown --}}
                                        @if (!empty($navItem->children)) dropdown-toggle @endif
                                    ">
                                    <span>
                                        {{ $navItem->label }}
                                    </span>
                                </a>
                                <ul>
                                    @foreach ($navItem->children as $childItem)
                                        <li class="nav-link">
                                            <a href="{{ $childItem->href }}" class="dropdown-item">{{ $childItem->label }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li
                                class="nav-link @if ($is_user_authed) {{ $navItem->on_user_logged_in }} @endif">
                                <a href="{{ $navItem->href }}" class="@if ($ACTIVE_ITEM == $navItem->active) active @endif">
                                    {{ $navItem->label }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    @if ($is_user_authed)
                        <li class="nav-link dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ $user->nama }}
                            </a>
                            <ul class="dropdown-menu" style="left: -2rem;">
                                <li class="nav-link">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <i class='bx bx-menu mobile-nav-toggle'></i>
            @endif
        </nav>
    </div>
</nav>
