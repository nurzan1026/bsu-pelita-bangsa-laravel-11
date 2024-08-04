<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataSampah;

class DataSampahSeeder extends Seeder
{
    public function run(): void
    {
        $sampahs = [
            ['sampah_id' => 'P01B', 'kategori' => 'Plastik', 'jenis' => 'PP Gelas Bening Bersih', 'poin' => 5],
            ['sampah_id' => 'P02B', 'kategori' => 'Plastik', 'jenis' => 'PP Gelas Bening Kotor', 'poin' => 4],
            ['sampah_id' => 'P03W', 'kategori' => 'Plastik', 'jenis' => 'PP Gelas Warna', 'poin' => 3],
            ['sampah_id' => 'P04C', 'kategori' => 'Plastik', 'jenis' => 'PP Cincin Gelas', 'poin' => 2],
            ['sampah_id' => 'P05B', 'kategori' => 'Plastik', 'jenis' => 'PET Bening Bersih', 'poin' => 6],
            ['sampah_id' => 'P06B', 'kategori' => 'Plastik', 'jenis' => 'PET Biru Muda Bersih', 'poin' => 5],
            ['sampah_id' => 'P07K', 'kategori' => 'Plastik', 'jenis' => 'PET Kotor', 'poin' => 4],
            ['sampah_id' => 'P08W', 'kategori' => 'Plastik', 'jenis' => 'PET Warna Bersih/Pisah', 'poin' => 4],
            ['sampah_id' => 'P09C', 'kategori' => 'Plastik', 'jenis' => 'PET Warna Campur', 'poin' => 3],
            ['sampah_id' => 'P10C', 'kategori' => 'Plastik', 'jenis' => 'PET Campur', 'poin' => 3],
            ['sampah_id' => 'P11C', 'kategori' => 'Plastik', 'jenis' => 'Plastik HD Campur', 'poin' => 2],
            ['sampah_id' => 'P12T', 'kategori' => 'Plastik', 'jenis' => 'HD Tutup Botol', 'poin' => 3],
            ['sampah_id' => 'P13T', 'kategori' => 'Plastik', 'jenis' => 'HD Tutup Galon', 'poin' => 3],
            ['sampah_id' => 'P14D', 'kategori' => 'Plastik', 'jenis' => 'Plastik Daun', 'poin' => 1],
            ['sampah_id' => 'P15C', 'kategori' => 'Plastik', 'jenis' => 'Plastik PP Cetak', 'poin' => 4],
            ['sampah_id' => 'P16C', 'kategori' => 'Plastik', 'jenis' => 'Plastik HD (Blow) Campur', 'poin' => 2],
            ['sampah_id' => 'L01T', 'kategori' => 'Logam', 'jenis' => 'Besi Tebal', 'poin' => 6],
            ['sampah_id' => 'L02T', 'kategori' => 'Logam', 'jenis' => 'Besi Tipis', 'poin' => 5],
            ['sampah_id' => 'L03K', 'kategori' => 'Logam', 'jenis' => 'Kaleng', 'poin' => 4],
            ['sampah_id' => 'L04K', 'kategori' => 'Logam', 'jenis' => 'Kuningan', 'poin' => 7],
            ['sampah_id' => 'L05T', 'kategori' => 'Logam', 'jenis' => 'Tembaga', 'poin' => 8],
            ['sampah_id' => 'L06A', 'kategori' => 'Logam', 'jenis' => 'Aluminium Tebal', 'poin' => 5],
            ['sampah_id' => 'L07A', 'kategori' => 'Logam', 'jenis' => 'Aluminium Tipis', 'poin' => 4],
            ['sampah_id' => 'L08A', 'kategori' => 'Logam', 'jenis' => 'Aluminium Siku', 'poin' => 5],
            ['sampah_id' => 'L09A', 'kategori' => 'Logam', 'jenis' => 'Aluminium Campur', 'poin' => 4],
            ['sampah_id' => 'L10S', 'kategori' => 'Logam', 'jenis' => 'Besi Seng', 'poin' => 3],
            ['sampah_id' => 'L11P', 'kategori' => 'Logam', 'jenis' => 'Perunggu', 'poin' => 7],
            ['sampah_id' => 'K01P', 'kategori' => 'Kertas', 'jenis' => 'Kertas Putih', 'poin' => 3],
            ['sampah_id' => 'K02C', 'kategori' => 'Kertas', 'jenis' => 'Kertas Campur/warna', 'poin' => 2],
            ['sampah_id' => 'K03B', 'kategori' => 'Kertas', 'jenis' => 'Kertas Buram', 'poin' => 3],
            ['sampah_id' => 'K04K', 'kategori' => 'Kertas', 'jenis' => 'Kardus', 'poin' => 4],
            ['sampah_id' => 'K05S', 'kategori' => 'Kertas', 'jenis' => 'Kertas Semen', 'poin' => 3],
            ['sampah_id' => 'K06M', 'kategori' => 'Kertas', 'jenis' => 'Kertas Mikel', 'poin' => 2],
            ['sampah_id' => 'K07C', 'kategori' => 'Kertas', 'jenis' => 'Cones', 'poin' => 2],
            ['sampah_id' => 'B01M', 'kategori' => 'Botol Kaca', 'jenis' => 'Botol Markisa Bensin', 'poin' => 5],
            ['sampah_id' => 'B02K', 'kategori' => 'Botol Kaca', 'jenis' => 'Botol Kecap/Bir', 'poin' => 4],
            ['sampah_id' => 'B03M', 'kategori' => 'Botol Kaca', 'jenis' => 'Botol Marjan', 'poin' => 4],
            ['sampah_id' => 'B04S', 'kategori' => 'Botol Kaca', 'jenis' => 'Botol Soda', 'poin' => 5],
            ['sampah_id' => 'B05B', 'kategori' => 'Botol Kaca', 'jenis' => 'Botol Bir Guinness', 'poin' => 6],
            ['sampah_id' => 'M01J', 'kategori' => 'Minyak', 'jenis' => 'Minyak Jelantah', 'poin' => 4],
        ];

        foreach ($sampahs as $sampah) {
            DataSampah::create($sampah);
        }
    }
}
