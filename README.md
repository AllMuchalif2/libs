# 1. Pendahuluan

## 1.1 Tujuan
Memigrasi aplikasi perpustakaan dari SLiMS 7 Senayan menjadi aplikasi baru karena masalah keterbaruan dan keamanan.

## 1.2 Ruang Lingkup
**Masuk dalam pengerjaan:**
1. Fokus platform dan antarmuka
2. Katalogisasi bibliografi
3. Manajeman Sirkulasi
4. Migrasi Data

**Yang tidak masuk dalam pengerjaan:**
1. Aplikasi KUBUKU

## 1.3 Target Pengguna
1. **Admin Sistem Perpustakaan:** Pengelola aplikasi perpustakaan. Tingkat tertinggi pengguna aplikasi.
2. **Pustakawan:** Staff atau pegawai perpustakaan yang hanya bisa mengakses fitur terbatas seperti: pemrosesan peminjaman, pengembalian dan denda. Melihat data buku dan anggota sekaligus cetak kartu anggota.
3. **Anggota Perpustakaan:** Anggota atau mahasiswa yang terdaftar dalam aplikasi, menggunakan aplikasi untuk melihat riwayat kunjungan, peminjaman, dan denda.

---

# 2. Arsitektur & Alur Proses
*(Bagian ini dapat diisi dengan diagram arsitektur atau flowchart sistem)*

---

# 3. Kebutuhan Fungsional (Functional Requirements)

| ID | Fitur | Deskripsi | Prioritas |
| :--- | :--- | :--- | :--- |
| **AP-01** | Online Catalog | Sistem menyediakan fitur pencarian dan tampilan detail koleksi buku secara daring. Pengguna (Tamu dan Anggota) dapat mencari buku berdasarkan judul, pengarang, atau kategori, serta melihat informasi bibliografi dan status ketersediaan buku. | High |
| **AP-02** done | Buku Tamu | Sistem menyediakan fitur pencatatan kunjungan digital. Tamu dapat mengisi buku tamu tanpa login, sedangkan Anggota dapat melihat riwayat kunjungan mereka. | Medium |
| **AP-03** done | Login Anggota | Sistem mengautentikasi Anggota menggunakan username dan password terdaftar. Akses ditolak apabila kredensial tidak valid. | High |
| **AP-04** | Keanggotaan | Sistem mengelola data keanggotaan sesuai hak akses masing-masing peran. Anggota dapat melihat riwayat kunjungan dan peminjaman dan menerima notifikasi jatuh tempo. Pustakawan dapat mencetak kartu anggota. Admin dapat menarik data dari SIAKAD, menambah anggota baru, dan mencetak kartu anggota. | High |
| **AP-05** done | Login Pustakawan | Sistem mengautentikasi Pustakawan menggunakan akun yang dikelola oleh Admin, dengan hak akses sesuai peran yang ditetapkan. | High |
| **AP-06** | Sirkulasi (Peminjaman & Pengembalian) | Sistem memproses transaksi peminjaman dan pengembalian buku yang dioperasikan oleh Pustakawan. Denda dihitung otomatis per hari keterlambatan setelah melewati toleransi satu minggu. Riwayat transaksi dapat difilter berdasarkan periode, anggota, atau judul. | High |
| **AP-07** | Bibliografi | Sistem mengelola data koleksi buku. Pustakawan dapat melihat data koleksi. Admin dapat melakukan operasi CRUD terhadap data bibliografi dan mencetak barcode eksemplar (opsional, menyesuaikan ketersediaan perangkat). | High |
| **AP-08** | Profil | Sistem menyediakan halaman profil bagi Pustakawan dan Admin untuk melihat dan memperbarui informasi akun seperti nama, email, dan kata sandi. | Low |
| **AP-09** | Denda | Sistem mengelola pencatatan dan pembayaran denda keterlambatan yang dioperasikan oleh Pustakawan. Besaran denda dihitung otomatis berdasarkan tarif dan jumlah hari keterlambatan. | High |
| **AP-10** done | Login Admin | Sistem mengautentikasi Admin melalui antarmuka khusus administrator dengan hak akses penuh terhadap seluruh konfigurasi dan operasional sistem. | High |
| **AP-11** | Database | Sistem menyediakan fasilitas backup, import, dan export basis data yang dioperasikan oleh Admin untuk keperluan pemeliharaan dan migrasi data. | High |
| **AP-12** | Laporan | Sistem menghasilkan laporan statistik perpustakaan yang dicetak oleh Admin, mencakup data koleksi, keanggotaan, sirkulasi, dan rekap pengunjung per bulan dalam format Excel dan PDF. Tersedia pula laporan buku rusak dan hilang. | High |
| **AP-13** done | Master File | Sistem menyediakan pengelolaan data referensi oleh Admin, mencakup GMD, mata kuliah, topik, penerbit, rak buku, dan pengarang. | Medium |

---

# 4. Integrasi

1. **SIAKAD / LMS**
   * **Tujuan:** Otomatisasi pendaftaran dan pembaharuan data keanggotaan perpustakaan.
   * **Mekanisme:** Aplikasi perpustakaan akan melakukan *pull data* (menarik data) dari *endpoint* API SIAKAD/LMS kampus secara berkala.
   * **Data yang Ditarik:** Data demografi mahasiswa baru, meliputi NIM, nama, fakultas, program studi, dan email untuk dimasukkan ke dalam tabel members. Hal ini menghilangkan proses input data manual oleh pustakawan saat ada mahasiswa baru.

2. **WhatsApp Gateway**
   * **Tujuan:** Fitur notifikasi otomatis.
   * **Mekanisme:** Sistem diintegrasikan dengan penyedia layanan WhatsApp API/Gateway pihak ketiga (Fonnte). Aplikasi akan melakukan HTTP POST Request ke endpoint Fonnte untuk mengirimkan pesan kepada nomor WhatsApp anggota (`whatsapp_number`).
   * **Skenario Penggunaan:** Pengiriman notifikasi tagihan denda, pengingat jatuh tempo pengembalian buku (H-1 Due Date).

3. **API Hari Libur Nasional** done
   * **Tujuan:** Otomatisasi perhitungan hari kerja efektif untuk penentuan tanggal jatuh tempo (*due date*) peminjaman, agar sistem secara presisi mengabaikan tanggal merah tanpa perlu pengaturan manual oleh pustakawan.
   * **Mekanisme:** Aplikasi menggunakan fitur Task Scheduler untuk melakukan penarikan data (*pull data* via HTTP GET Request) dari endpoint API Kalender Publik (seperti Google Calendar API atau API open-source Hari Libur Indonesia) secara terjadwal (misalnya setahun atau sebulan sekali).
   * **Data yang Ditarik:** Data kalender tanggal merah yang meliputi tanggal spesifik (`holiday_date`) dan keterangan nama libur (`description`) untuk disimpan dan disinkronisasikan ke dalam tabel `mst_holidays`.

---

# 5. Kebutuhan Non-Fungsional

**Keamanan:**
* Sistem harus mengamankan data sensitif pengguna.
* Sistem harus aman dari kebocoran data dan akses yang tidak sah.

**Performa:**
* Sistem harus memiliki waktu *response* yang cepat.
* Penulisan *query* basis data harus efisien.

**Kebergunaan:**
* Antarmuka publik menggunakan pendekatan *mobile-first* atau *responsive* dan mudah digunakan.
* Antarmuka admin harus mudah dipahami dan digunakan.

**Pemeliharaan:**
* Harus menyediakan *code* yang bersih serta dokumentasi yang jelas.