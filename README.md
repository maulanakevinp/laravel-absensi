[![Screenshot-20220926-100919.jpg](https://i.postimg.cc/BvHmMxmT/Screenshot-20220926-100919.jpg)](https://postimg.cc/cK17J8yC)

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

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Cara Install
- Clone repository ini
- Tunggu sampai proses clone selesai
- Buka folder porject yang sudah di clone melalui terminal
- Lakukan composer install ketik
```terminal
composer install
```
- Tunggu sampai proses selesai
- Buat database baru di phpmyadmin anda beri nama sesuka hati anda
- Copy file .env.example yang ada di dalam folder project dan ubah namanya menjadi .env
bagi yang menggunakan git bash bisa ketik seperti dibawah
```terminal
cp .env.example .env
```
- Lakukan generate key ketik 
```terminal
php artisan key:generate
```
- Buka file .env
- Ubah konfigurasi database sesuai nama database yang anda buat tadi lalu simpan
- lakukan migrate ketik :
```terminal
php artisan migrate:refresh --seed
```
- Finish project laravel bisa dijalankan dengan menggunakan development server dengan cara ketik
```terminal
php artisan serve
```
- Lalu ctrl+klik pada http://127.0.0.0:8000
