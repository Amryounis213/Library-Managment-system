<?php

namespace App\DataTables\ChildrensPayment;

use App\Models\ChildrenSubscriptions;
use App\Models\PayFees;
use App\Models\Subscriptions;
use Illuminate\Cache\RateLimiting\Limit;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ChildrenPayFeesDataTable extends DataTable
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
           
            ->addColumn('status', function (PayFees $model) {
                return view('pages.childrenpayment.parts._status', compact('model'));
            })
            ->editColumn('year', function (PayFees $model) {
                return $model->Year->name;
            })
            ->editColumn('action', function (PayFees $model) {
                return view('pages.childrenpayment.parts._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param PayFees $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PayFees $model)
    {
        $children = $this->request()->get('children');
        $year = $this->request()->get('year');
        if(!empty($children))
        {

            if(!empty($year))
            {
                return $model->where('children_id' , $children)->where('year' , $year)->newQuery();

            }

            return $model->where('children_id' , $children)->newQuery();

        }
       
        return $model->where('created_at' , null)->newQuery();
 
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
            Column::make('payment_date')->title('?????????? ????????????')->addClass('text-center'),
            Column::make('payment_amount')->title('???????????? ??????????????')->addClass('text-center'),
            Column::make('Receipt_number')->title('?????? ??????????')->addClass('text-center'),
            Column::computed('year')->title('?????????? ??????????????')->addClass('text-center'),
            Column::make('notices')->title('?????? ?????????? / ??????????????')->addClass('text-center'),
 
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
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
