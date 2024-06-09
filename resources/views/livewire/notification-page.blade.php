<div>

    @php
        use Carbon\Carbon;
    @endphp

    @foreach ($notifications as $notification)

    @php
        $updated_var = null;

        if ($level == "rt") {
            $updated_var = Crypt::encrypt($notification->no_kk);    
        } else if ($level == "rw") {
            $updated_var = Crypt::encrypt($notification->rt);
        }
    @endphp

        <div 
            class="card shadow-none border"
            style="cursor: pointer;" 
            wire:click="update_notification('{{$updated_var}}')"
        >
            <div class="card-body row row-cols-md-2 row-cols-1">
                <div class="col d-flex gap-3">
                    {{-- If level is equal RT --}}
                    @if ($level == "rt")
                        <div>
                            <img 
                            src="{{ asset('assets/img/person/kepala_keluarga_1.jpg') }}" 
                            alt="Profile Photo"
                            class="rounded-circle"
                            width="36px"
                            height="36px"
                        >
                        </div>
                        <div class="d-flex flex-column gap-2 justify-content-center">
                            <span>
                                Pengajuan dari {{ $notification->pengajuan->keluarga->kepala_keluarga->nama }}
                            </span>
                            <span style="color: #717171; margin-top: -9px;">
                                Pengajuan dilakukan pada {{ Carbon::parse($notification->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                            </span>
                        </div>
                    {{-- If level is equal RW --}}
                    @elseif ($level == "rw")
                        <div 
                            style="width: 36px; height: 36px; background-color: #dcdcdc" 
                            class="rounded-circle d-flex justify-content-center align-items-center"
                        >
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="d-flex flex-column gap-2 justify-content-center">
                            <span>
                                Pengajuan dari RT {{ $notification->rt }}
                            </span>
                            <span style="color: #717171; margin-top: -9px;">
                                Pengajuan terakhir dilakukan pada {{ Carbon::parse($notification->waktu_pengajuan_terbaru)->locale('id')->translatedFormat('l, d F Y') }}
                            </span>
                        </div>
                    @endif
                </div>
                <div class="col d-flex flex-column align-items-end">
                    @if ($level == "rt")
                        <span 
                            class="d-none d-md-flex"
                        >
                            {{ Carbon::parse($notification->created_at)->locale('id')->translatedFormat('H:i') }}
                        </span>    
                        <i 
                            class="notification 
                                @if ($notification->is_readed_rt == 1) is_readed 
                                @else is_not_readed 
                                @endif"
                        ></i>
                    @elseif ($level == "rw")                        
                        <span 
                            class="d-none d-md-flex"
                        >
                            {{ Carbon::parse($notification->waktu_pengajuan_terbaru)->locale('id')->translatedFormat('H:i') }}
                        </span> 
                        <i 
                            class="notification 
                                @if ($notification->is_readed_rw == 1) is_readed 
                                @else is_not_readed 
                                @endif"
                        ></i>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

@push('styles')
    <style>
        .notification {
            width: 1.2rem;
            height: 1.2rem;
            border-radius: 50%;
        }

        .is_not_readed {
            background-color: rgb(72, 72, 255);
        }

        .is_readed {
            background-color: #717171
        }
    </style>
@endpush