<?php

namespace App\DataTables\Guest;

use App\Models\Keluarga;
use App\Models\Pengajuan;
use App\Models\Warga;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AplicantsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('no_kk')
            ->addColumn('no_kk', function (Pengajuan $pengajuan) {
                $noKk = $pengajuan->no_kk;
                return str_pad(substr($noKk, -3), strlen($noKk), '*', STR_PAD_RIGHT);
            })
            ->addColumn('keluarga.kepala_keluarga.nik', function (Pengajuan $pengajuan) {
                $nik = $pengajuan->keluarga->kepala_keluarga->nik;
                return str_pad(substr($nik, -3), strlen($nik), '*', STR_PAD_RIGHT);
            })
            ->addColumn('keluarga.rt', function (Pengajuan $pengajuan) {
                return 'RT' . $pengajuan->keluarga->rt;
            })
            ->addColumn('status_pengajuan', function (Pengajuan $pengajuan) {
                return "<span class='badge text-bg-warning'>{$pengajuan->status_pengajuan}</span>";
            })
            ->rawColumns(['status_pengajuan']);
    }

    public function query(Pengajuan $model): QueryBuilder
    {
        return $model->newQuery()->with(['keluarga' => function ($query) {
            $query->with('kepala_keluarga');
        }])->where('status_pengajuan', 'proses');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('no_kk')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->selectStyleSingle()
            ->addTableClass('table-striped')
            ->language(asset('assets/dataTable/lang/id.json'));
    }

    public function getColumns(): array
    {
        return [
            Column::make('no_kk'),
            Column::make('keluarga.kepala_keluarga.nama')->title('Nama'),
            Column::make('keluarga.kepala_keluarga.nik')->title('NIK'),
            Column::make('keluarga.rt')->title('RT')->searchable()->orderable(),
            Column::computed('status_pengajuan')
                ->title('Status Pengajuan')
                ->addClass('text-center')
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}