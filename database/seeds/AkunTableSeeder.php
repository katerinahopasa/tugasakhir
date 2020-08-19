<?php

use Illuminate\Database\Seeder;

class AkunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('akun')->insert([
            ['nama_akun' => 'Kass', 'kode_akun' => '110', 'jenis_akun' => 'aktiva_lancar'],    
            ['nama_akun' => 'Piutang Usaha', 'kode_akun' => '120', 'jenis_akun' => 'aktiva_lancar'],    
            ['nama_akun' => 'Peralatan Usahaa', 'kode_akun' => '140', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Bangunann', 'kode_akun' => '150', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Tanahh', 'kode_akun' => '160', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Utang Usahaa', 'kode_akun' => '210', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Utang Bankk', 'kode_akun' => '230', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Modal Sahamm', 'kode_akun' => '610', 'jenis_akun' => 'modal'],    
            ['nama_akun' => 'Pendapatann', 'kode_akun' => '410', 'jenis_akun' => 'pendapatan'],    
            ['nama_akun' => 'Gaji & Upahh', 'kode_akun' => '510', 'jenis_akun' => 'beban'],    
            ['nama_akun' => 'Utilities (Listrik, Air, & Gas)', 'kode_akun' => '520', 'jenis_akun' => 'beban'],    
            ['nama_akun' => 'Bunga Bankk', 'kode_akun' => '530', 'jenis_akun' => 'beban'],    
            ['nama_akun' => 'Dividenn', 'kode_akun' => '340', 'jenis_akun' => 'aktiva_lancar'], 
            ['nama_akun' => 'Kas', 'kode_akun' => '1101', 'jenis_akun' => 'aktiva_lancar'], 
            ['nama_akun' => 'Bank', 'kode_akun' => '1111', 'jenis_akun' => 'aktiva_lancar'],     
            ['nama_akun' => 'Piutang Usaha', 'kode_akun' => '1201', 'jenis_akun' => 'aktiva_lancar'], 
            ['nama_akun' => 'Piutang Karyawan', 'kode_akun' => '1101', 'jenis_akun' => 'aktiva_lancar'],     
            ['nama_akun' => 'Peralatan Usaha', 'kode_akun' => '1401', 'jenis_akun' => 'aktiva_tetap'],
            ['nama_akun' => 'Uang Muka Perjalanan Dinas', 'kode_akun' => '1401', 'jenis_akun' => 'aktiva_lancar'], 
            ['nama_akun' => 'Uang Muka Training', 'kode_akun' => '1402', 'jenis_akun' => 'aktiva_lancar'],    
            ['nama_akun' => 'Sewa Dibayar Dimuka', 'kode_akun' => '1405', 'jenis_akun' => 'aktiva_lancar'], 
            ['nama_akun' => 'Asuransi Dibayar Dimuka', 'kode_akun' => '1406', 'jenis_akun' => 'aktiva_lancar'],  
            ['nama_akun' => 'Biaya Marketing Dibayar Dimuka', 'kode_akun' => '1408', 'jenis_akun' => 'aktiva_lancar'],  
            ['nama_akun' => 'Perlengkapan', 'kode_akun' => '1601', 'jenis_akun' => 'aktiva_lancar'],  
            ['nama_akun' => 'Gedung', 'kode_akun' => '1701', 'jenis_akun' => 'aktiva_tetap'],  
            ['nama_akun' => 'Peralatan Outbond', 'kode_akun' => '1702', 'jenis_akun' => 'aktiva_tetap'],   
            ['nama_akun' => 'Peralatan Camping', 'kode_akun' => '1703', 'jenis_akun' => 'aktiva_tetap'],   
            ['nama_akun' => 'Peralatan High Rope', 'kode_akun' => '1704', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Peralatan Maintenance', 'kode_akun' => '1705', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Peralatan Kantor', 'kode_akun' => '1706', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Kendaraan', 'kode_akun' => '1707', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Akumulasi Penyusutan Gedung', 'kode_akun' => '4801', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Akumulasi Penyusutan Peralatan Outbond', 'kode_akun' => '4802', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Akumulasi Penyusutan Peralatan Camping', 'kode_akun' => '4803', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Akumulasi Penyusutan Peralatan High Rope', 'kode_akun' => '4804', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Akumulasi Penyusutan Peralatan Maintenance', 'kode_akun' => '4805', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Akumulasi Penyusutan Peralatan Kantor', 'kode_akun' => '4806', 'jenis_akun' => 'aktiva_tetap'],    
            ['nama_akun' => 'Akumulasi Penyusutan Kendaraan', 'kode_akun' => '4807', 'jenis_akun' => 'aktiva_tetap'], 
            ['nama_akun' => 'Hutang Bank Jangka Pendek', 'kode_akun' => '2101', 'jenis_akun' => 'pasiva'], 
            ['nama_akun' => 'Hutang lembaga Keuangan Bukan Bank (LKBB) Jangka Pendek', 'kode_akun' => '2102', 'jenis_akun' => 'pasiva'], 
            ['nama_akun' => 'Hutang Usaha', 'kode_akun' => '2211', 'jenis_akun' => 'pasiva'], 
            ['nama_akun' => 'Hutang Gaji dan Upah', 'kode_akun' => '2221', 'jenis_akun' => 'pasiva'], 
            ['nama_akun' => 'Biaya yang Masih Harus Dibayar', 'kode_akun' => '2402', 'jenis_akun' => 'pasiva'], 
            ['nama_akun' => 'Pendapatan yang Diterima Dimuka', 'kode_akun' => '2403', 'jenis_akun' => 'Pendapatan'], 
            ['nama_akun' => 'Penerimaan Uang Muka', 'kode_akun' => '2405', 'jenis_akun' => 'pasiva'], 
            ['nama_akun' => 'Hutang Pembelian Aktiva Tetap', 'kode_akun' => '2406', 'jenis_akun' => 'pasiva'], 
            ['nama_akun' => 'Kewajiban Jangka Panjang', 'kode_akun' => '2501', 'jenis_akun' => 'pasiva'], 
            ['nama_akun' => 'Hutang Bank / Lembaga Keuangan Bukan Bank Jangka Panjang', 'kode_akun' => '2502', 'jenis_akun' => 'pasiva'], 
            ['nama_akun' => 'Hutang Sewa Guna Usaha', 'kode_akun' => '2601', 'jenis_akun' => 'pasiva'], 
            ['nama_akun' => 'Modal', 'kode_akun' => '6101', 'jenis_akun' => 'ekuitas'], 
            ['nama_akun' => 'Saldo Laba', 'kode_akun' => '6301', 'jenis_akun' => 'ekuitas'], 
            ['nama_akun' => 'Saldo Rugi', 'kode_akun' => '3302', 'jenis_akun' => 'ekuitas'], 
            ['nama_akun' => 'Saldo Laba Tahun Lalu', 'kode_akun' => '6304', 'jenis_akun' => 'ekuitas'], 
            ['nama_akun' => 'Saldo Rugi Tahun lalu', 'kode_akun' => '3305', 'jenis_akun' => 'ekuitas'], 
            ['nama_akun' => 'Laba Tahun Berjalan', 'kode_akun' => '6306', 'jenis_akun' => 'ekuitas'], 
            ['nama_akun' => 'Rugi Tahun Berjalan', 'kode_akun' => '3307', 'jenis_akun' => 'ekuitas'], 
            ['nama_akun' => 'Prive', 'kode_akun' => '3308', 'jenis_akun' => 'aktiva_lancar'], 
            ['nama_akun' => 'Dividen', 'kode_akun' => '3309', 'jenis_akun' => 'aktiva_lancar'], 
            ['nama_akun' => 'Ikhtisar Laba Rugi (Laba/Biaya)', 'kode_akun' => '3401', 'jenis_akun' => 'ikhtisar'], 
            ['nama_akun' => 'Ikhtisar Laba Rugi (Rugi/Pendapatan)', 'kode_akun' => '6402', 'jenis_akun' => 'ikhtisar'], 
            ['nama_akun' => 'Pendapatan Tiket Masuk Obyek Wisata Curug Bayan', 'kode_akun' => '4101', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Tiket Lainnya', 'kode_akun' => '4199', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Paket Outbond', 'kode_akun' => '4201', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Retail Flying Fox', 'kode_akun' => '4202', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Retail Tree Track', 'kode_akun' => '4203', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Retail Tubing', 'kode_akun' => '4204', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Paket Wisata Lainnya', 'kode_akun' => '4299', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Sewa Peralatan Camping ', 'kode_akun' => '4301', 'jenis_akun' => 'pendapatan'],
            ['nama_akun' => 'Pendapatan Sewa Tempat', 'kode_akun' => '4302', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Sewa Peralatan Lainnya', 'kode_akun' => '4303', 'jenis_akun' => 'pendapatan'],  
            ['nama_akun' => 'Pendapatan Sewa Lainnya', 'kode_akun' => '4399', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Parkir Kendaraan', 'kode_akun' => '4401', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Usaha Lainnya', 'kode_akun' => '4499', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan Bunga Bank', 'kode_akun' => '4501', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Pendapatan di Luar Usaha Lainnya', 'kode_akun' => '4599', 'jenis_akun' => 'pendapatan'], 
            ['nama_akun' => 'Beban Gaji Karyawan', 'kode_akun' => '5101', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Upah Karyawan Part Time ', 'kode_akun' => '5102', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Asuransi Karyawan', 'kode_akun' => '5103', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Tunjangan Hari Raya ', 'kode_akun' => '5104', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Tunjangan Hari Tua', 'kode_akun' => '5105', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Bantuan Pengobatan', 'kode_akun' => '5106', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Bantuan Biaya Opname Rumah Sakit', 'kode_akun' => '5107', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Listrik', 'kode_akun' => '5201', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Air', 'kode_akun' => '5202', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Telepon', 'kode_akun' => '5203', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Transportasi', 'kode_akun' => '5204', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Konsumsi Kegiatan', 'kode_akun' => '5205', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Akomodasi', 'kode_akun' => '5206', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Rapat', 'kode_akun' => '5207', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Pelatihan', 'kode_akun' => '5208', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Sewa Tanah', 'kode_akun' => '5301', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Sewa Bangunan', 'kode_akun' => '5302', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Sewa Kendaraan', 'kode_akun' => '5303', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Sewa Peralatan', 'kode_akun' => '5304', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Sewa Lainnya', 'kode_akun' => '5399', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Penyusutan Gedung ', 'kode_akun' => '5401', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Penyusutan Peralatan Outbond', 'kode_akun' => '54011', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Penyusutan Peralatan Camping', 'kode_akun' => '5402', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Penyusutan Peralatan High Rope', 'kode_akun' => '5403', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Penyusutan Peralatan Maintenance', 'kode_akun' => '5404', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Penyusutan Peralatan Kantor', 'kode_akun' => '5405', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Penyusutan Kendaraan', 'kode_akun' => '5406', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Asuransi Konsumen', 'kode_akun' => '5501', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Perlengkapan', 'kode_akun' => '5502', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Operasional Lainnya', 'kode_akun' => '5599', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Administrasi dan Umum', 'kode_akun' => '5600', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Gaji Bagian Administrasi', 'kode_akun' => '5601', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Alat Tulis Kantor', 'kode_akun' => '5602', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Fotocopy', 'kode_akun' => '5603', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Cetak', 'kode_akun' => '5604', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Konsumsi Kantor', 'kode_akun' => '5605', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Administrasi dan Umum Lainnya', 'kode_akun' => '5699', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Pemeliharaan Gedung', 'kode_akun' => '5701', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Pemeliharaan Peralatan High Rope', 'kode_akun' => '5702', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Pemeliharaan Peralatan Camping', 'kode_akun' => '5703', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Pemeliharaan Peralatan Maintenance', 'kode_akun' => '5704', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Pemeliharaan Peralatan Kantor', 'kode_akun' => '5705', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Pemeliharaan Peralatan Lainnya', 'kode_akun' => '5706', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Pemeliharaan Kendaraan', 'kode_akun' => '5707', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Pemeliharaan Lingkungan', 'kode_akun' => '5708', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Penataan Lahan', 'kode_akun' => '5709', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Setor Pemerintah Desa Ketenger', 'kode_akun' => '5801', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Setor Perhutani', 'kode_akun' => '5802', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Sumbangan Sosial', 'kode_akun' => '5811', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Administrasi dan Pajak Bank', 'kode_akun' => '5901', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Pajak', 'kode_akun' => '5902', 'jenis_akun' => 'beban'], 
            ['nama_akun' => 'Beban Lainnya', 'kode_akun' => '5999', 'jenis_akun' => 'beban'],
        ]);

        $this->command->info('Berhasil Menambahkan Beberapa Akun');
    }
}