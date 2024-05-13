<?php

namespace App\Livewire\RW;

use App\Models\Notification as NotificationModel;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Notification extends Component
{
    public $applicantsByRT;

    public function mount($applicantsByRT){
        $this->applicantsByRT = $applicantsByRT;
    }

    public function update(string $rt)
    {
        NotificationModel::with('pengajuan', function ($query) use ($rt) {
            $query->with('keluarga', function ($query) use ($rt) {
                $query->where('rt', $rt);
            });
        })->update([
            'is_readed_rw'=> 0
        ]);
        
        $aplicants = Pengajuan::whereHas('keluarga', function ($query) use ($rt) {
            $query->where('rt', $rt);
        })->with(['keluarga.anggota_keluarga'])->get();

        return  redirect('rw/pengajuan/masuk')->with('aplicants', $aplicants);
    }

    public function render()
    {
        return view('livewire.rw.notification');
    }
}
