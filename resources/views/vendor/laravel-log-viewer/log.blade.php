@extends('layouts.app')

@section('title', 'Logs')

@section('content_header')
    <h1>Logs</h1>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="row col-12 mb-3">
        <div class="col-4 rounded-lg">
          @foreach ($folders as $folder)
            <div class="list-group-item">
              <?php
              \Rap2hpoutre\LaravelLogViewer\LaravelLogViewer::DirectoryTreeStructure($storage_path, $structure);
              ?>

            </div>
          @endforeach
          @foreach ($files as $file)
            <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
              class="list-group-item @if ($current_file == $file) llv-active @endif">
              {{$file}}
            </a>
          @endforeach
        </div>
      </div>
      <div class="col-12 table-container">
        @if ($logs === null)
          <div>
            Log file >50M, please download it.
          </div>
        @else
          <table id="table-log" class="table table-striped" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
            <thead>
            <tr>
              @if ($standardFormat)
                <th>Level</th>
                <th>Context</th>
                <th>Date</th>
              @else
                <th>Line number</th>
              @endif
              <th>Content</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($logs as $key => $log)
              <tr data-display="stack{{{$key}}}">
                @if ($standardFormat)
                  <td class="nowrap text-{{{$log['level_class']}}}">
                    <span class="fa-solid fa-triangle-exclamation" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                  </td>
                  <td class="text">{{$log['context']}}</td>
                @endif
                <td class="date">{{{$log['date']}}}</td>
                <td class="text">
                  @if ($log['stack'])
                    <button type="button"
                            class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                            data-display="stack{{{$key}}}">
                      <span class="fa-solid fa-search"></span>
                    </button>
                  @endif
                  {{{$log['text']}}}
                  @if (isset($log['in_file']))
                    <br/>{{{$log['in_file']}}}
                  @endif
                  @if ($log['stack'])
                    <div class="stack" id="stack{{{$key}}}"
                        style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                    </div>
                  @endif
                </td>
              </tr>
            @endforeach

            </tbody>
          </table>
        @endif
        <div class="p-3">
          @if ($current_file)
            <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
              <span class="fa-solid fa-download"></span> Download file
            </a>
            -
            <a id="clean-log" href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
              <span class="fa-solid fa-sync"></span> Clean file
            </a>
            -
            <a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
              <span class="fa-solid fa-trash"></span> Delete file
            </a>
            @if (count($files) > 1)
              -
              <a id="delete-all-log" href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                <span class="fa fa-trash-alt"></span> Delete all files
              </a>
            @endif
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.table-container tr').on('click', function() {
                $('#' + $(this).data('display')).toggle();
            });
            $('#table-log').DataTable({
                "order": [$('#table-log').data('orderingIndex'), 'desc'],
                "stateSave": true,
                "stateSaveCallback": function(settings, data) {
                    window.localStorage.setItem("datatable", JSON.stringify(data));
                },
                "stateLoadCallback": function(settings) {
                    var data = JSON.parse(window.localStorage.getItem("datatable"));
                    if (data) data.start = 0;
                    return data;
                }
            });
            $('#delete-log, #clean-log, #delete-all-log').click(function() {
                return confirm('Are you sure?');
            });
        });
    </script>
@endpush
