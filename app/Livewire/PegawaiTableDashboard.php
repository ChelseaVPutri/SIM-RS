<?php

namespace App\Livewire;

use App\Livewire\PowerGrid\Themes\CustomTheme;
use App\Models\Jadwal;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
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
    public string $tanggalFilter;
    public string $tableName = 'defaultTable';

    public function template(): ?string {
        return CustomTheme::class;
    }

    public function setUp(): array
    {
        if(!isset($this->tanggalFilter)) {
            $this->tanggalFilter = now()->format('Y-m-d');
        }
        return [
            PowerGrid::header()
                ->showSearchInput(),

            PowerGrid::footer()
                ->showPerPage(5, [5, 10, 25, 50])
                ->showRecordCount(),
        ];
    }

    #[On('update-tanggal-modal')]
    public function updateTanggal($tanggal) {
        if($this->tableName === 'modalTable') {
            $this->tanggalFilter = $tanggal;
            $this->resetPage();
        }
    }


    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_lengkap')
            ->add('nip')
            ->add('nama_department')
            ->add('shift_info', function ($row) {
                 // Format tampilan shift
                $start = Carbon::parse($row->waktu_mulai)->format('H:i');
                $end = Carbon::parse($row->waktu_selesai)->format('H:i');
                return "
                    <div class='flex flex-col'>
                        <span class='font-bold text-gray-800'>{$row->nama_shift}</span>
                        <span class='text-xs text-gray-500'>{$start} - {$end} WIB</span>
                    </div>
                ";
            });
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'id')->index(),

            Column::make('Nama Lengkap', 'nama_lengkap', 'pegawai.nama_lengkap')
                ->sortable()
                ->searchable(),

            Column::make('NIP', 'nip', 'pegawai.nip')
                ->sortable()
                ->searchable(),

            Column::make('Department', 'nama_department', 'department.nama_department')
                ->sortable()
                ->searchable(),
            
            Column::make('Shift', 'shift_info', 'shift.nama_shift')
        ];
    }

    public function datasource(): Builder {
        return Jadwal::query()
            ->join('pegawai', 'jadwal.pegawai_id', '=', 'pegawai.id')
            ->join('department', 'pegawai.department_id', '=', 'department.id')
            ->join('shift', 'jadwal.shift_id', '=', 'shift.id')
            ->whereDate('jadwal.tanggal', $this->tanggalFilter) // Filter tanggal dinamis
            ->select([
                'jadwal.id',
                'pegawai.nama_lengkap',
                'pegawai.nip',
                'department.nama_department',
                'shift.nama_shift',
                'shift.waktu_mulai',
                'shift.waktu_selesai',
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
