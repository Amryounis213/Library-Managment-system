<?php

namespace App\DataTables\Divisions;

use App\Models\Division;
use App\Models\Kindergarten;
use App\Models\Level;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DivisionsDataTable extends DataTable
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
            ->editColumn('level', function (Division $model) {
                return $model->Level ? ($model->Level->name) ?? '---' : '---';
            })
            ->editColumn('kindergarten', function (Division $model) {
                return $model->Kindergarten ? ($model->Kindergarten->name) ?? '---' : '---';
            })
            ->editColumn('children_count', function (Division $model) {
                return $model->Children ? ($model->Children->count()) ?? '---' : '---';
            })
            ->addColumn('status', function (Division $model) {
                return view('pages.divisions.parts._status', compact('model'));
            })
            ->addColumn('action', function (Division $model) {
                return view('pages.divisions.parts._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Division $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Division $model)
    {
      
        if(Auth::user()->kindergarten_id != null)
        {
            return $model->where('kindergarten_id' , Auth::user()->kindergarten_id)->newQuery();
        }
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
            ->setTableId('patients-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave(true)
            ->orderBy(0)
            ->responsive()
            ->autoWidth(false)
            ->parameters(['scrollX' => true])
            ->languageSearch('??????:  ')
            ->languageProcessing('???????? ?????????? ???????????????? ...')
            ->languageZeroRecords('???? ???????? ????????????')
            ->languageInfo("?????? _START_ ?????? _END_ ???? _TOTAL_ ??????????")
            ->languageInfoEmpty("?????? 0 ?????? 0 ???? 0 ??????????")
            ->languageInfoFiltered(" | ?????????? ???? _MAX_ ???????????? ??????????")
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
            Column::make('name')->title(__('name'))->addClass('text-center'), 
            Column::computed('level')->title('??????????????')->addClass('text-center'),
            Column::computed('kindergarten')->title('????????????')->addClass('text-center'),
            Column::computed('children_count')->title('?????? ????????????')->addClass('text-center'),
            Column::make('max_children')->title('??????????')->addClass('text-center'),

            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->responsivePriority(-1)
                ->title(__('Status')),
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
        return 'Patients_' . date('YmdHis');
    }
}
