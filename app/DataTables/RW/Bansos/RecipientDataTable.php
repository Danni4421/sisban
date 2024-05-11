<?php

namespace App\DataTables\RW\Bansos;

use App\Models\PenerimaBansos;
use App\Models\Recipient;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RecipientDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('nik')
            ->addColumn('aksi', function (PenerimaBansos $penerimaBansos) {
                return "
                    <div>
                        <a href='/rw/bansos/{$penerimaBansos->bansos->id_bansos}/penerima/{$penerimaBansos->warga->nik}/edit'
                            class='btn btn-warning'>Edit
                        </a>
                        <button 
                            type='button' 
                            onclick='confirmDelete({$penerimaBansos->warga->nik},{$penerimaBansos->bansos->id_bansos})' 
                            class='btn btn-danger'>
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
    public function query(PenerimaBansos $model): QueryBuilder
    {
        return $model->newQuery()->with('warga.keluarga', 'bansos')->orderBy('tanggal_penerimaan', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('recipient-table')
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
            Column::make('warga.nama')->title('Nama'),
            Column::make('warga.nik')->title('Nomor Induk Kependudukan'),
            Column::make('warga.no_hp')->title('Nomor Telepon'),
            Column::make('bansos.nama_bansos')->title('Jenis Bansos'),
            Column::computed('aksi')->title('Aksi')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Recipient_' . date('YmdHis');
    }
}
