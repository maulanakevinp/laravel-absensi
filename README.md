<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

User Admin:
- Dapat melakukan CRUD Karyawan dengan isi sebagai berikut: No. Anggota Karyawan, Nama Karyawan, dan Random hash Password
- Dapat melakukan Edit dan Read pada Presensi Karyawan dengan isi sebagai berikut: Tanggal, Bulan, Tahun, No. Anggota Karyawan, Nama, Jam Masuk, Pukul, Jam Keluar, Pukul, Total Jam Kerja, dan Total Jam Kerja (Lembur)
- Dapat melakukan Read terhadap Total Kerja dan Total Kerja (Lembur) per Karyawan ataupun semua Karyawan baik itu per Hari, per Bulan, ataupun per Tahun dan bisa mendownload data tersebut dalam bentuk Excel
- Total Kerja merupakan Total yang didapat dari Carbon::parse Pukul (Jam Masuk) dan Pukul (Jam Keluar) dikurangi 1 jam istirahat dengan Jam Keluar terhitung 17.00 jika tidak tergolong Lembur
- Total Kerja Lembur merupakan Total yang didapat dari Carbon::parse 19.00 dan Pukul (Jam Keluar) jika tergolong Lembur.
- Jika Karyawan tidak tergolong Lembur, maka Total Kerja Lembur dikosongkan atau memiliki value 0

User Karyawan:
- Dapat login menggunakan No. Anggota Karyawan dan password
- Dapat melakukan Create Presensi (Create Presensi hanya dapat dilakukan jika Karyawan sudah masuk ke dalam Wifi dengan IP Address yang telah terdaftar ke sistem)
- Create Presensi Karyawan berupa Jam Masuk (Jam Masuk hanya dapat dilakukan jika sudah berada diantara jam 07.00 - 17.00), Jam Keluar (Jam Keluar hanya dapat dilakukan jika sudah melewati jam 17.00), dan Jam Keluar Lembur (Jam Keluar Lembur hanya dapat dilakukan jika sudah melewati jam 19.00)
- Jika Karyawan melakukan Create Presensi Jam Masuk pada jam 07.00 - 08.00 maka tergolong Masuk
- Jika Karyawan melakukan Create Presensi Jam Masuk pada jam 08.00 - 17.00 maka tergolong Telat
- Jika Karyawan tidak melakukan Create Presensi Jam Masuk hingga jam 17.00 maka tergolong Alpha
- Jika Karyawan melakukan Create Presensi Jam Keluar sebelum jam 20.00 maka tidak tergolong Lembur
- Jika Karyawan melakukan Create Presensi Jam Keluar sesudah jam 20.00 maka tergolong lembur


Deadline: 20 Februari
