<?php

namespace App\DataTables\Medicines;

use App\Models\Medicine;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MedicinesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('table_index', '')
            ->editColumn('created_at', function (Medicine $model) {
                return $model->created_at->format('d M, Y H:i');
            })
            ->addColumn('status', function (Medicine $model) {
                return view('pages.medicine.index._status', compact('model'));
            })
            ->addColumn('action', function (Medicine $model) {
                return view('pages.medicine.index._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Medicine $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Medicine $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('medicines-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave(true)
            ->orderBy(0)
            ->responsive()
            ->autoWidth(false)
            ->parameters(['scrollX' => true])
            ->languageSearch('بحث:  ')
            ->languageProcessing('جاري تحميل البيانات ...')
            ->languageZeroRecords('لا يوجد بيانات')
            ->languageInfo("عرض _START_ إلى _END_ من _TOTAL_ ملفات")
            ->languageInfoEmpty("عرض 0 الى 0 من 0 ملفات")
            ->languageInfoFiltered(" | تصفية من _MAX_ اجمالي ملفات")
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('table_index')->title(__('#'))->addClass('text-center'),
            Column::make('name')->title(__('name')),
            Column::make('code')->title(__('code')),
            Column::make('unit')->title(__('unit')),
            Column::make('price')->title(__('price')),
            Column::make('company_price')->title(__('company_price')),
            Column::make('employee_price')->title(__('employee_price')),
            Column::make('purchase_price')->title(__('purchase_price')),
            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->responsivePriority(-1)
                ->title(__('available')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->responsivePriority(-1)
                ->title(__('action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Medicines_' . date('YmdHis');
    }
}
