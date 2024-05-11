<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a  
                    class="nav-link @if($tab == "ask") active @endif" 
                    @if($tab == "ask") aria-current="true" @endif  
                    wire:click="updateActiveTab('ask')"
                    style="cursor: pointer">
                    Ajukan
                </a>
            </li>
            <li class="nav-item">
                <a 
                    class="nav-link @if($tab == "history") active @endif" 
                    @if($tab == "history") aria-current="true" @endif 
                    wire:click="updateActiveTab('history')"
                    style="cursor: pointer">
                    Riwayat
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body text-start">
        @if ($tab == "ask")
            <h6>Masukkan Pertanyaan: </h6>
            <form action="{{ route('general.store.faq') }}" method="POST" class="d-flex flex-column w-75">
                @csrf

                @if (session()->has('success'))
                    @livewire('admin.alert-message', ['class' => 'success', 'message' => session()->get('success')])
                @endif

                @error('pertanyaan')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                @enderror

                <textarea name="pertanyaan" id="pertanyaan" cols="60" rows="10" class="form-control mb-3 rounded"></textarea>
                <button type="submit" class="btn btn-primary">Ajukan Pertanyaan</button>
            </form>
        @elseif($tab == "history")
            @foreach ($faqs as $faq)
                <h6>Pertanyaan : </h6>
                <p>{{ $faq->pertanyaan }}</p>

                @if (!is_null($faq->jawaban))
                    <div class="answer w-75">
                        {{ $faq->jawaban }}
                    </div>           
                @else
                    <p class="unanswered-question">Belum terjawab</p>         
                @endif

                <hr>
            @endforeach
        @endif
    </div>
</div>

@push('styles')
    <style>
        .answer {
            padding: 8px;
            background-color: rgb(104, 104, 104);
            border-radius: 4px;
            color: #ffffff
        }

        .unanswered-question {
            color:rgb(104, 104, 104);
            font-style: italic; 
        }
    </style>
@endpush