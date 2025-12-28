# WebTrack Management System

Aplikasi manajemen surat masuk, surat keluar, dan agenda kegiatan berbasis web menggunakan **Laravel 12**. Aplikasi ini dirancang dengan arsitektur **MVC**, **Service Layer**, dan **Custom CSS Design System** untuk performa tinggi dan tampilan yang bersih.

---

## 🏗 Backend Architecture

Backend dibangun di atas framework Laravel 12 dengan fokus pada *Separation of Concerns* (pemisahan tanggung jawab) dan keamanan berbasis *Role*.

### 1. Struktur Database & Model
Menggunakan MySQL dengan relasi yang terintegrasi:
- **Users**: Menyimpan data pengguna dengan role (`admin` / `user`).
- **SuratMasuk**: Tabel surat masuk, berelasi dengan `User` (creator) dan `KategoriSurat`.
- **SuratKeluar**: Tabel surat keluar, berelasi dengan `User` (creator) dan `KategoriSurat`.
- **AgendaKegiatan**: Tabel agenda, berelasi dengan `JenisAgenda`.
- **Fitur Status**: Semua tabel data memiliki kolom `status` (`pending`, `approved`, `rejected`) untuk workflow persetujuan.

### 2. Service Layer Pattern
Logika bisnis dipisahkan dari Controller ke dalam **Service Classes** (`App\Services`), menjadikan kode lebih rapi dan reusable:
- `SuratMasukService`, `SuratKeluarService`, `AgendaService`: Menangani operasi CRUD (Create, Read, Update, Delete) dan logika approval (`approve`/`reject`).

### 3. Authentication & Authorization (Roles)
Keamanan dikelola secara ketat menggunakan sistem bawaan Laravel:
- **Middleware `admin`**: Membatasi akses rute khusus admin (seperti hapus data permanen atau approve surat).
- **Policies (`SuratMasukPolicy`, dll)**: Mengontrol hak akses granular di level Method.
    - **User Biasa**: Bisa membuat Surat Masuk. Bisa edit data sendiri *hanya* jika status masih `pending`. Tidak bisa akses menu Admin.
    - **Admin**: Full akses untuk membuat semua jenis surat/agenda, mengedit, menghapus, dan menyetujui/menolak pengajuan.

### 4. Approval Workflow
Sistem memiliki alur kerja persetujuan bawaan:
1.  **Submission**: User membuat Surat Masuk -> Status otomatis **Pending**.
2.  **Review**: Admin melihat notifikasi badge merah di sidebar.
3.  **Action**: Admin membuka detail surat -> Klik **Setujui** atau **Tolak**.
4.  **Result**: Status berubah menjadi hijau (Disetujui) atau merah (Ditolak).

---

## 🎨 Frontend Architecture

Frontend dibangun menggunakan **Blade Templating Engine** tanpa framework CSS berat (seperti Bootstrap/Tailwind), melainkan menggunakan **Custom CSS Design System** yang efisien dan ringan.

### 1. Custom CSS System
Aplikasi menggunakan sistem CSS modular yang terletak di `public/css/`:
- **`variables.css`**: Menyimpan "Design Tokens" (Warna utama, ukuran font, spacing, radius border) sebagai CSS Variables (`:root`). Mengubah tema aplikasi cukup dengan mengedit file ini.
- **`layout.css`**: Mengatur struktur layout utama (Sidebar, Navbar, Responsive Grid) menggunakan Flexbox.
- **`components.css`**: Menyediakan komponen UI reusable seperti:
    - `.card`: Kontainer dengan shadow halus.
    - `.btn`: Tombol modern dengan animasi hover.
    - `.badge`: Label status warna-warni.
    - `.table`: Tabel responsif yang rapi.
- **`utilities.css`**: Kelas bantuan untuk margin/padding cepat.

### 2. Minimalist Sidebar UI
Sidebar didesain ulang dengan filosofi **Clean & Minimalist**:
- **Warna**: Background putih bersih dengan teks abu-abu tua, memberikan kenyamanan visual.
- **Navigasi**: Menggunakan ikon SVG (Heroicons) yang simpel.
- **Badge Notifikasi**: Penanda jumlah item `pending` yang muncul otomatis di sebelah kanan menu dengan warna merah mencolok namun rapi.

### 3. Blade Components
- **`x-sidebar`**: Komponen sidebar yang reusable.
- **`x-navbar`**: Header atas.
- **`layouts.app`**: Master layout yang membungkus semua konten halaman.

### 4. JavaScript Enhancements
- **Password Toggle**: Fitur "intip" password (show/hide) pada halaman login menggunakan Vanilla JS yang ringan.
- **Confirmation Alerts**: Browser confirm dialog saat Admin melakukan aksi destruktif (Reject/Delete).

---

## 🚀 Cara Instalasi

1.  **Clone Repository**
    ```bash
    git clone [repo-url]
    cd web_track
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    ```

3.  **Setup Environment**
    Copy `.env.example` menjadi `.env` dan atur koneksi database Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Migrasi & Seeding**
    Jalankan perintah ini untuk membuat tabel dan mengisi data awal (Admin & User Dummy).
    ```bash
    php artisan migrate:fresh --seed
    ```

5.  **Jalankan Server**
    ```bash
    php artisan serve
    ```

6.  **Login**
    - **Admin**: `admin@example.com` / `password`
    - **User**: `user@example.com` / `password`
