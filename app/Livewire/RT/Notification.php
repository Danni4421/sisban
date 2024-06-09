<?php

namespace App\Livewire\Rt;

use App\Models\Notification as NotificationModel;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Notification extends Component
{
    public Collection $notifications;
    public int $notification_amount;

    public function mount()
    {
        $rt = substr(Auth::user()->pengurus->jabatan, 2);

       $this->notifications = NotificationModel::with('pengajuan.keluarga.kepala_keluarga')
            ->where('is_readed_rt', 0)
            ->whereHas('pengajuan.keluarga', function($query) use ($rt) {
                $query->where('rt', $rt);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $this->notification_amount = count($this->notifications);
    }

    public function update($encrypted_no_kk)
    {
        $no_kk = Crypt::decrypt($encrypted_no_kk);
        $aplicant = Pengajuan::findOrFail($no_kk);
        $aplicant->notification->is_readed_rt = true;
        $aplicant->notification->save();

        session()->put('activeSidebarItem', '/pengajuan/masuk');
        session()->put('redirected_notification_rt_no_kk', $aplicant->no_kk);

        return redirect()->route('rt.pengajuan.incoming');
    }

    public function render()
    {
        return view('livewire.rt.notification');
    }
}
