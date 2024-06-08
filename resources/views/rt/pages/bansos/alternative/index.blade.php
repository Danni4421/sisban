@extends('layouts.app')

@section('title', 'Jenis Bansos')

@section('content_header')
    <h4>Alternatif Penerima {{ $bansos->nama_bansos }}</h4>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [
        ['href' => route('rt.bansos'), 'label' => 'Bantuan Sosial']
      ],
      'active' => 'Alternatif'
    ])
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <div class="d-flex justify-content-end">
            <button 
                type="button" 
                class="btn btn-primary"
                id="btn_add_alternative"
                data-bansos="{{ $bansos->id_bansos }}"
                data-bs-toggle="modal" 
                data-bs-target="#modalAlternative"
            >
                <i class="fas fa-plus"></i>
                <span class="ms-1">Tambah Alternatif</span>
            </button>
            <!-- Tombol Perhitungan Topsis -->
            <a href="{{ route('topsis.index', ['id_bansos' => $bansos->id_bansos]) }}" 
                class="btn btn-success ms-2">
                <i class="fas fa-calculator"></i>
                <span class="ms-1">Perhitungan Topsis</span>
            </a>
        </div>

        <div>
            {{ $dataTable->table() }}
        </div>

        <a href="{{ route('rt.bansos') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="ms-1">Kembali</span>
        </a>
    </div>
  
    {{-- Modal Alternative --}}
    <div class="modal fade" id="modalAlternative" tabindex="-1" aria-labelledby="Alternative Modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h4>Kandidat Alternatif</h4>
                    </div>
                    <div id="alternative_body" class="d-flex flex-column gap-2">
                        {{-- Alternative --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_image_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
            <img src="#" id="image_show">
            </div>
        </div>
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
        $(document).ready(function() {
            $('#btn_add_alternative').on('click', function (e) {
                const bansos = this.getAttribute("data-bansos");
                const routeUrl = `{{ url('/rt/bansos') }}/${bansos}/kandidat/list`;
                
                $.ajax({
                    type: 'POST',
                    url: routeUrl,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        printIntoModal(response, bansos);
                    }
                });
            });

            function printIntoModal(candidates, bansos) {
                $('#alternative_body').html('');
                if (candidates.length === 0) {

                } else {
                    candidates.forEach((candidate) => {
                        $('#alternative_body').append(`
                            <div class="d-flex justify-content-between align-items-center p-2 border candidate" id="${candidate.no_kk}">
                                <p class="fs-4">${candidate.kepala_keluarga.nama}</p>
                                <button type="button" class="btn btn-success" onclick="addToAlternative('${candidate.no_kk}', '${bansos}')">+</button>
                            </div>
                        `)
                    });
                }
            }
        });

        function addToAlternative(noKK, idBansos) {
            const routeUrl = `{{ url('/rt/bansos') }}/${idBansos}/kandidat/${noKK}/to/alternative`;

            $.ajax({
                type: 'POST',
                url: routeUrl,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success === true) {
                        $('#alternative-table').DataTable().ajax.reload();
                        $(`#${noKK}`).remove();
                    }

                    if ($('.candidate').length === 0) {
                        $('#modalAlternative').modal('hide').on('hidden.bs.modal', function (e) {
                            $(this).remove();
                            $('.modal-backdrop').remove();
                        });
                    }
                }
            });
        }

        function deleteAlternative(noKK, idBansos) {
            const routeUrl = `{{ url('/rt/bansos') }}/${idBansos}/alternative/${noKK}`;
        }

        function showImage(name) {
            $('#image_show').attr('src', name);
        }
    </script>

    {{ $dataTable->scripts() }}
@endpush
