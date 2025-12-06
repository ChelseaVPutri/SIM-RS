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

    public function datasource(): Builder
    {
        return Pegawai::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_lengkap')
            ->add('nip')
            ->add('department');
            // ->add('name_lower', fn (Pegawai $model) => strtolower(e($model->name)))
            // ->add('created_at')
            // ->add('created_at_formatted', fn (Pegawai $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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

            Column::make('Department', 'department')
                ->sortable()
                ->searchable(),
            // Column::make('ID', 'id')
            //     ->searchable()
            //     ->sortable(),

            // Column::make('Name', 'name')
            //     ->searchable()
            //     ->sortable(),

            // Column::make('Created at', 'created_at')
            //     ->hidden(),

            // Column::make('Created at', 'created_at_formatted', 'created_at')
            //     ->searchable(),

            // Column::action('Action')
        ];
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
