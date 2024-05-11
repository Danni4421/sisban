@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content_header')
  <h1>Pengaturan</h1>
@endsection

@section('content')
  <div class="container-fluid">
    <hr>
    <ul>
      <li>
        <div class="item-header">
          <i class="fas fa-cog"></i>
          <span>Tampilan</span>
        </div>
        <div class="py-3">
          <div class="mb-3 d-flex gap-3 align-items-center w-25">
            <span>Tema</span>
            <select class="form-select" id="form-theme">
              <option value="light">Light</option>
              <option value="dark">Dark</option>
            </select>
          </div>
        </div>
      </li>
      <li>
        <div class="item-header">
          <i class="fas fa-font"></i>
          <span>Jenis Font</span>
        </div>
        <div class="py-3">
          <div class="mb-3 d-flex gap-3 align-items-center w-25">
            <span>Font</span>
            <select id="form-font" class="form-select">
              <option value="roboto">Roboto</option>
              <option value="poppins">Poppins</option>
              <option value="montserrat">Montserrat</option>
            </select>
          </div>
        </div>
      </li>
    </ul>
  </div>
@endsection

@push('styles')
  <style>
    ul {
      list-style: none
    }
    .item-header {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 1.3rem;
    }
  </style>
@endpush

@push('scripts')
  <script>
    (function() {
      const LOCAL_THEME = $('html').attr('data-theme');
      const LOCAL_FONT = $('html').attr('data-font');
      const FORM_THEME = document.getElementById('form-theme');
      const FORM_FONT = document.getElementById('form-font');

      for (let i = 0; i < FORM_THEME.options.length; i++) {
        if (FORM_THEME.options[i].value == LOCAL_THEME) {
          FORM_THEME.options[i].selected = true;
          break;
        }
      }

      for (let i = 0; i < FORM_FONT.options.length; i++) {
        if (FORM_FONT.options[i].value == LOCAL_FONT) {
          FORM_FONT.options[i].selected = true;
          break;
        }
      }

    })()

    $('#form-theme').on('change', function () {
      localStorage.setItem('theme', this.value);
      window.location.reload();
    });

    $('#form-font').on('change', function () {
      localStorage.setItem('font', this.value);
      window.location.reload();
    });
  </script>
@endpush

