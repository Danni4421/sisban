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
                wire:click="update('{{ Crypt::encrypt($notification->rt) }}')"
            >

                {{-- Notification Details --}}
                <div class="d-flex">
                    <i class="fa-solid fa-users mt-1 mr-2"></i> 
                    <p class="d-flex flex-column">
                        <span>
                            Pengajuan dari RT{{ $notification->rt }}
                        </span>
                        <span style="font-size: .57rem;">
                            Terakhir pada
                            {{ Carbon::parse($notification->waktu_pengajuan_terbaru)->locale('id')->translatedFormat('l, h:i') }}
                        </span>
                    </p>
                </div>

                {{-- Created date --}}
                <div class="d-flex flex-column align-items-end gap-1">
                    <span 
                        class="float-right text-muted text-sm"
                        style="font-size: .68rem !important;"
                    >
                        {{ Carbon::parse($notification->waktu_pengajuan_terbaru)->locale('id')->translatedFormat('d-m-Y') }}
                    </span>
                    <span 
                        id="amount_per_rt"
                        class="rounded-circle"
                    >
                        {{ $notification->jumlah }}
                    </span>
                </div>
            </a>
        @endforeach

        <div class="dropdown-divider"></div>

        {{-- Redirecting to all notification page --}}
        <a href="{{ route('account.information', ['tab' => 'notification']) }}" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</div>