<?php

namespace App\Livewire;

use App\Models\PengajuanCuti;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PengajuanCutiTable extends PowerGridComponent
{
    public $perPages = 5;
    public string $tableName = 'pengajuanCutiTable';

    public function setUp(): array
    {

        return [
            PowerGrid::header(),

            PowerGrid::footer()
                ->showPerPage(5, [5, 10, 15, 20])
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        if(!Auth::check()) {
            return PengajuanCuti::query()->whereNull('id');
        }
        return PengajuanCuti::query()
            ->where('pegawai_id', Auth::user()->id)
            ->latest();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            
            ->add('tanggal_pengajuan', function (PengajuanCuti $model) {
                return Carbon::parse($model->created_at)->translatedFormat('d M Y');
            })

            ->add('jenis_alasan', function (PengajuanCuti $model) {
                return "
                    <div class='flex flex-col'>
                        <span class='font-bold text-gray-800 text-sm'>{$model->jenis_cuti}</span>
                        <span class='text-xs text-gray-500 truncate max-w-[200px]'>{$model->alasan_cuti}</span>
                    </div>
                ";
            })

            ->add('jadwal_cuti', function (PengajuanCuti $model) {
                $start = Carbon::parse($model->tanggal_mulai_cuti);
                $end = Carbon::parse($model->tanggal_selesai_cuti);
                $durasi = $start->diffInDays($end) + 1;
                $dateRange = $start->translatedFormat('d M') . ' - ' . $end->translatedFormat('d M Y');

                return "
                    <div class='flex flex-col'>
                        <span class='text-sm text-gray-800 font-medium'>{$dateRange}</span>
                        <span class='text-xs text-gray-500'>{$durasi} Hari</span>
                    </div>
                ";
            })

            ->add('foto_bukti', function (PengajuanCuti $model) {
                if($model->foto_bukti) {
                    $url = Storage::url($model->foto_bukti);
                    return "
                        <button 
                            type='button'
                            onclick=\"Livewire.dispatch('open-bukti-modal', { url: '{$url}' })\" 
                            class='text-blue-500 hover:text-blue-700 transition-colors cursor-pointer'
                        >
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                                <rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect>
                                <circle cx='8.5' cy='8.5' r='1.5'></circle>
                                <polyline points='21 15 16 10 5 21'></polyline>
                            </svg>
                        </button>
                    ";
                }

                // Tidak ada foto
                return "
                    <span class='text-gray-300'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                            <line x1='1' y1='1' x2='23' y2='23'></line>
                            <rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect>
                        </svg>
                    </span>
                ";
            })

            ->add('status_badge', function (PengajuanCuti $model) {
                $status = $model->status;

                if($status === 'Disetujui') {
                    $color = 'bg-[#D7EFEA] text-[#006569]';
                } elseif($status === 'Pending') {
                    $color = 'bg-[#FCF5CD] text-[#BA9F0B]';
                } elseif($status === 'Ditolak') {
                    $color = 'bg-red-100 text-red-700';
                }

                return "
                    <span class='inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg {$color}'>
                        {$status}
                    </span>
                ";
            });
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'id')->index(),

            Column::make('Tanggal Pengajuan', 'tanggal_pengajuan', 'created_at')
                ->sortable(),
            
            Column::make('Jenis & Alasan', 'jenis_alasan', 'jenis_cuti')
                ->sortable()
                ->searchable(),

            Column::make('Jadwal Cuti', 'jadwal_cuti', 'tanggal_mulai_cuti')
                ->sortable(),

            Column::make('Bukti', 'foto_bukti')
                ->headerAttribute('text-center justify-center')            
                ->contentClasses('justify-center items-center py-2'),

            Column::make('Status', 'status_badge', 'status')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            // Filter status
            Filter::select('status', 'status')
                ->dataSource([
                    ['status' => 'Pending', 'label' => 'Pending'],
                    ['status' => 'Disetujui', 'label' => 'Disetujui'],
                    ['status' => 'Ditolak', 'label' => 'Ditolak'],
                ])
                ->optionLabel('label')
                ->optionValue('status')
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    // public function actions(PengajuanCuti $row): array
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
