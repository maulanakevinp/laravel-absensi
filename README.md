<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

User Admin:
- Dapat melakukan CRUD Karyawan dengan isi sebagai berikut: No. Anggota Karyawan, Nama Karyawan, dan Random hash Password
- Dapat melakukan Edit dan Read pada Presensi Karyawan dengan isi sebagai berikut: Tanggal, Bulan, Tahun, No. Anggota Karyawan, Nama, Jam Masuk, Pukul, Jam Pulang, Pukul, Total Jam Kerja
- Dapat melakukan Read terhadap Total Kerja per Karyawan ataupun semua Karyawan baik itu per Hari, per Bulan, ataupun per Tahun dan bisa mendownload data tersebut dalam bentuk Excel
- Total Kerja merupakan Total yang didapat dari Carbon::parse Pukul (Jam Masuk) dan Pukul (Jam Pulang) dikurangi 1 jam istirahat

User Karyawan:
- Dapat login menggunakan No. Anggota Karyawan dan password
- Dapat melakukan Create Presensi (Create Presensi hanya dapat dilakukan jika Karyawan sudah masuk ke dalam Wifi dengan IP Address yang telah terdaftar ke sistem)
- Create Presensi Karyawan berupa Check-in (Check-in hanya dapat dilakukan jika sudah berada diantara 1 jam sebelum jam masuk - jam pulang), Check-out (Check-out hanya dapat dilakukan jika sudah melewati jam pulang)
- Jika Karyawan melakukan Create Presensi Jam Masuk pada 1 jam sebelum jam masuk maka tergolong Masuk
- Jika Karyawan melakukan Create Presensi Jam Masuk pada jam masuk - jam pulang maka tergolong Telat
- Jika Karyawan tidak melakukan Create Presensi Jam Masuk hingga jam pulang maka tergolong Alpha

## Donasinya Kakak https://saweria.co/maulanakevinp Terima Kasih ^_^
