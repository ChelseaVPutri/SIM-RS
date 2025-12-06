<?php

namespace App\Livewire;

use App\Livewire\PowerGrid\Themes\CustomTheme;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PegawaiTableDashboard extends PowerGridComponent
{
    public int $perPage = 5;
    public string $tableName = 'pegawaiTable';

    public function template(): ?string {
        return CustomTheme::class;
    }

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


    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_lengkap')
            ->add('nip')
            ->add('nama_dept_asli');
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'id'),

            Column::make('Nama Lengkap', 'nama_lengkap')
                ->sortable()
                ->searchable(),

            Column::make('NIP', 'nip')
                ->sortable()
                ->searchable(),

            Column::make('Department', 'nama_dept_asli', 'department.nama_department')
                ->sortable()
                ->searchable(),

        ];
    }

    public function datasource(): Builder {
        return Pegawai::query()
            // Gabungkan tabel: (nama_tabel_tujuan, fk_di_pegawai, operator, id_tujuan)
            ->join('department', 'pegawai.department_id', '=', 'department.id') 
        
            // Pilih semua data pegawai, DAN ambil nama_department sebagai alias baru
            ->select([
                'pegawai.*', 
                'department.nama_department as nama_dept_asli'
        ]);
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            Filter::datepicker('created_at_formatted', 'created_at'),
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
    public function actionRules(Pegawai $row): array
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
