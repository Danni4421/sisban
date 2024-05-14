<div>
    @livewire('guest.wizard', ['formIndex' => 4])
    
    <div class="mx-auto my-5 form-step">
        
        {{-- Form --}}
        <div class="row">
            {{-- Input Daya Listrik --}}
            <x-form-group errorName="daya_listrik" class="mb-3">
                <x-label for="daya_listrik">Daya Listrik</x-label>
                <select name="daya_listrik" id="daya_listrik" class="form-control p-3" wire:model="daya_listrik">
                    <option selected>Pilih Daya Listrik...</option>
                    <option value="none">Tidak Punya Listrik</option>
                    <option value="450">450 Watt</option>
                    <option value="900">900 Watt</option>
                    <option value="1300">1300 Watt</option>
                </select>
            </x-form-group>
            {{-- End Input Daya Listrik --}}

             {{-- Input Biaya Listrik --}}
             <x-form-group errorName="biaya_listrik" class="mb-3">
                <x-label for="biaya_listrik">Biaya Listrik</x-label>
                <x-input 
                    type="text" 
                    name="biaya_listrik" 
                    model="biaya_listrik"
                    placeholder="Masukkan daya listrik rumah Anda saat ini"
                />
            </x-form-group>
            {{-- End Input Biaya Listrik --}}

            {{-- Input Biaya Air --}}
            <x-form-group errorName="biaya_air" class="mb-3">
                <x-label for="biaya_air">Biaya Air</x-label>
                <x-input 
                    type="text" 
                    name="biaya_air" 
                    model="biaya_air"
                    placeholder="Masukkan biaya air rumah Anda saat ini"
                />
            </x-form-group>
            {{-- End Input Biaya Air --}}

            {{-- Input Hutang --}}
            <x-form-group errorName="hutang" class="mb-3">
                <x-label for="hutang">Hutang</x-label>
                <x-input 
                    type="text" 
                    name="hutang" 
                    model="hutang"
                    placeholder="Masukkan hutang yang Anda miliki"
                />
            </x-form-group>
            {{-- End Input Hutang --}}

            <x-form-group errorName="pengeluaran" class="mb-3">
                <x-label for="pengeluaran">Pengeluaran per Bulan</x-label>
                <x-input 
                    type="text" 
                    name="pengeluaran" 
                    model="pengeluaran"
                    placeholder="Masukkan pengeluaran Anda perbulan"
                />
            </x-form-group>
            {{-- End Input Hutang --}}
        </div>
        
        {{-- Navigation Buttons --}}
        <div class="row mx-auto mt-3 gap-3">
            <x-button type="button" class="col" action="previousStep" buttonColor="secondary">Kembali</x-button>
            <x-button type="button" class="col" action="save" buttonColor="main">Ajukan</x-button>
        </div>
    </div>
</div>
