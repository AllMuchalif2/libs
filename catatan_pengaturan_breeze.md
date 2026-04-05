# Catatan Manajemen Autentikasi Member (Breeze)

Pada sistem perpustakaan di mana pendaftaran member dilakukan secara langsung (offline/di tempat oleh pustakawan), ada beberapa fitur bawaan Laravel Breeze yang perlu dievaluasi:

## 1. Registrasi New Member (`/register`)
- **Status:** **TIDAK PERLU** (untuk akses publik).
- **Alasan:** Karena sistem pendaftaran dilakukan langsung di perpustakaan, mengizinkan publik untuk mendaftar secara bebas dari web akan merusak integritas data (orang asing bisa mendaftar tanpa validasi identitas fisik).
- **Solusi:** Fitur registrasi web sebaiknya dinonaktifkan sepenuhnya.

## 2. Hapus Akun pada `/profile`
- **Status:** **TIDAK PERLU**.
- **Alasan:** Di perpustakaan, member sangat terkait dengan transaksi peminjaman (sirkulasi). Jika member bisa menghapus akunnya sendiri kapan saja, perpustakaan bisa kehilangan jejak jika member tersebut masih meminjam buku atau belum membayar denda. Penghapusan (atau lebih tepatnya non-aktif) akun harus dilakukan melalui persetujuan pustakawan.
- **Solusi:** Form "Delete Account" di halaman profile harus dihilangkan dan fungsinya dimatikan.

## 3. Reset Password Member
- **Status:** **OPSIONAL / BISA DIPERTAHANKAN**.
- **Alasan:** Fitur ini masih cukup relevan jika member memiliki akses untuk login (misal untuk mengecek histori peminjaman, katalog buku, dll). Jika member lupa password, fitur lupa password via email sangat membantu sehingga mereka tidak perlu terus-terusan mengganggu pustakawan. 
- *Catatan:* Perlu dipastikan SMTP/email di sistem berfungsi, serta setiap member memiliki alamat email yang valid saat didaftarkan oleh pustakawan. Jika tidak menggunakan fitur email, maka reset password harus dilakukan manual oleh admin/pustakawan.

---

## ⚠️ PENTING: Apakah aman jika hanya dihilangkan dari Tampilan/View?

**Jawabannya: TIDAK AMAN.** 

Jika Anda hanya menghapus tombol "Register" atau menghapus blok HTML untuk fitur "Delete Account" di file `.blade.php`, rute di belakang layar (backend) **masih tetap bisa diakses**.

Seseorang yang mengerti web (atau iseng) masih bisa:
1. Mengetikkan URL `example.com/register` secara manual di browser dan menggunakan form registrasi Breeze.
2. Mengirimkan _request_ `DELETE` ke URL `/profile` melalui Postman atau *Inspect Element*, yang mana akan menghapus akunnya.

### Cara Mematikan Sepenuhnya (Backend & Frontend)

Untuk benar-benar mematikan fitur tersebut, Anda perlu menonaktifkan rutenya di dalam file `routes/auth.php` dan `routes/web.php`.

**A. Menonaktifkan Registrasi**
Buka `routes/auth.php`, lalu hapus atau jadikan komentar (comment) baris berikut:
```php
// Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('register', [RegisteredUserController::class, 'store']);
```

**B. Menonaktifkan Hapus Akun**
Buka `routes/web.php` (atau file di mana route profile Anda berada), lalu cari group middleware `auth`. Jadikan komentar pada route `profile.destroy`:
```php
// Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
```

Dengan cara ini, apabila ada orang yang berusaha mengakses URL tersebut melalui Inspect Element, Postman, ataupun mengetik di browser, server akan menolaknya dan menampilkan *Error 404 Not Found* atau *405 Method Not Allowed*.
