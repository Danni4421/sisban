<?php

namespace App\Livewire\Rw;

use App\Models\Notification as NotificationModel;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Notification extends Component
{
    public Collection $notifications;
    public int $notification_amount;

    public function mount()
    {
        $this->notifications = Pengajuan::join('keluarga', 'pengajuan.no_kk', '=', 'keluarga.no_kk')
            ->join('notification', 'pengajuan.no_kk', '=', 'notification.no_kk')
            ->selectRaw('keluarga.rt as rt, COUNT(*) as jumlah, MIN(notification.created_at) as waktu_pengajuan_terbaru')
            ->where('notification.is_readed_rw', '0')
            ->groupBy('keluarga.rt')
            ->get();

        $this->notification_amount = count($this->notifications);
    }

    public function update($encrypted_rt)
    {
        $rt = Crypt::decrypt($encrypted_rt);
        
        NotificationModel::whereHas('pengajuan.keluarga', function ($query) use ($rt) {
            $query->where('rt', $rt);
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
