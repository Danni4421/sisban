<div>
    <ul class="list-group">
        @foreach($aplicants as $aplicant)
            <button style="background: none; border: none; outline: none; width: 100%" wire:click="update({{$aplicant->no_kk}})">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Pengajuan Baru
                    @if ($aplicant->notification->is_readed_rt == '0')
                        <span class="badge text-bg-primary text-primary rounded-circle" style="--bs-text-opacity: .1;">O</span>
                    @endif
            
                    @if ($aplicant->notification->is_readed_rt == '1')
                        <span class="badge text-bg-secondary text-secondary rounded-circle" style="--bs-text-opacity: .1;">O</span>
                    @endif
                </li>
            </button>
        @endforeach
    </ul>
</div>