<?php

namespace App\DataTables\Guest;

use App\Models\PenerimaBansos;
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
            ->setRowId('id')
            ->addIndexColumn()
            ->addColumn('warga.nik', function (PenerimaBansos $penerimaBansos) {
                $nikPenerima = $penerimaBansos->warga->nik;
                return str_pad(substr($nikPenerima, -3), strlen($nikPenerima), '*', STR_PAD_RIGHT);
            })
            ->addColumn('warga.keluarga.rt', function (PenerimaBansos $penerimaBansos) {
                return 'RT' .  $penerimaBansos->warga->keluarga->rt;
            })
            ->addColumn('warga.umur', function (PenerimaBansos $penerimaBansos) {
                return $penerimaBansos->warga->umur . PHP_SPACE . 'Tahun';
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PenerimaBansos $model): QueryBuilder
    {
        return $model->newQuery()->with([
            'warga' => function ($query) {
                $query->with('keluarga');
            },
            'bansos'
        ]);
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
            ->orderBy(1)
            ->selectStyleSingle()
            ->addTableClass('table-striped')
            ->language(asset('assets/dataTable/lang/id.json'))
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('warga.nama')
                ->searchable()
                ->title('Nama'),
            Column::make('warga.nik')
                ->searchable()
                ->title('NIK'),
            Column::make('warga.umur')
                ->searchable()
                ->title('Umur'),
            Column::make('warga.keluarga.rt')
                ->searchable()
                ->title('Alamat'),
            Column::make('bansos.nama_bansos')
                ->searchable()
                ->title('Jenis Bansos'),
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
