<?php

namespace App\DataTables;

use App\Models\Guardiance;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Crypt;

class GuardianceDataTable extends DataTable
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
        ->addColumn('status', function($guardiance){
            return ($guardiance->user->status==1)?'<h5><span class="badge badge-primary">Active</span></h5>':
            '<h5><span class="badge badge-warning">Inactive</span></h5>';
        })
        ->addColumn('action', function ($guardiance) {
            $encryptedId = Crypt::encrypt($guardiance->id);
            $btn = '';
                $btn .= '<a href="'.route('guardiances.edit',$encryptedId).'"
                class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">
                <i class="fa fa-pen-alt"></i> </a> ';

                $btn .= '<a href="'.route('guardiances.show',$encryptedId).'"
                class="btn btn-xs btn-secondary" data-toggle="tooltip" title="View">
                <i class="fa fa-eye"></i> </a> ';

                $btn .= '<a href="'.route('guardiances.add_children_view',$encryptedId).'"
                class="btn btn-xs btn-warning" data-toggle="tooltip" title="Add Children">
                <i class="fa fa-plus"></i> </a> ';

                if($guardiance->user->status==1)
                {
                    $btn .='<a href="'.route('guardiances.inactive',$encryptedId).'"
                    class="btn btn-xs btn-danger" data-toggle="tooltip"
                    title="Suspend"><i class="fa fa-trash"></i> </a> ';

                }elseif($guardiance->user->status==0)
                {
                    $btn .='<a href="'.route('guardiances.activate',$encryptedId).'"
                    class="btn btn-xs btn-danger" data-toggle="tooltip"
                    title="Activate"><i class="fa fa-unlock"></i> </a> ';
                }

            return $btn;
        })
        ->addColumn('roles', function ($guardiance) {
            $roles = $guardiance->user->getRoleNames();
            $badges = '';

            if (!empty($roles)) {
                foreach ($roles as $role) {
                    $badges .= '<label class="badge badge-success">' . $role . '</label>';
                }
            }

            return $badges;
        })
        ->rawColumns(['action','status','roles']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Guardiance $model): QueryBuilder
    {
        return $model->newQuery()->with(['user','guardiance_type']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('guardiance-table')
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
            Column::make('user.name')->data('user.name')->title('Name'),
            Column::make('user.username')->data('user.username')->title('Username'),
            Column::make('user.email')->data('user.email')->title('Email'),
            Column::make('user.contact')->data('user.contact')->title('Default Contact'),
            Column::make('sec_contact')->data('sec_contact')->title('Contact'),
            Column::make('guardiance_type.name')->data('guardiance_type.name')->title('Type'),
            Column::computed('roles'),
            Column::computed('status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Guardiance_' . date('YmdHis');
    }
}
