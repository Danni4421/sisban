@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content_header')
  <header>
    <h1>Notifikasi</h1>
  </header>
@endsection

@section('content')
<main class="px-3">
  <hr>
  @livewire('rw.notification', ['applicantsByRT' => $applicantsByRT])

  {{-- <table class="table table-striped table-hover">
      <tbody>
          @foreach ($aplicants as $aplicant)
              <tr>
                  <td>{{ $aplicant->keluarga->no_kk }}</td>
                  <td>{{ $aplicant->keluarga->anggota_keluarga[0]->nama }}</td>
                  <td>{{ $aplicant->keluarga->anggota_keluarga[0]->umur }}</td>
                  <td>{{ $aplicant->keluarga->anggota_keluarga[0]->no_hp }}</td>
                  <td>
                      @if ($aplicant->status_pengajuan == 'diterima')
                          <span class="badge text-bg-success">Diterima</span>
                      @endif

                      @if ($aplicant->status_pengajuan == 'proses')
                          <span class="badge text-bg-warning">Diproses</span>
                      @endif

                      @if ($aplicant->status_pengajuan == 'ditolak')
                          <span class="badge text-bg-danger">Ditolak</span>
                      @endif
                  </td>
                  <td class="d-flex gap-2">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                          data-bs-target="#modal_detail_pemohon" data-aplicant="{{ $aplicant->no_kk }}"
                          id="detail_aplicant_button">
                          <i class="fas fa-search"></i>
                      </button>

                      <form action="{{ url('admin/pemohon/' . $aplicant->no_kk . '/approve') }}" method="POST">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-success">
                              <i class="fas fa-check"></i>
                          </button>
                      </form>
                      <form action="{{ url('admin/pemohon/' . $aplicant->no_kk . '/decline') }}" method="POST">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-danger">
                              <i class="fas fa-times"></i>
                          </button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table> --}}
</main>


@endsection

@push('styles')
  {{-- Custom styles --}}
@endpush

