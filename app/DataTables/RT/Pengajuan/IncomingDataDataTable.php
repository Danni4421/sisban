<?php

namespace App\DataTables\RT\Pengajuan;

use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class IncomingDataDataTable extends DataTable
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
            ->addIndexColumn()
            ->addColumn('status_pengajuan', function (Pengajuan $pengajuan) {
                switch ($pengajuan->status_pengajuan) {
                    case "diterima";
                        return "<span class='badge text-bg-success'>Diterima</span>";
                    case "ditolak";
                        return "<span class='badge text-bg-danger'>Ditolak</span>";
                    default:
                        return "<span class='badge text-bg-warning'>Diproses</span>";
                }
            })
            ->addColumn('aksi', function (Pengajuan $pengajuan) {
                return view('components.pengurus.pengajuan.button-group')->with('pengajuan', $pengajuan);
            })
            ->rawColumns(['status_pengajuan', 'aksi']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pengajuan $model): QueryBuilder
    {
        $query = $model->newQuery()->with('keluarga.kepala_keluarga');

        if (session()->has('redirected_notification_rt_no_kk')) {
            $no_kk = session()->get('redirected_notification_rt_no_kk');
            session()->remove('redirected_notification_rt_no_kk');
            $query->where('pengajuan.no_kk', $no_kk);
        } else {
            $query->whereHas('keluarga', function ($query) {
                $query->where('rt', substr(auth()->user()->pengurus->jabatan, 2));
            });
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pengajuan_masuk_rt')
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
            Column::make('keluarga.no_kk')->title('Nomor Kartu Keluarga'),
            Column::make('keluarga.kepala_keluarga.nama')->title('Nama')->orderable(false),
            Column::make('keluarga.kepala_keluarga.umur')->title('Umur')->orderable(false),
            Column::make('keluarga.kepala_keluarga.no_hp')->title('Nomor Telepon')->orderable(false),
            Column::computed('status_pengajuan')->title('Status Pengajuan'),
            Column::computed('aksi')->title('Aksi')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'IncomingData_' . date('YmdHis');
    }
}
