<div>
    @livewire('guest.wizard', ['formIndex' => 3])
    
    @props(['inputs'])

    <div class="mx-auto mt-5" style="width: 75%">
        @foreach ($inputs as $formIndex)
            <div class="row">
                <div class="col-12">

                    {{-- Header Form Per Index --}}
                    <h6 class="text-secondary mt-5">
                        Data Keluarga
                        <span>(Anggota Keluarga {{ $formIndex + 1 }})</span>
                    </h6>
                    <hr>

                    {{-- Input Nama Aset --}}
                    <x-form-group errorName="nama_aset.{{$formIndex}}" otherErrorName="nama_aset">
                        <x-label for="nama_aset.{{$formIndex}}">Nama Aset</x-label>
                        <x-input 
                            type="text" 
                            name="nama_aset.{{$formIndex}}" 
                            model="nama_aset.{{$formIndex}}"
                            placeholder="Masukkan nama aset Anda"
                        />
                    </x-form-group>
                    {{-- End Input Nama Aset --}}
                    
                    {{-- Input Tahun Beli Aset --}}
                    <x-form-group errorName="tahun_beli.{{$formIndex}}" otherErrorName="tahun_beli">
                        <x-label for="tahun_beli.{{$formIndex}}">Tahun Beli</x-label>
                        <x-input 
                            type="text"
                            maxLength="4"
                            name="tahun_beli.{{$formIndex}}"
                            model="tahun_beli.{{$formIndex}}"
                            placeholder="Masukkan pada tahun berapa Anda beli"
                        />
                    </x-form-group>
                    {{-- End Input Tahun Beli Aset --}}

                    {{-- Input Harga Jual Aset --}}
                    <x-form-group errorName="harga_jual.{{$formIndex}}" otherErrorName="harga_jual">
                        <x-label for="harga_jual.{{$formIndex}}">Harga Jual (Rp.)</x-label>
                        <x-input 
                            type="number"
                            name="harga_jual.{{$formIndex}}"
                            model="harga_jual.{{$formIndex}}"
                            placeholder="Masukkan harga jual dari aset"
                        />
                    </x-form-group>
                    {{-- End Input Harga Jual Aset --}}

                </div>
            </div>
        @endforeach
        
        {{-- CTA Button Tambah Form Aset --}}
        <button type="button" wire:click="addInput" class="btn btn-main my-4">
            Tambah Data Aset
        </button>
        
        {{-- Navigation Buttons --}}
        <div class="row mx-auto px-3 gap-3">
            <x-button type="button" class="col" action="previousStep" buttonColor="secondary">Kembali</x-button>
            <x-button type="button" class="col" action="save" buttonColor="main">Selanjutnya</x-button>
        </div>
    </div>
</div>
