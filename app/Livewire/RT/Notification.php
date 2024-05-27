<?php

namespace App\Livewire\Rt;

use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Notification extends Component
{
    public Collection $aplicants;

    public function mount(Collection $aplicants)
    {
        $this->aplicants = $aplicants;
    }

    public function update($no_kk)
    {
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
