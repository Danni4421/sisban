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
                                class="nav-link dropdown @if ($is_user_authed) {{ $navItem->on_user_logged_in }} @endif">
                                <a href="{{ $navItem->href }}" class="@if ($ACTIVE_ITEM == $navItem->active) active @endif">
                                    <span>
                                        {{ $navItem->label }}
                                    </span>
                                </a>
                                <ul>
                                    @foreach ($navItem->children as $childItem)
                                        <li class="nav-link">
                                            <a href="dropdown-item {{ $childItem->href }}">{{ $childItem->label }}</a>
                                            <i class="fas fa-angle-left right"></i>
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
                            <ul class="dropdown-menu">
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
