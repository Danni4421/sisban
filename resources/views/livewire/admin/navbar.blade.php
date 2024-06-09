<nav class="main-header navbar navbar-expand">

    {{-- Left Navigation Bar --}}
    <ul class="navbar-nav">

        {{-- Hamburges List Open Close Sidebar --}}
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    {{-- Right Navigation Bar --}}
    <ul class="navbar-nav ml-auto mr-3 align-items-center">

        {{-- If level is not equal 'admin' --}}
        @if (auth()->user()->level != "admin")
                {{-- Notification Menu --}}
                <li class="nav-item dropdown">
                    @if ($notification_element_user_level == 'rt')
                        @livewire('r-t.notification')
                    @elseif ($notification_element_user_level == 'rw')
                        @livewire('r-w.notification')
                    @endif
                </li>

                {{-- Fullscreen --}}
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                {{-- Account --}}
                <li class="nav-item dropdown">
                    <div class="ml-1" id="account_dropdown_menu_link">
                        <span class="mr-1 profile_text">{{ $user->pengurus->nama }}</span>
                        <img 
                            src="{{ asset('assets/img/person/kepala_keluarga_1.jpg') }}" 
                            class="rounded-circle dropdown-toggle"
                            id="profile_image"
                            alt="Profile Picture" 
                            role="button" 
                            width="36px" 
                            height="36px"
                        >
                        <span class="is_active_image_profile"></span>
                    </div>
                    <ul class="dropdown-menu" id="account_dropdown_menu">
                        <li class="nav-item d-flex justify-content-start align-items-center gap-0">
                            <a class="dropdown-item" href="{{ route('account.information', ['tab' => 'info']) }}">
                                <i class="fa-solid fa-user"></i>
                                Informasi Akun
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                {{-- If level is equal 'admin' --}}

                {{-- Account --}}
                <li class="nav-item dropdown">
                    <div class="ml-1" id="account_dropdown_menu_link">
                        <span class="mr-1 profile_text">{{ $user->username }}</span>
                        <img 
                            src="{{ asset('assets/img/person/kepala_keluarga_1.jpg') }}" 
                            class="rounded-circle dropdown-toggle"
                            id="profile_image"
                            alt="Profile Picture" 
                            role="button"
                            width="36px" 
                            height="36px"
                        >
                        <span class="is_active_image_profile"></span>
                    </div>
                    <ul class="dropdown-menu" id="account_dropdown_menu">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
        @endif
    </ul>
</nav>
