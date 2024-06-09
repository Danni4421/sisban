<?php

namespace App\DataTables\RT\Bansos;

use App\Models\PenerimaBansos;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
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
            ->setRowId('id')
            ->addColumn('aksi', function (PenerimaBansos $penerimaBansos) {
                return "
                    <div class='d-flex gap-2'>
                        <button type='button' class='btn btn-primary detail_pengajuan_button' onclick='getDetailPenerima({$penerimaBansos->warga->nik}, {$penerimaBansos->bansos->id_bansos})' data-bs-toggle='modal' data-bs-target='#modalInformasiPenerima' data-pengajuan='{$penerimaBansos->warga->nik}' data-bansos='{$penerimaBansos->bansos->id_bansos}'>
                             <i class='fas fa-search'></i>
                            <span class='ms-1'>Lihat</span>
                        </button>
                        <button type='button' onclick='confirmDelete({$penerimaBansos->bansos->id_bansos}, {$penerimaBansos->warga->nik})' class='btn btn-danger'>
                           <i class='fa-solid fa-trash'></i> 
                            <span class='ms-1'>Hapus</span>
                        </button>
                    </div>";
            })
            ->rawColumns(['aksi']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PenerimaBansos $model): QueryBuilder
    {
        return $model->newQuery()->with('warga', 'bansos')
            ->whereHas('warga', function ($query) {
                $query->whereHas('keluarga', function ($query) {
                    $query->where('rt', substr(auth()->user()->pengurus->jabatan, 2));
                });
            });
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
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('warga.nik')->title('Nomor Induk Kependudukan'),
            Column::make('warga.nama')->title('Nama'),
            Column::make('warga.umur')->title('Umur'),
            Column::make('warga.no_hp')->title('Nomor Telepon'),
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
