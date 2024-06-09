<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NotificationPage extends Component
{
    public $notifications;
    public $level;

    public function mount()
    {
        $this->level = Auth::user()->level;

        if ($this->level == "rt") {
            $rt = substr(Auth::user()->pengurus->jabatan, 2);

            $this->notifications = Notification::with('pengajuan.keluarga.kepala_keluarga')
                ->whereHas('pengajuan.keluarga', function($query) use ($rt) {
                    $query->where('rt', $rt);
                })
                ->orderBy('is_readed_rt', 'asc')
                ->get();
        } elseif ($this->level == "rw") {
            $this->notifications = Pengajuan::join('keluarga', 'pengajuan.no_kk', '=', 'keluarga.no_kk')
                ->join('notification', 'pengajuan.no_kk', '=', 'notification.no_kk')
                ->selectRaw('keluarga.rt as rt, COUNT(*) as jumlah, MIN(notification.created_at) as waktu_pengajuan_terbaru, MIN(notification.is_readed_rw) as is_readed_rw')
                ->orderBy(DB::raw('MIN(notification.is_readed_rw)'), 'desc')
                ->groupBy('keluarga.rt')
                ->get();
        }
    }

    public function update_notification($id)
    {
        $param = Crypt::decrypt($id);

        if ($this->level == "rt") {
            Notification::where('no_kk', $param)->update([
                'is_readed_rt' => 1,
            ]);

            $aplicant = Pengajuan::findOrFail($param);
            $aplicant->notification->is_readed_rt = true;
            $aplicant->notification->save();

            session()->put('activeSidebarItem', '/pengajuan/masuk');
            session()->put('redirected_notification_rt_no_kk', $aplicant->no_kk);

            return redirect()->route('rt.pengajuan.incoming');
            
        } else if ($this->level == "rw") {
            Notification::whereHas('pengajuan.keluarga', function ($query) use ($param) {
                $query->where('rt', $param);
            })->update([
                'is_readed_rw' => 1,
            ]);

            $aplicants = Pengajuan::whereHas('keluarga', function ($query) use ($param) {
                $query->where('rt', $param);
            })->with(['keluarga.anggota_keluarga'])->get();
    
            $aplicants_no_kk = array_map(function ($aplicant) {
                return $aplicant["no_kk"];
            }, $aplicants->toArray());
    
            session()->put('activeSidebarItem', '/pemohon');
            session()->put('redirected_notification_rw_no_kk', $aplicants_no_kk);
    
            return  redirect()->route('rw.aplicant.approved');
        }
    }

    public function render()
    {
        return view('livewire.notification-page');
    }
}
