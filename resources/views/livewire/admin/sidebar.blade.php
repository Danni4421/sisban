<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/img/Logo1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8; box-shadow: none !important;">
        <span class="brand-text font-weight-light">{{ $brand }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-3">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @foreach ($NAVIGATION_ITEM as $menu)
                    @if ($menu->func === 'root')
                        <li class="nav-header">{{ $menu->label }}</li>
                    @endif

                    @if (!empty($menu->children))
                        @foreach ($menu->children as $navItem)
                            <li class="nav-item">
                                <button
                                type="button"
                                class="nav-link text-start @if(in_array($activeItem, $navItem->active)) active @endif"
                                @if (empty($navItem->children))
                                    wire:click="updateActiveItem('/{{$navItem->href}}' @if ($navItem->with_level), {{$navItem->with_level}}@endif)"                                    
                                @endif
                                >
                                    <i class="nav-icon {{ $navItem->icon }}"></i>
                                    <p>
                                        {{ $navItem->label }}
                                        @if (!empty($navItem->children))
                                            <i class="fas fa-angle-left right"></i>
                                        @endif
                                    </p>
                                </button>

                                @if (!empty($navItem->children))
                                    <ul class="nav nav-treeview">
                                        @foreach ($navItem->children as $childItem)
                                            <li class="nav-item">
                                                <a class="nav-link" style="cursor: pointer"
                                                    wire:click="updateActiveItem('/{{$childItem->href}}' @if ($childItem->with_level), {{$childItem->with_level}}@endif)"                                    
                                                    >
                                                    <i class="nav-icon {{ $childItem->icon }}"></i>
                                                    <p>{{ $childItem->label }}</p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </nav>

        <div id="collapse-sidebar-account" class="collapse-sidebar-account collapse-sidebar-account-disabled">
            <ul class="nav nav-pills nav-sidebar flex-column pl-2 pb-3">
                @if ($level != 'admin')
                    <li class="nav-item">
                        <a href="{{ route('account.information') }}" class="nav-link" wire:click="updateActiveItem()">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Informasi Akun</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" wire:click="logout">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-account" id="sidebar-account">
            <div class="user-details">
                <img src="{{ asset('assets/img/avatar.png') }}" alt="User Account Profile"
                    class="img-circle elevation-1 img-profile">
                <div class="user-details-body">
                    <span class="brand-text font-weight-bold">{{ ucfirst(auth()->user()->username) }}</span>
                    @if (!is_null(auth()->user()))
                        {{-- <span class="brand-text font-weight-light">Ketua {{ strtoupper(auth()->user()->pengurus->jabatan) }}</span> --}}
                    @endif
                </div>
            </div>
            <i class="fas fa-angle-left right" id="arrow-sidebar-account"></i>
        </div>
    </div>
</aside>
