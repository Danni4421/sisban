<?php

namespace App\DataTables\RW;

use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PemohonDataTable extends DataTable
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
            ->addColumn('status_pengajuan', function (Pengajuan $pengajuan) {
                switch ($pengajuan->status_pengajuan) {
                    case "proses":
                        return "<span class='badge text-bg-warning'>Diproses</span>";
                    case "diterima":
                        return "<span class='badge text-bg-success'>Diterima</span>";
                    case "ditolak":
                        return "<span class='badge text-bg-danger'>Ditolak</span>";
                }
            })
            ->addColumn('aksi', function (Pengajuan $pengajuan) {
                $action = "
                    <div>
                        <button type='button' class='btn btn-primary detail_pengajuan_button' 
                            onclick='getDetailPengajuan({$pengajuan->no_kk})' data-bs-toggle='modal'
                            data-bs-target='#modal_detail_pengajuan' data-pengajuan='{$pengajuan->no_kk}'>
                            <i class='fas fa-search'></i>
                        </button>
                ";

                if ($pengajuan->status_pengajuan == 'diterima') {
                    $action .= "<button class='btn btn-success' onclick='downloadPDF({$pengajuan->no_kk})'><i class='fa fa-print'></i> Cetak</button>";
                } else {
                    $action .= "<button class='btn btn-success disabled'><i class='fa fa-print'></i> Cetak</button>";
                }
                
                return $action . "</div>";
            })
            ->rawColumns(['status_pengajuan', 'aksi']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pengajuan $model): QueryBuilder
    {
        return $model->newQuery()->with('keluarga.kepala_keluarga')->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pemohon-table')
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
            Column::make('no_kk')->title('Nomor Kartu Keluarga'),
            Column::make('keluarga.kepala_keluarga.nama')->title('Nama'),
            Column::make('keluarga.kepala_keluarga.umur')->title('Umur'),
            Column::make('keluarga.kepala_keluarga.no_hp')->title('Nomor Telepon'),
            Column::make('keluarga.rt')->title('RT'),
            Column::computed('status_pengajuan')->title('Status Pengajuan'),
            Column::computed('aksi')->title('Aksi')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pemohon_' . date('YmdHis');
    }
}
