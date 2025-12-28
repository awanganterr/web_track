# API Contract / Route Documentation
**Manajemen Surat & Agenda System**

> [!NOTE]
> Since this project uses **Laravel MVC (Web Routes)** with Session Authentication, the endpoints return **HTML** (Views), not JSON.
> To test in Postman, ensure you handle **Cookies/Sessions** and **CSRF Tokens**.

## Server Configuration
- **Base URL**: `http://127.0.0.1:8000` (Default Laravel Port)
- **Headers**:
    - `X-CSRF-TOKEN`: [Your CSRF Token] (Only if CSRF verification is active)
    - `Content-Type`: `application/x-www-form-urlencoded` (For POST requests)

## Authentication
**Mechanism**: Session Based (Browser Cookies) & CSRF Token.

### 1. Login
- **URL**: `/login`
- **Method**: `POST`
- **Body** (x-www-form-urlencoded):
    - `email`: (required) email@example.com
    - `password`: (required) userpassword

---

## Modul: Surat Masuk
**Base URL**: `/surat-masuk`

### 1. List All (Index)
- **URL**: `/surat-masuk`
- **Method**: `GET`
- **Access**: User & Admin

### 2. Create New (Store)
- **URL**: `/surat-masuk`
- **Method**: `POST`
- **Access**: **User & Admin** (Status will be `pending` for User)
- **Body** (x-www-form-urlencoded / form-data):
    | Key | Type | Requirement | Description |
    |-----|------|-------------|-------------|
    | `nomor_agenda` | String | Optional | - |
    | `nomor_surat_asal` | String | **Required** | - |
    | `tanggal_surat` | Date | **Required** | Format: YYYY-MM-DD |
    | `tanggal_diterima` | Date | **Required** | Format: YYYY-MM-DD |
    | `asal_surat` | String | **Required** | - |
    | `perihal` | String | **Required** | - |
    | `isi_ringkas` | String | Optional | - |
    | `kategori_id` | Integer | **Required** | Must exist in `kategori_surats` |

### 3. Detail (Show)
- **URL**: `/surat-masuk/{id}`
- **Method**: `GET`
- **Access**: User & Admin

### 4. Update
- **URL**: `/surat-masuk/{id}`
- **Method**: `PUT` / `PATCH`
- **Access**: **Admin Only**
- **Body**: (Same as Create)

### 5. Delete
- **URL**: `/surat-masuk/{id}`
- **Method**: `DELETE`
- **Access**: **Admin Only**

### 6. Approve (Admin Only)
- **URL**: `/surat-masuk/{id}/approve`
- **Method**: `POST`
- **Access**: **Admin Only**
- **Response**: Redirect back with success message. Status becomes `approved`.

### 7. Reject (Admin Only)
- **URL**: `/surat-masuk/{id}/reject`
- **Method**: `POST`
- **Access**: **Admin Only**
- **Response**: Redirect back with success message. Status becomes `rejected`.

---

## Modul: Surat Keluar
**Base URL**: `/surat-keluar`

### 1. List All (Index)
- **URL**: `/surat-keluar`
- **Method**: `GET`
- **Access**: User & Admin

### 2. Create New (Store)
- **URL**: `/surat-keluar`
- **Method**: `POST`
- **Access**: **Admin Only**
- **Body** (x-www-form-urlencoded / form-data):
    | Key | Type | Requirement | Description |
    |-----|------|-------------|-------------|
    | `nomor_agenda` | String | Optional | - |
    | `nomor_surat` | String | **Required** | - |
    | `tanggal_surat` | Date | **Required** | Format: YYYY-MM-DD |
    | `tujuan_surat` | String | **Required** | - |
    | `perihal` | String | **Required** | - |
    | `isi_ringkas` | String | Optional | - |
    | `kategori_id` | Integer | **Required** | Must exist in `kategori_surats` |

### 3. Detail (Show)
- **URL**: `/surat-keluar/{id}`
- **Method**: `GET`
- **Access**: User & Admin

### 4. Update
- **URL**: `/surat-keluar/{id}`
- **Method**: `PUT` / `PATCH`
- **Access**: **Admin Only**
- **Body**: (Same as Create)

### 5. Delete
- **URL**: `/surat-keluar/{id}`
- **Method**: `DELETE`
- **Access**: **Admin Only**

### 6. Approve (Admin Only)
- **URL**: `/surat-keluar/{id}/approve`
- **Method**: `POST`
- **Access**: **Admin Only**
- **Response**: Redirect back with success message. Status becomes `approved`.

### 7. Reject (Admin Only)
- **URL**: `/surat-keluar/{id}/reject`
- **Method**: `POST`
- **Access**: **Admin Only**
- **Response**: Redirect back with success message. Status becomes `rejected`.

---

## Modul: Agenda Kegiatan
**Base URL**: `/agenda`

### 1. List All (Index)
- **URL**: `/agenda`
- **Method**: `GET`
- **Access**: User & Admin

### 2. Create New (Store)
- **URL**: `/agenda`
- **Method**: `POST`
- **Access**: **Admin Only**
- **Body** (x-www-form-urlencoded / form-data):
    | Key | Type | Requirement | Description |
    |-----|------|-------------|-------------|
    | `nama_kegiatan` | String | **Required** | - |
    | `waktu_mulai` | DateTime| **Required** | YYYY-MM-DD HH:mm:ss |
    | `waktu_selesai` | DateTime| Optional | Must be after `waktu_mulai` |
    | `tempat` | String | Optional | - |
    | `keterangan` | String | Optional | - |
    | `jenis_agenda_id` | Integer | **Required** | Must exist in `jenis_agendas` |

### 3. Detail (Show)
- **URL**: `/agenda/{id}`
- **Method**: `GET`
- **Access**: User & Admin

### 4. Update
- **URL**: `/agenda/{id}`
- **Method**: `PUT` / `PATCH`
- **Access**: **Admin Only**
- **Body**: (Same as Create)

### 5. Delete
- **URL**: `/agenda/{id}`
- **Method**: `DELETE`
- **Access**: **Admin Only**

### 6. Approve (Admin Only)
- **URL**: `/agenda/{id}/approve`
- **Method**: `POST`
- **Access**: **Admin Only**
- **Response**: Redirect back with success message. Status becomes `approved`.

### 7. Reject (Admin Only)
- **URL**: `/agenda/{id}/reject`
- **Method**: `POST`
- **Access**: **Admin Only**
- **Response**: Redirect back with success message. Status becomes `rejected`.
