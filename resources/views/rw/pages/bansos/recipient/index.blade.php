@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <header>
        <h1>Data Penerima Bantuan Sosial</h1>
    </header>
@endsection

@section('content')
<div class="container-fluid">

    <div>
        <div class="d-flex justify-content-end">
            <a href="{{ url('rw/bansos/penerima/create') }}" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Penerima</a>
        </div>

        {{ $dataTable->table() }}
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(nik, idBansos) {
            Swal.fire({
                title: "Yakin untuk menghapus penerima bantuan sosial?",
                text: "Tindakan ini akan menghapus penerimaan bantuan sosial!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ url('rw/bansos/${idBansos}/penerima/${nik}') }}`,
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                            contentType: 'application/json'
                        },
                        success: function () {
                            Swal.fire({
                                title: "Penerima Bansos dihapus!",
                                text: "Penerima bansos berhasil dihapus.",
                                icon: "success"
                            });
                            
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000)
                        }
                    })
                }
            });
        }
    </script>

    {{ $dataTable->scripts() }}
@endpush