<?php

namespace App\DataTables\RT;

use App\Models\Keluarga;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class KeluargaDataTable extends DataTable
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
            ->addColumn('action', function(Keluarga $keluarga) {
                return 
                    "<div>
                        <button type='submit' class='btn btn-danger' onclick='deleteKeluarga({$keluarga->no_kk})'> 
                            <i class='fa-solid fa-trash'></i>
                            <span class='ms-1'>Hapus</span>
                        </button>
                    </div>";
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Keluarga $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('kepala_keluarga.account')
            ->where('rt', substr(auth()->user()->pengurus->jabatan, 2));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('keluarga-table')
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
            Column::make('no_kk')->title('Nomor Kartu Keluarga'),
            Column::make('kepala_keluarga.nama')->title('Nama')->orderable(false),    
            Column::make('kepala_keluarga.account.username')->title('Username')->orderable(false),
            Column::make('kepala_keluarga.account.email')->title('Email')->orderable(false),
            Column::computed('action')->title('Aksi')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Keluarga_' . date('YmdHis');
    }
}
