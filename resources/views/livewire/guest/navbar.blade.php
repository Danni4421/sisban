<nav class="navbar navbar-expand-lg fixed-top px-3 " style="background-color: rgba(18, 23, 165, 0.75);">
    <div class="container-fluid">
        <div class="logo">
            <a href="/" alt="logo">
                <span class="d-flex items-center justify-content-center">
                    <img src="{{ asset('assets/img/Logo1_RBG.png') }}" style="width: 50px;">
                    <h2>Sisban</h2>
                </span>
            </a>
        </div>

        <nav id="navbar" class="navbar">
            @if (!empty($data))
                <ul class="nav">
                    @foreach ($data as $navItem)
                        @if (isset($navItem->children))
                            <li class="dropdown">
                                <a href="{{ $navItem->href }}">
                                    <span>
                                        {{ $navItem->label }}
                                    </span>
                                </a>
                                <ul>
                                    @foreach ($navItem->children as $childItem)
                                        <li class="nav-item">
                                            <a href="{{ $childItem->href }}">{{ $childItem->label }}</a>
                                            <i class="fas fa-angle-left right"></i>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ $navItem->href }}">{{ $navItem->label }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            @endif
        </nav>
    </div>
</nav>
