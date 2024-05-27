<?php

namespace App\DataTables\RT;

use App\Models\Keluarga;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class KandidatDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id_alternative')
            ->addColumn('kepala_keluarga.foto_ktp', function (Keluarga $query) {
                $imageUrl = asset('assets/' . $query->kepala_keluarga->foto_ktp);
                $onclickModal = "showImage('{$imageUrl}')";
                return "<img 
                        src='{$imageUrl}' 
                        width='85.69px' 
                        height='53.98px' 
                        data-bs-toggle='modal' 
                        data-bs-target='#modal_image_show'
                        onclick=\"{$onclickModal}\"
                    />";
            })
            ->rawColumns(['kepala_keluarga.foto_ktp']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Keluarga $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['pengajuan', 'kepala_keluarga'])
            ->where('rt', substr(auth()->user()->pengurus->jabatan, 2))
            ->where('is_kandidat', 1);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('kandidat_tabel')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->selectStyleSingle()
            ->language(asset('assets/dataTable/lang/id.json'))
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('no_kk')->title('Nomor Kartu Keluarga'),
            Column::computed('kepala_keluarga.foto_ktp')->title('Foto KTP'),
            Column::make('kepala_keluarga.nik')->title('Nomor Induk Kependudukan')->orderable(false),
            Column::make('kepala_keluarga.nama')->title('Nama Kandidat')->orderable(false),
            Column::make('kepala_keluarga.no_hp')->title('Nomor Telepon')->orderable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Kandidat_' . date('YmdHis');
    }
}
