<?php

namespace App\DataTables\Drivers;

use App\Models\Driver;
use App\Models\DriverPlacment;
use App\Models\Kindergarten;
use App\Models\Level;
use Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DriverPlacmentDataTable extends DataTable
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
            
            ->editColumn('trip_id', function (DriverPlacment $model) {
                return $model->Trips ? $model->Trips->name : '';
            })
            ->editColumn('period_id', function (DriverPlacment $model) {
                return $model->Period ? $model->Period->name : '';
            })
            ->editColumn('driver_id', function (DriverPlacment $model) {
                return $model->Driver ? $model->Driver->name : '';
            })
            ->addColumn('action', function (DriverPlacment $model) {
                return view('pages.drivers.driver_placement.parts._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param DriverPlacment $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DriverPlacment $model)
    {
        if(Auth::user()->kindergarten_id != null)
        {
            return $model->whereHas('driver' , function($query){
                $query->where('kindergarten_id' , Auth::user()->kindergarten_id);
            })->newQuery();    
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
            

            Column::computed('driver_id')
            ->addClass('text-center')
            ->responsivePriority(-1)
            ->title('السائق'),

            Column::computed('period_id')
            ->addClass('text-center')
            ->responsivePriority(-1)
            ->title('الفترة'),


            Column::computed('trip_id')
            ->addClass('text-center')
            ->responsivePriority(-1)
            ->title('الرحلة'),

            Column::make('itinerary')
            ->title('خط سير الحافلة')
            ->addClass('text-center'),


           

              
            Column::computed('action')
                ->exportable(false)
                ->printable(true)
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
