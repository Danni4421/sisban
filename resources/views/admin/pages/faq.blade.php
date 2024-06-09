@extends('layouts.app')

@section('title', 'Pertanyaan')

@section('content_header')
    <h1>Pertanyaan</h1>
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        {{ $dataTable->table() }}

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-title"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-faq" method="POST" data-id-faq="null">
                            <div class="question">
                                <b>Pertanyaan: </b>
                                <p id="question-text"></p>
                            </div>

                            <div class="answer d-flex flex-column">
                                <b>Jawaban: </b>
                                <textarea class="p-2" name="jawaban" id="answer-text" cols="30" rows="10" placeholder="Jawaban"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .dataTables_wrapper {
            margin-top: -15px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function showQuestionDetail(idFaq) {
            const route = `pertanyaan/${idFaq}`

            $.ajax({
                type: 'POST',
                url: route,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                    contentType: 'application/json'
                },
                success: function(response) {
                    updateModal(response);
                }
            });
        }

        function updateModal(faq) {
            $('#form-faq').attr('data-id-faq', faq.id_faq);
            $('#modal-title').text(`Pertanyaan dari ${faq.user.username}`);
            $('#question-text').text(faq.pertanyaan);
            $('#answer-text').val(faq.jawaban);
        }

        $('#form-faq').on('submit', function (e) {
            e.preventDefault();

            const idFaq = this.getAttribute('data-id-faq');
            const answer = $('#answer-text').val();
            
            const route = `pertanyaan/${idFaq}`

            $.ajax({
                type: 'PUT',
                url: route,
                data: {
                    jawaban: answer
                },
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                    contentType: 'application/json'
                },
                success: function(response) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                        Toast.fire({
                        icon: "success",
                        title: "Berhasil menambahkan jawaban"
                    });

                    $('#faq-table').DataTable().ajax.reload();
                }
            });
        });
    </script>

    {{ $dataTable->scripts() }}
@endpush
