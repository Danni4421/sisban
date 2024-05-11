<?php

namespace App\DataTables\Admin;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FaqDataTable extends DataTable
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
            ->addColumn('is_solved', function (Faq $faq) {
                if ($faq->is_solved) {
                    return "<span class='badge text-bg-success'>Terjawab</span>";
                } else {
                    return "<span class='badge text-bg-danger'>Belum Terjawab</span>";
                }
            })
            ->addColumn('aksi', function ($query) {
                return "
                    <div>
                        <button class='btn btn-primary' onclick='showQuestionDetail({$query->id_faq})' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                            <i class='fas fa-search'></i>
                        </button>
                    </div>
                ";
            })
            ->rawColumns(['is_solved', 'aksi']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Faq $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('faq-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->selectStyleSingle()
                    ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('user.username')->title('Username'),
            Column::make('pertanyaan')->title('Pertanyaan'),
            Column::computed('is_solved')->title('Status Pertanyaan'),
            Column::computed('aksi')->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FaqDataTabel_' . date('YmdHis');
    }
}
