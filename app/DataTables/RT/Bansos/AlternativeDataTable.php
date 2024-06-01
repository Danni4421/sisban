<?php

namespace App\DataTables\RT\Bansos;

use App\Models\Alternative;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AlternativeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('no_kk')
            ->addColumn('kandidat.kepala_keluarga.foto_ktp', function (Alternative $query) {
                $imageUrl = asset('assets/' . $query->kandidat->kepala_keluarga->foto_ktp);
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
            ->addColumn('is_qualified', function (Alternative $query) {
                if ($query->is_qualified) {
                    return "<span class='badge text-bg-success'>Tepat</span>";
                } else {
                    return "<span class='badge text-bg-danger'>Kurang Tepat</span>";
                }
            })
            ->addColumn('action', function (Alternative $query) {
                $url = route('rt.bansos.perhitunganFuzzy', ['id_bansos' => $query->id_bansos, 'no_kk' => $query->no_kk]);
                return "<a href='$url' class='btn btn-info btn-sm'><i class='fas fa-calculator'></i> Perhitungan Fuzzy</a>";
            })
            ->rawColumns(['kandidat.kepala_keluarga.foto_ktp', 'is_qualified', 'action']);

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Alternative $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('kandidat.kepala_keluarga')
            ->whereHas('kandidat', function ($query) {
                $query->where('rt', substr(auth()->user()->pengurus->jabatan, 2));
            })
            ->where('id_bansos', $this->id_bansos);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('alternative-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::make('kandidat.kepala_keluarga.nama')->title('Nama Alternatif')->orderable(false),
            Column::computed('kandidat.kepala_keluarga.foto_ktp')->title('Foto KTP'),
            Column::computed('is_qualified')->title('Status')->orderable(false),
            Column::computed('action')->title('Aksi')->orderable(false)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Alternative_' . date('YmdHis');
    }
}
