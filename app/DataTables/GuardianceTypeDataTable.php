<?php

namespace App\DataTables;

use App\Models\GuardianceType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Crypt;

class GuardianceTypeDataTable extends DataTable
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
        ->addColumn('status', function($guardiance_type){
            return ($guardiance_type->status==1)?'<h5><span class="badge badge-primary">Active</span></h5>':
            '<h5><span class="badge badge-warning">Inactive</span></h5>';
        })
        ->addColumn('action', function ($guardiance_type) {
            $encryptedId = Crypt::encrypt($guardiance_type->id);
            $btn = '';
                $btn .= '<a href="'.route('guardiance_types.edit',$encryptedId).'"
                class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">
                <i class="fa fa-pen-alt"></i> </a> ';

                $btn .= '<a href="'.route('guardiance_types.show',$encryptedId).'"
                class="btn btn-xs btn-secondary" data-toggle="tooltip" title="View">
                <i class="fa fa-eye"></i> </a> ';

                if($guardiance_type->status==1)
                {
                    $btn .='<a href="'.route('guardiance_types.inactive',$encryptedId).'"
                    class="btn btn-xs btn-danger" data-toggle="tooltip"
                    title="Suspend"><i class="fa fa-trash"></i> </a> ';

                }elseif($guardiance_type->status==0)
                {
                    $btn .='<a href="'.route('guardiance_types.activate',$encryptedId).'"
                    class="btn btn-xs btn-danger" data-toggle="tooltip"
                    title="Activate"><i class="fa fa-unlock"></i> </a> ';
                }


            return $btn;
        })
        ->rawColumns(['action','status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(GuardianceType $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('guardiancetype-table')
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
                        Button::make('reset'),
                        //Button::make('reload')
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
            Column::make('name')->data('name')->title('Name'),
            Column::computed('status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'GuardianceType_' . date('YmdHis');
    }
}
