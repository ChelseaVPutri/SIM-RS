<?php

namespace App\Livewire;

use App\Models\Pegawai;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class DaftarPegawaiTable extends PowerGridComponent
{
    public string $tableName = 'daftarPegawaiTable';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),

            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Pegawai::query()
            // Gabungkan tabel: (nama_tabel_tujuan, fk_di_pegawai, operator, id_tujuan)
            ->join('department', 'pegawai.department_id', '=', 'department.id')
            ->where('pegawai.role', '!=', 'manajer') 
        
            // Pilih semua data pegawai, DAN ambil nama_department sebagai alias baru
            ->select([
                'pegawai.*', 
                'department.nama_department as nama_dept_asli'
        ]);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {   
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_lengkap')
            ->add('nip')
            ->add('nomor_telepon')
            ->add('nama_dept_asli')
            ->add('status', function (Pegawai $model) {
                $status = $model->status ?? 'Tidak Diketahui';

                if($status === 'Aktif') {
                    $badges = 'bg-[#D7EFEA] text-[#006569]';
                } else if($status === 'Cuti') {
                    $badges = 'bg-[#FCF5CD] text-[#BA9F0B]';
                } else {
                    $badges = 'bg-[#E5E5E5] text-[#808080]';
                }

                return "<span class='inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg {$badges}'>{$status}</span>";
            });
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'id')->index(),

            Column::make('Nama lengkap', 'nama_lengkap')
                ->sortable()
                ->searchable(),

            Column::make('NIP', 'nip')
                ->sortable()
                ->searchable(),

            Column::make('Nomor Telepon', 'nomor_telepon')
                ->sortable()
                ->searchable(),

            Column::make('Department', 'nama_dept_asli', 'department.nama_department')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable()
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    // public function actions(Pegawai $row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: '.$row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
