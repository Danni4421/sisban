<div>
    <button type="button" class="btn btn-primary detail_pengajuan_button" onclick="getDetailPengajuan({{$pengajuan->no_kk}})"  data-bs-toggle="modal"
        data-bs-target="#modal_detail_pengajuan" data-pengajuan="{{$pengajuan->no_kk}}">
        <i class="fas fa-search"></i>
        <span class="ms-1">Lihat</span>
    </button>

    @if ($pengajuan->status_pengajuan == 'diterima' || $pengajuan->status_pengajuan == 'ditolak')
        <button class='btn btn-success' disabled='disabled'>
            <i class='fa fa-check'></i>
            <span class="ms-1">Terima</span>
        </button>
        <button class='btn btn-danger' disabled='disabled'>
            <i class='fa fa-times-circle'></i>
            <span class="ms-1">Tolak</span>
        </button>
    @else
        <button type="button" class="btn btn-success" onclick="confirmApprove({{$pengajuan->no_kk}})">
            <i class='fa fa-check'></i>
            <span class="ms-1">Terima</span>
        </button>
        <button type="button" class="btn btn-danger" onclick="confirmDecline({{$pengajuan->no_kk}})">
            <i class='fa fa-times-circle'></i>
            <span class="ms-1">Tolak</span>
        </button>
    @endif
</div>