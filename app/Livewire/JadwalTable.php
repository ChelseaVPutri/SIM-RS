<?php

namespace App\Livewire;

use App\Models\Jadwal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class JadwalTable extends PowerGridComponent
{
    public int $perPage = 5;
    // public $sortField = 'jadwal.tanggal';
    // public $sortDirection = 'desc';
    public string $tableName = 'jadwalTable';

    public function setUp(): array
    {

        return [
            PowerGrid::header()
                ->showSearchInput(),

            PowerGrid::footer()
                ->showPerPage(5, [5, 10, 25, 50])
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Jadwal::query()
            ->join('pegawai', 'jadwal.pegawai_id', '=', 'pegawai.id')
            ->join('shift', 'jadwal.shift_id', '=', 'shift.id')
            ->join('department', 'pegawai.department_id', '=', 'department.id')
            ->select([
                'jadwal.id',
                'jadwal.tanggal',
                'jadwal.pegawai_id',
                'jadwal.shift_id',

                'pegawai.nama_lengkap as nama_pegawai',
                'pegawai.nip as nip',
                'pegawai.department_id',

                'shift.nama_shift',
                'shift.waktu_mulai',
                'shift.waktu_selesai',
                
                'department.nama_department'
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
            ->add('nama_pegawai')
            ->add('nip')
            ->add('nama_department')
            ->add('tanggal_formatted', function($row) {
                return Carbon::parse($row->tanggal)->translatedFormat('d F Y');
            })
            ->add('shift', function($row) {
                $start = Carbon::parse($row->waktu_mulai)->format('H:i');
                $end = Carbon::parse($row->waktu_selesai)->format('H:i');
                return "
                    <div class='flex flex-col'>
                        <span class=' text-sm font-semibold text-gray-800'>{$row->nama_shift}</span>
                        <span class='text-xs text-gray-500'>{$start} - {$end} WIB</span>
                    </div>
                ";
            });
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'id')->index(),

            Column::make('Pegawai', 'nama_pegawai', 'pegawai.nama_lengkap')
                ->sortable()
                ->searchable(),

             Column::make('NIP', 'nip', 'pegawai.nip')
                ->sortable()
                ->searchable(),

             Column::make('Department', 'nama_department', 'department.nama_department')
                ->sortable()
                ->searchable(),

             Column::make('Tanggal', 'tanggal_formatted', 'jadwal.tanggal')
                ->sortable(),

            Column::make('Shift', 'shift', 'shift.nama_shift')
                ->sortable(),

            Column::action('Aksi')
        ];
    }

    // public function filters(): array
    // {
    //     return [
    //         Filter::datepicker('tanggal'),
    //     ];
    // }

    #[\Livewire\Attributes\On('delete-jadwal')]
    public function deleteRow($id): void
    {
        $jadwal = Jadwal::find($id);
        if ($jadwal) {
            $jadwal->delete();
            $this->dispatch('show-toast', message: 'Jadwal berhasil dihapus.');
        }
    }

    public function actions(Jadwal $row): array
    {
        return [
            Button::add('delete')
                ->slot(
                    '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>')
                ->class('bg-red-500 hover:bg-red-600 text-white px-2 py-2 rounded-lg shadow-sm transition-colors')
                ->dispatch('delete-jadwal', ['id' => $row->id])
        ];
    }

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
