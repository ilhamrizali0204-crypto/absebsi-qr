<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanAbsensiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $tanggal_mulai;
    protected $tanggal_selesai;
    protected $kelas;

    public function __construct($tanggal_mulai = null, $tanggal_selesai = null, $kelas = null)
    {
        $this->tanggal_mulai   = $tanggal_mulai;
        $this->tanggal_selesai = $tanggal_selesai;
        $this->kelas           = $kelas;
    }

    public function collection()
    {
        $query = Absensi::with('siswa');

        if ($this->tanggal_mulai) {
            $query->whereDate('tanggal', '>=', $this->tanggal_mulai);
        }

        if ($this->tanggal_selesai) {
            $query->whereDate('tanggal', '<=', $this->tanggal_selesai);
        }

        if ($this->kelas) {
            $kelas = $this->kelas;
            $query->whereHas('siswa', function ($q) use ($kelas) {
                $q->where('kelas', $kelas);
            });
        }

        return $query->orderBy('tanggal', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'NIS',
            'Nama',
            'Kelas',
            'Status',
            'Keterangan',
        ];
    }

    public function map($absen): array
    {
        return [
            optional($absen->tanggal)->format('Y-m-d') ?? $absen->tanggal,
            $absen->siswa->nis ?? '-',
            $absen->siswa->nama ?? '-',
            $absen->siswa->kelas ?? '-',
            $absen->status,
            $absen->keterangan ?? '',
        ];
    }
}
