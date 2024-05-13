<div>
    <ul class="list-group">
            @foreach($applicantsByRT as $applicantByRT)
            {{-- @dd($applicantByRT->rt) --}}
            <button style="background: none; border: none; outline: none; width: 100%" wire:click="update('{{$applicantByRT->rt}}')">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Pengajuan Baru Warga RT{{ $applicantByRT->rt}}
                    <span class="badge text-bg-primary rounded-circle">{{ $applicantByRT->jumlah }}</span>
                </li>
            </button>
            @endforeach
      </ul>
</div>
