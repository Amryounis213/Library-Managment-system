<?php

namespace App\DataTables\Roles;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class   RolesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('table_index', '')
            ->editColumn('id', function (Role $model) {
                return $model->id;
            })
            ->editColumn('created_at', function (Role $model) {
                return $model->created_at->format('d M, Y H:i');
            })
            ->addColumn('action', function (Role $model) {
                $id = $model->id;
                return view('pages.role.index._action-menu', compact('model','id'));
            });
    }

    ///////////////////////////////////////////////////////////
    public function query(Role $model)
    {
        return $model->newQuery();
    }

    ///////////////////////////////////////////////////////////
    public function html()
    {
        return $this->builder()
            ->setTableId('roles-table')
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

    ///////////////////////////////////////////////////////////
    protected function getColumns()
    {
        return [
            Column::make('table_index')->title(__('#'))->addClass('text-center'),
            Column::make('name')->title(__('name')),
            Column::make('created_at')
                ->title(__('created at'))
                ->addClass('text-center')
                ->addClass('td-ltr'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->responsivePriority(-1)
                ->title(__('action')),
        ];
    }

    ///////////////////////////////////////////////////////////
    protected function filename()
    {
        return 'Roles_'.date('YmdHis');
    }
}
