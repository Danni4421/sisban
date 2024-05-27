<?php

namespace App\Livewire\Rw;

use App\Models\Notification as NotificationModel;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Notification extends Component
{
    public $applicantsByRT;

    public function mount($applicantsByRT)
    {
        $this->applicantsByRT = $applicantsByRT;
    }

    public function update(string $rt)
    {
        NotificationModel::with('pengajuan', function ($query) use ($rt) {
            $query->with('keluarga', function ($query) use ($rt) {
                $query->where('rt', $rt);
            });
        })->update([
            'is_readed_rw' => 1,
        ]);

        $aplicants = Pengajuan::whereHas('keluarga', function ($query) use ($rt) {
            $query->where('rt', $rt);
        })->with(['keluarga.anggota_keluarga'])->get();

        $aplicants_no_kk = array_map(function ($aplicant) {
            return $aplicant["no_kk"];
        }, $aplicants->toArray());

        session()->put('activeSidebarItem', '/pemohon');
        session()->put('redirected_notification_rw_no_kk', $aplicants_no_kk);

        return  redirect()->route('rw.aplicant.approved');
    }

    public function render()
    {
        return view('livewire.rw.notification');
    }
}
