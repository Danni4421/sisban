<div>

    @php
        use Carbon\Carbon;
    @endphp

    <a class="nav-link" href="#" id="notification_cta">
        <i class="fa-solid fa-bell"></i>
        {{-- Notification Amount --}}
        @if ($notification_amount != 0)
            <span class="notification_amount" id="notification_amount">
                {{ $notification_amount }}
            </span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notification_popup" id="notification_box">

        {{-- Show how much notification exists --}}
        <span class="dropdown-item dropdown-header">
            {{ $notification_amount }} Notifications
        </span>

        {{-- Notification --}}
        @foreach ($notifications as $notification)
            <div class="dropdown-divider"></div>
            <a 
                href="#" 
                class="dropdown-item d-flex align-items-start justify-content-between" 
                style="font-size: .825rem;"
                wire:click="update('{{ Crypt::encrypt($notification->pengajuan->no_kk) }}')"
            >

                {{-- Notification Details --}}
                <div class="d-flex">
                    <i class="fa-solid fa-user mt-1 mr-2"></i> 
                    <p class="d-flex flex-column">
                        <span>
                            Pengajuan dari 
                            {{ $notification->pengajuan->keluarga->kepala_keluarga->nama }}
                        </span>
                        <span style="font-size: .57rem;">
                            {{ Carbon::parse($notification->created_at)->locale('id')->translatedFormat('l, h:i') }}
                        </span>
                    </p>
                </div>

                {{-- Created date --}}
                <span 
                    class="float-right text-muted text-sm"
                    style="font-size: .58rem !important;"
                >
                    {{ Carbon::parse($notification->created_at)->locale('id')->translatedFormat('d-m-Y') }}
                </span>
            </a>
        @endforeach

        <div class="dropdown-divider"></div>

        {{-- Redirecting to all notification page --}}
        <a href="{{ route('account.information', ['tab' => 'notification']) }}" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</div>