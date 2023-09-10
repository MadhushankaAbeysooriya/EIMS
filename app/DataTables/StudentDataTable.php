<?php

namespace App\DataTables;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Crypt;

class StudentDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addIndexColumn()
        ->addColumn('status', function($student){
            return ($student->status==1)?'<h5><span class="badge badge-primary">Active</span></h5>':
            '<h5><span class="badge badge-warning">Inactive</span></h5>';
        })
        ->addColumn('action', function ($student) {
            $encryptedId = Crypt::encrypt($student->id);
            $btn = '';
                $btn .= '<a href="'.route('students.edit',$encryptedId).'"
                class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">
                <i class="fa fa-pen-alt"></i> </a> ';

                $btn .= '<a href="'.route('students.show',$encryptedId).'"
                class="btn btn-xs btn-secondary" data-toggle="tooltip" title="View">
                <i class="fa fa-eye"></i> </a> ';

                $btn .= '<a href="'.route('students.add_class_room_view',$encryptedId).'"
                class="btn btn-xs btn-warning" data-toggle="tooltip" title="Add Class">
                <i class="fa fa-plus"></i> </a> ';

                if($student->status==1)
                {
                    $btn .='<a href="'.route('students.inactive',$encryptedId).'"
                    class="btn btn-xs btn-danger" data-toggle="tooltip"
                    title="Suspend"><i class="fa fa-trash"></i> </a> ';

                }elseif($student->status==0)
                {
                    $btn .='<a href="'.route('students.activate',$encryptedId).'"
                    class="btn btn-xs btn-danger" data-toggle="tooltip"
                    title="Activate"><i class="fa fa-unlock"></i> </a> ';
                }


            return $btn;
        })
        ->addColumn('gender', function ($student) {
            $badge = '';

            switch ($student->gender) {
                case '0':
                    $badge = '<span class="badge badge-primary">Female</span>';
                    break;
                case '1':
                    $badge = '<span class="badge badge-danger">Male</span>';
                    break;
                default:
                    $badge = '<span class="badge badge-secondary">Unknown</span>';
                    break;
            }

            return $badge;
        })
        ->rawColumns(['action','status','gender']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Student $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('student-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add'),
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderColumn(false)->width(40),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(90)
                  ->addClass('text-center'),
            Column::make('admission')->data('admission')->title('Admission'),
            Column::make('name_initials')->data('name_initials')->title('Name(with initials)'),
            Column::make('dob')->data('dob')->title('Date of Birth'),
            Column::computed('gender'),
            Column::make('enlist_date')->data('enlist_date')->title('Enlisted Date'),
            Column::computed('status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Student_' . date('YmdHis');
    }
}
