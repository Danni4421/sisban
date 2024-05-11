<?php

namespace App\DataTables\RW;

use App\Models\DataRt;
use App\Models\Pengurus;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DataRtDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('')
            ->addColumn('aksi', function (Pengurus $pengurus) {
                return "
                    <div class='d-flex gap-2'>
                        <a href='data-rt/{$pengurus->id_pengurus}/edit' class='btn btn-warning'>Edit</a>
                        <button type='button' onclick='confirmDelete({$pengurus->id_pengurus})' class='btn btn-danger'>
                            Hapus
                        </button>
                    </div>
                ";
            })
            ->rawColumns(['aksi']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pengurus $model): QueryBuilder
    {
        return $model->newQuery()->whereHas('user', function ($query) {
            $query->where('level', 'rt');
        });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('datart-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->selectStyleSingle()
                    ->addTableClass('table-striped table-hover')
                    ->language(asset('assets/dataTable/lang/id.json'))
                    ->buttons([]);;
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('nama')->title('Nama'),
            Column::make('jabatan')->title('Jabatan'),
            Column::make('nomor_telepon')->title('Nomor Telepon'),
            Column::make('alamat')->title('Alamat'),
            Column::computed('aksi')->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'DataRt_' . date('YmdHis');
    }
}
