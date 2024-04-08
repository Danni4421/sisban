@extends('layouts.app')

@section('content_header')
  <h2>Data Ketua RT</h2>
@endsection

@section('content')
<div class="container">
  <!-- general form elements disabled -->
    <div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Data RT</h3>
    </div>
    <!-- /.card-header -->

    <form method="post" action="../update/{{ $data->id_pengurus }}">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}">
            </div>
            <div class="form-group">
              <label for="jabatan">Jabatan</label>
              <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $data->jabatan }}">
            </div>
            <div class="form-group">
              <label for="nomor_telepon">Nomor Telepon</label>
              <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ $data->nomor_telepon }}">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data->alamat }}">
              </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/rw/data-rt" class="btn btn-danger">Cancel</a>
        </div>
      </form>    
    <!-- /.card-body -->
    </div>
</div>
@endsection