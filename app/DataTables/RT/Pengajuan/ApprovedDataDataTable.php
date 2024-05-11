<?php

namespace App\DataTables\RT\Pengajuan;

use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ApprovedDataDataTable extends DataTable
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
            ->addColumn('status_pengajuan', function (Pengajuan $pengajuan) {
                return "<span class='badge text-bg-success'>Disetujui</span>";
            })
            ->addColumn('aksi', function (Pengajuan $pengajuan) {
                return "<button type='button' class='btn btn-primary detail_pengajuan_button' onclick='getDetailPengajuan({$pengajuan->no_kk})'  data-bs-toggle='modal'
                    data-bs-target='#modal_detail_pengajuan' data-pengajuan='{$pengajuan->no_kk}'>
                    <i class='fas fa-search'></i>
                </button>";
            })
            ->rawColumns(['status_pengajuan', 'aksi']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pengajuan $model): QueryBuilder
    {
        return $model->newQuery()->with('keluarga.kepala_keluarga')
            ->where('status_pengajuan', 'diterima')
            ->whereHas('keluarga', function ($query) {
                $query->where('rt', substr(auth()->user()->pengurus->jabatan, 2));
            });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('approved-data-table')
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
            Column::make('keluarga.kepala_keluarga.nama')->title('Nama'),
            Column::make('keluarga.kepala_keluarga.umur')->title('Umur'),
            Column::make('keluarga.kepala_keluarga.no_hp')->title('Nomor Telepon'),
            Column::computed('status_pengajuan')->title('Status Pengajuan'),
            Column::computed('aksi')->title('Aksi')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ApprovedData_' . date('YmdHis');
    }
}
