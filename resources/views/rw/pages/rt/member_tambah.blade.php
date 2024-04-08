@extends('layouts.app')

@section('content_header')
  <h2>Data Ketua RT</h2>
@endsection

@section('content')
<div class="container">
  <!-- general form elements disabled -->
    <div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Tambah Data RT Baru</h3>
    </div>
    <!-- /.card-header -->

    <form method="post" action="../data-rt/store">

        {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
            </div>
            <div class="form-group">
              <label for="level">Level</label>
              <input type="text" class="form-control" id="level" name="level" placeholder="Masukkan Level">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
            </div>
            <div class="form-group">
              <label for="jabatan">Jabatan</label>
              <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan">
            </div>
            <div class="form-group">
              <label for="nomor_telepon">Nomor Telepon</label>
              <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Masukkan Nomor Telepon">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="../data-rt" class="btn btn-danger">Cancel</a>
        </div>
      </form>    
    <!-- /.card-body -->
    </div>
</div>
@endsection