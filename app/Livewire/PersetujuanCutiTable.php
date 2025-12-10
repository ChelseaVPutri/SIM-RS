<?php

namespace App\Livewire;

use App\Models\Pegawai;
use App\Models\PengajuanCuti;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PersetujuanCutiTable extends PowerGridComponent
{
    public string $tableName = 'persetujuanCutiTable';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),

            PowerGrid::footer()
                ->showPerPage(5, [5, 10, 15, 20])
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return PengajuanCuti::query()
            ->join('pegawai', 'pengajuan_cuti.pegawai_id', '=', 'pegawai.id')
            ->select([
                'pengajuan_cuti.*',
                'pegawai.nama_lengkap',
                'pegawai.sisa_cuti as sisa_cuti_pegawai',
            ])
            ->latest('pengajuan_cuti.created_at');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')

            ->add('nama_lengkap')
            
            ->add('jenis_cuti')

            ->add('durasi_tanggal', function ($row) {
                $start = Carbon::parse($row->tanggal_mulai_cuti);
                $end = Carbon::parse($row->tanggal_selesai_cuti);
                $durasi = $start->diffInDays($end) + 1;
                $range = $start->format('d M Y') . ' - ' . $end->format('d M Y');

                return "
                    <div class='flex flex-col'>
                        <span class='font-bold text-gray-800'>{$durasi} Hari</span>
                        <span class='text-xs text-gray-500'>{$range}</span>
                    </div>
                ";
            })

            ->add('alasan_bukti', function ($row) {
                $buttonBukti = '';
                if($row->foto_bukti) {
                    $url = Storage::url($row->foto_bukti);
                    $buttonBukti = "
                        <button type='button' 
                            onclick=\"Livewire.dispatch('open-bukti-modal', { url: '{$url}' })\"
                            class='mt-1 flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z'/>
                                <polyline points='14 2 14 8 20 8'/>
                            </svg>
                            Lihat
                        </button>
                    ";
                } else {
                    $buttonBukti = "
                        <span class='text-xs text-gray-400 italic mt-1'>
                            Tidak ada bukti
                        </span>
                    ";
                }

                return "
                    <div class='flex flex-col max-w-[250px]'>
                        <span class='text-sm text-gray-600 truncate'>
                            {$row->alasan_cuti}
                        </span>
                        {$buttonBukti}
                    </div>
                ";
            })
            
            ->add('status_badge', function ($row) {
                $label = $row->status;
                if($label === 'Pending') {
                    $color = 'bg-[#FCF5CD] text-[#BA9F0B]';
                } elseif($label === 'Disetujui') {
                    $color = 'bg-[#D7EFEA] text-[#006569]';
                } elseif($label === 'Ditolak') {
                    $color = 'bg-red-100 text-red-700';
                }

                return "
                    <span class='inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg {$color}'>
                        {$label}
                    </span>
                ";
            });
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'id')
                ->index(),

            Column::make('Nama Pegawai', 'nama_lengkap')
                ->searchable(),


            Column::make('Jenis Cuti', 'jenis_cuti'),

            Column::make('Durasi & Tanggal', 'durasi_tanggal', 'tanggal_mulai_cuti'),

            Column::make('Alasan & Bukti', 'alasan_bukti'),

            Column::make('Status', 'status_badge', 'status'),

            Column::action('Aksi')
        ];
    }

    // public function filters(): array
    // {
    //     return [
    //         Filter::inputText('name'),
    //         Filter::datepicker('created_at_formatted', 'created_at'),
    //     ];
    // }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(PengajuanCuti $row): array
    {
        if($row->status !== 'Pending') {
            return [
            Button::add('selesai')
                ->slot('Selesai')
                ->class('text-sm text-gray-400 font-medium italic cursor-default bg-transparent border-none shadow-none')
                // ->disabled()
            ];
        }

        return [
            // Tombol setuju
            Button::add('approve')
                ->slot('
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                ')
                ->class('bg-green-100 text-green-600 hover:bg-green-200 p-2 rounded-full transition-colors mr-2')
                ->tooltip('Setuju')
                ->dispatch('approveCuti', ['id' => $row->id]),

            // Tombol ditolak
            Button::add('reject')
                ->slot('
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                ')
                ->class('bg-red-100 text-red-600 hover:bg-red-200 p-2 rounded-full transition-colors')
                ->tooltip('Tolak')
                ->dispatch('rejectCuti', ['id' => $row->id]),
        ];
    }

    #[On('approveCuti')]
    public function approve($id) {
        $pengajuan = PengajuanCuti::find($id);
        if (!$pengajuan) return;

        $pegawai = Pegawai::find($pengajuan->pegawai_id);

        // Hitung durasi 
        $start = Carbon::parse($pengajuan->tanggal_mulai_cuti);
        $end = Carbon::parse($pengajuan->tanggal_selesai_cuti);
        $durasi = $start->diffInDays($end) + 1;

        // Validasi sisa cuti
        if ($pegawai->sisa_cuti < $durasi) {
            $this->dispatch('show-toast', message: 'Gagal! Sisa cuti pegawai tidak mencukupi.', type: 'error');
            return;
        }

        // Kurangi sisa cuti dan update status
        $pegawai->decrement('sisa_cuti', $durasi);
        $pegawai->update(['status' => 'Cuti']);
        $pengajuan->update(['status' => 'Disetujui']);

        $this->dispatch('show-toast', message: 'Permohonan disetujui & Sisa cuti dikurangi.');
    }

    #[On('rejectCuti')]
    public function reject($id) {
        $pengajuan = PengajuanCuti::find($id);
        if ($pengajuan) {
            $pengajuan->update(['status' => 'Ditolak']);
            $this->dispatch('show-toast', message: 'Permohonan cuti ditolak.');
        }
    }

    /*
    public function actionRules(PengajuanCuti $row): array
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
