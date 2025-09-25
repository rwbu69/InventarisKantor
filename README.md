# 📦 Sistem Inventaris Kantor

Aplikasi web untuk manajemen inventaris kantor yang dibangun menggunakan Laravel 12 dengan desain Bootstrap yang modern dan responsif.

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [ERD (Entity Relationship Diagram)](#erd-entity-relationship-diagram)
- [Flowchart Sistem](#flowchart-sistem)
- [Arsitektur MVC](#arsitektur-mvc)
- [CRUD Operations](#crud-operations)
- [Instalasi & Setup](#instalasi--setup)
- [Penggunaan](#penggunaan)
- [Teknologi](#teknologi)

---

## 🚀 Fitur Utama

- ✅ **Dashboard Statistik** - Menampilkan ringkasan data inventaris
- ✅ **Manajemen CRUD Lengkap** - Create, Read, Update, Delete
- ✅ **Interface Bahasa Indonesia** - Seluruh interface dalam Bahasa Indonesia
- ✅ **Desain Responsif** - Bootstrap 5.3.2 dengan desain modern
- ✅ **Validasi Form** - Validasi data input yang komprehensif
- ✅ **Pagination** - Menampilkan data dalam halaman terpisah
- ✅ **Search & Filter** - Pencarian dan penyaringan data (dapat dikembangkan)

---

## 🗄️ ERD (Entity Relationship Diagram)

### Struktur Database

```
┌─────────────────────────────────────────┐
│                INVENTORIES              │
├─────────────────────────────────────────┤
│ PK  id (bigint, auto_increment)         │
│     nama_barang (varchar(255))          │
│     deskripsi (text, nullable)          │
│     kategori (varchar(255))             │
│     jumlah (integer)                    │
│     satuan (varchar(255))               │
│     harga (decimal(10,2), nullable)     │
│     lokasi (varchar(255))               │
│     tanggal_masuk (date)                │
│     kondisi (varchar(255))              │
│ UK  kode_barang (varchar(255), unique)  │
│     created_at (timestamp)              │
│     updated_at (timestamp)              │
└─────────────────────────────────────────┘
```

### Penjelasan Field:

| Field | Tipe Data | Deskripsi | Constraint |
|-------|-----------|-----------|------------|
| `id` | bigint | Primary Key, auto increment | NOT NULL, PRIMARY KEY |
| `nama_barang` | varchar(255) | Nama item inventaris | NOT NULL |
| `deskripsi` | text | Deskripsi detail barang | NULLABLE |
| `kategori` | varchar(255) | Kategori barang (Elektronik, Furniture, dll) | NOT NULL |
| `jumlah` | integer | Jumlah/stok barang | NOT NULL |
| `satuan` | varchar(255) | Satuan barang (Unit, Pcs, Set, dll) | NOT NULL |
| `harga` | decimal(10,2) | Harga per unit dalam Rupiah | NULLABLE |
| `lokasi` | varchar(255) | Lokasi penyimpanan barang | NOT NULL |
| `tanggal_masuk` | date | Tanggal barang masuk ke inventaris | NOT NULL |
| `kondisi` | varchar(255) | Kondisi barang (Baik, Rusak, dll) | NOT NULL, DEFAULT 'Baik' |
| `kode_barang` | varchar(255) | Kode unik untuk setiap barang | NOT NULL, UNIQUE |
| `created_at` | timestamp | Waktu pembuatan record | AUTO |
| `updated_at` | timestamp | Waktu update terakhir record | AUTO |

---

## 🔄 Flowchart Sistem

### 1. Alur Utama Aplikasi

```
                                    [Start]
                                       │
                                 [Akses Dashboard]
                                       │
                              ┌─ [Pilih Menu] ─┐
                              │                 │
                        [Dashboard]         [Tambah Barang]
                              │                 │
                    [Tampilkan Statistik     [Form Tambah]
                      & List Inventaris]        │
                              │            [Validasi Input]
                        ┌─ [Aksi Item] ─┐      │
                        │               │   [Valid?] ─No─┐
                   [Detail]         [Edit/Hapus]         │
                        │               │                │
                  [Lihat Detail]   [Form Edit/           │
                        │          Konfirmasi Hapus]     │
                        │               │                │
                        │          [Update/Delete        │
                        │           Database]            │
                        │               │                │
                        └───────────────┼────────────────┘
                                        │
                              [Redirect ke Dashboard
                               dengan Success Message]
                                        │
                                     [End]
```

### 2. Alur CRUD Operations

```
CREATE (Tambah)          READ (Tampilkan)         UPDATE (Edit)           DELETE (Hapus)
      │                        │                       │                      │
 [Form Input]             [Request Data]         [Form Edit dengan       [Konfirmasi]
      │                        │                 Data Existing]               │
 [Validasi Data]          [Query Database]             │                 [Hapus dari DB]
      │                        │                [Validasi Update]             │
 [Insert Database]        [Format & Tampilkan]         │                [Success Message]
      │                        │                [Update Database]             │
 [Success Message]        [Pagination/View]            │                   [Redirect]
      │                        │                [Success Message]
   [Redirect]               [User Interface]           │
                                                  [Redirect]
```

---

## 🏗️ Arsitektur MVC

### 1. Model (`app/Models/Inventory.php`)

**Fungsi Model:**
- Representasi data dan business logic
- Interaksi dengan database
- Validasi data level model
- Definisi relationships (jika ada)

```php
class Inventory extends Model
{
    // Definisi field yang dapat diisi mass assignment
    protected $fillable = [
        'nama_barang', 'deskripsi', 'kategori', 
        'jumlah', 'satuan', 'harga', 'lokasi',
        'tanggal_masuk', 'kondisi', 'kode_barang'
    ];

    // Casting tipe data otomatis
    protected $casts = [
        'tanggal_masuk' => 'date',
        'harga' => 'decimal:2'
    ];
}
```

**Cara Kerja Model:**
1. **Eloquent ORM**: Model menggunakan Eloquent untuk berinteraksi dengan database
2. **Mass Assignment Protection**: `$fillable` melindungi dari mass assignment vulnerability
3. **Automatic Casting**: `$casts` otomatis mengkonversi tipe data saat retrieve/save
4. **Timestamps**: Laravel otomatis mengelola `created_at` dan `updated_at`

### 2. Controller (`app/Http/Controllers/InventoryController.php`)

**Fungsi Controller:**
- Menangani HTTP requests
- Koordinasi antara Model dan View
- Business logic aplikasi
- Validasi input
- Response handling

```php
class InventoryController extends Controller
{
    public function index()
    {
        // Mengambil data dengan pagination
        $inventories = Inventory::latest()->paginate(10);
        return view('inventories.index', compact('inventories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([...]);
        
        // Simpan ke database
        Inventory::create($request->all());
        
        // Redirect dengan pesan sukses
        return redirect()->route('inventories.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }
}
```

**Cara Kerja Controller:**
1. **Route Binding**: Controller methods terikat dengan routes
2. **Request Handling**: Menerima dan memproses HTTP requests
3. **Validation**: Memvalidasi input sebelum memproses data
4. **Model Interaction**: Memanggil model untuk CRUD operations
5. **Response**: Mengembalikan view atau redirect response

### 3. Migration (`database/migrations/xxxx_create_inventories_table.php`)

**Fungsi Migration:**
- Version control untuk database schema
- Membuat/mengubah struktur tabel
- Rollback capability
- Team collaboration untuk database changes

```php
public function up(): void
{
    Schema::create('inventories', function (Blueprint $table) {
        $table->id();
        $table->string('nama_barang');
        $table->text('deskripsi')->nullable();
        // ... field lainnya
        $table->string('kode_barang')->unique();
        $table->timestamps();
    });
}
```

**Cara Kerja Migration:**
1. **Schema Builder**: Menggunakan Laravel Schema Builder untuk membuat tabel
2. **Version Control**: Setiap migration memiliki timestamp unik
3. **Up/Down Methods**: `up()` untuk create, `down()` untuk rollback
4. **Batch Tracking**: Laravel track migration batch untuk rollback yang tepat

---

## 🔧 CRUD Operations

### 1. CREATE (Tambah Data)

**Alur Proses:**
```
GET /inventories/create → Tampilkan Form → POST /inventories → Validasi → Simpan → Redirect
```

**Controller Method:**
```php
public function create()
{
    return view('inventories.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama_barang' => 'required|max:255',
        'kode_barang' => 'required|unique:inventories,kode_barang',
        // validasi lainnya...
    ]);
    
    Inventory::create($request->all());
    return redirect()->route('inventories.index')
        ->with('success', 'Barang berhasil ditambahkan');
}
```

**Fitur Validasi:**
- Required fields validation
- Unique constraint untuk kode_barang
- Numeric validation untuk jumlah dan harga
- Date validation untuk tanggal_masuk

### 2. READ (Tampilkan Data)

**Alur Proses:**
```
GET /inventories → Query Database → Format Data → Tampilkan View
```

**Controller Methods:**
```php
public function index()
{
    $inventories = Inventory::latest()->paginate(10);
    return view('inventories.index', compact('inventories'));
}

public function show(Inventory $inventory)
{
    return view('inventories.show', compact('inventory'));
}
```

**Fitur:**
- **Pagination**: Data ditampilkan per halaman (10 items)
- **Latest First**: Data terbaru ditampilkan di atas
- **Route Model Binding**: Otomatis inject model berdasarkan ID
- **Statistics**: Dashboard menampilkan statistik real-time

### 3. UPDATE (Edit Data)

**Alur Proses:**
```
GET /inventories/{id}/edit → Load Data → Tampilkan Form → PUT /inventories/{id} → Update
```

**Controller Methods:**
```php
public function edit(Inventory $inventory)
{
    return view('inventories.edit', compact('inventory'));
}

public function update(Request $request, Inventory $inventory)
{
    $request->validate([
        'kode_barang' => 'required|unique:inventories,kode_barang,' . $inventory->id,
        // validasi lainnya...
    ]);
    
    $inventory->update($request->all());
    return redirect()->route('inventories.index')
        ->with('success', 'Data berhasil diperbarui');
}
```

**Fitur Khusus:**
- **Unique Validation Exception**: Mengecualikan record yang sedang diedit
- **Pre-filled Form**: Form otomatis terisi dengan data existing
- **Selective Update**: Hanya field yang diubah yang di-update

### 4. DELETE (Hapus Data)

**Alur Proses:**
```
DELETE /inventories/{id} → Konfirmasi → Hapus dari Database → Redirect
```

**Controller Method:**
```php
public function destroy(Inventory $inventory)
{
    $inventory->delete();
    return redirect()->route('inventories.index')
        ->with('success', 'Barang berhasil dihapus');
}
```

**Fitur Keamanan:**
- **JavaScript Confirmation**: Konfirmasi sebelum menghapus
- **Soft Delete**: Dapat diimplementasikan untuk recovery
- **Cascade Delete**: Jika ada relasi, akan menghapus data terkait

---

## 🛠️ Instalasi & Setup

### Prerequisites
- PHP 8.2 atau lebih tinggi
- Composer
- MySQL/MariaDB
- Node.js & NPM (opsional, untuk asset compilation)

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone <repository-url>
cd InventarisKantor
```

2. **Install Dependencies**
```bash
composer install
npm install # jika menggunakan Vite
```

3. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Configuration**
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventariskantor
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Database Migration**
```bash
php artisan migrate
php artisan db:seed --class=InventorySeeder # untuk data sample
```

6. **Start Development Server**
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

---

## 📱 Penggunaan

### Dashboard Utama
- **Statistik Cards**: Total barang, kondisi baik, perlu perhatian, total nilai
- **Tabel Inventaris**: Daftar semua barang dengan aksi CRUD
- **Pagination**: Navigasi halaman untuk data banyak

### Menambah Barang Baru
1. Klik tombol "Tambah Barang Baru"
2. Isi form dengan data lengkap:
   - Kode Barang (unique)
   - Nama Barang
   - Deskripsi (opsional)
   - Kategori (dropdown)
   - Jumlah & Satuan
   - Harga (opsional)
   - Lokasi
   - Tanggal Masuk
   - Kondisi
3. Klik "Simpan Barang"

### Mengedit Barang
1. Klik ikon pensil (edit) pada item yang ingin diedit
2. Form akan terisi dengan data existing
3. Ubah data yang diperlukan
4. Klik "Update Barang"

### Melihat Detail
1. Klik ikon mata (view) untuk melihat detail lengkap
2. Halaman detail menampilkan semua informasi barang
3. Tersedia tombol edit dan hapus

### Menghapus Barang
1. Klik ikon sampah (delete)
2. Konfirmasi penghapusan
3. Data akan dihapus permanent dari database

---

## 💻 Teknologi

### Backend
- **Laravel 12**: PHP Framework
- **PHP 8.2**: Programming Language
- **MySQL**: Database Management System
- **Eloquent ORM**: Object-Relational Mapping

### Frontend
- **Bootstrap 5.3.2**: CSS Framework
- **Bootstrap Icons**: Icon Library
- **Blade Templates**: Laravel Templating Engine
- **Responsive Design**: Mobile-first approach

### Tools & Libraries
- **Composer**: PHP Dependency Manager
- **Artisan**: Laravel Command Line Interface
- **Migration**: Database Version Control
- **Validation**: Form Input Validation
- **Pagination**: Data Pagination System

---

## 📁 Struktur Direktori

```
InventarisKantor/
├── app/
│   ├── Http/Controllers/
│   │   └── InventoryController.php
│   └── Models/
│       └── Inventory.php
├── database/
│   ├── migrations/
│   │   └── xxxx_create_inventories_table.php
│   └── seeders/
│       └── InventorySeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       └── inventories/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
├── routes/
│   └── web.php
└── README.md
```

---

## 🚀 Pengembangan Selanjutnya

Fitur yang dapat dikembangkan:
- **User Authentication**: Login/logout system
- **Role Management**: Admin dan user biasa
- **Advanced Search**: Pencarian berdasarkan kategori, lokasi, dll
- **Export/Import**: Export ke Excel/PDF, import dari CSV
- **Barcode Integration**: Generate dan scan barcode
- **Notifications**: Alert untuk barang rusak atau stok habis
- **Audit Trail**: Track perubahan data
- **Dashboard Analytics**: Grafik dan chart statistics
- **API Integration**: RESTful API untuk mobile app

---

## 📞 Support

Jika ada pertanyaan atau masalah, silakan buat issue di repository atau hubungi developer.

---

**© 2025 Sistem Inventaris Kantor - Built with ❤️ using Laravel**
