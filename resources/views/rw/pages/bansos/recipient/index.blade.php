@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h4>Data Penerima Bantuan Sosial</h4>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [],
      'active' => 'Penerima Bansos'
    ])
@endsection

@section('content')
<div class="container-fluid p-3 rounded-lg" style="background: #fff;">
    <section>
        <div class="d-flex justify-content-end">
            <a href="{{ url('rw/bansos/penerima/create') }}" class="btn btn-primary">
                <i class="fas fa-fw fa-plus"></i>
                <span>Tambah Penerima</span>
            </a>
        </div>

        {{ $dataTable->table() }}
    </section>
</div>
@endsection

@push('styles')
    <style>
        @media (min-width: 576px) {
            .dataTables_wrapper {
                margin-top: -70px;
            }
        }
    </style>
@endpush

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
                        }
                    })
                }
            });
        }
    </script>

    {{ $dataTable->scripts() }}
@endpush