<?php

namespace App\DataTables\RT\Bansos;

use App\Models\Alternative;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AlternativeDataTable extends DataTable
{
    public $image_width = 85.69;
    public $image_height = 53.98;

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
                        width='{$this->image_width}px' 
                        height='{$this->image_height}px' 
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
                $url = route('rt.bansos.fuzzy', ['id_bansos' => $query->id_bansos, 'no_kk' => $query->no_kk]);
                return "<a href='$url' class='btn btn-info btn-sm text-center'>
                        <i class='fas fa-calculator fs-5 mr-2'></i> 
                        <span>Perhitungan Fuzzy</span>
                    </a>";
            })
            ->rawColumns(['kandidat.kepala_keluarga.foto_ktp', 'is_qualified', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Alternative $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->with('kandidat.kepala_keluarga', 'bansos')
            ->whereHas('kandidat', function ($query) {
                $query->where('rt', substr(auth()->user()->pengurus->jabatan, 2));
            })
            ->where('id_bansos', $this->id_bansos)
            ->orderByDesc('is_qualified');

        foreach ($this->getColumns() as $column) {
            if ($column->orderable) {
                $query->orderBy($column->data);
            }
        }

        return $query;
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
            ->selectStyleSingle()
            ->addTableClass('table-striped table-hover')
            ->language(asset('assets/dataTable/lang/id.json'))
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('no_kk')->title('Nomor Kartu Keluarga')->orderable(true),
            Column::make('kandidat.kepala_keluarga.nama')->title('Nama Alternatif')->orderable(false),
            Column::computed('kandidat.kepala_keluarga.foto_ktp')->title('Foto KTP')->orderable(false),
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
