<div align="center">
   <img src="https://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg" width="100" alt="PHP Logo">
   <img src="https://www.svgrepo.com/show/353579/codeigniter.svg" width="100" alt="CodeIgniter 4 Logo">
 </div>

 
 ## 👤 Profil Mahasiswa
 
 | Atribut         | Keterangan            |
 | --------------- | --------------------- |
 | **Nama**        | Faiz Maulana          |
 | **NIM**         | 312310469             |
 | **Kelas**       | TI.23.A.5             |
 | **Mata Kuliah** | Pemrograman Website 2 |
 

| No  | Praktikum                                            | Link                                                                 |
| --- | ---------------------------------------------------- | -------------------------------------------------------------------- |
| 1-7   | Praktikum 1-3 & 7                                    | [KLIK DISNI](https://github.com/PaisMaulanaaa/Lab7web)                                    |
| 4-6  | Praktikum 4-6 | [KLIK DISNI](https://github.com/PaisMaulanaaa/Lab11web) |



| No  | Praktikum                                            | Link                                                                 |
| --- | ---------------------------------------------------- | -------------------------------------------------------------------- |
| 8   | Praktikum 8: AJAX                                    | [KLIK DISINI](#praktikum-8-ajax)                                    |
| 9   | Praktikum 9: Implementasi AJAX Pagination dan Search | [KLIK DISINI](#praktikum-9-implementasi-ajax-pagination-dan-search) |
| 10  | Praktikum 10: REST API                               | [KLIK DISINI](#praktikum-10-rest-api)                               |
| 11  | Praktikum 11: VueJS - Frontend API                   | [KLIK DISINI](#praktikum-11-vuejs---frontend-api)                   |


 # Praktikum 8: AJAX

## Deskripsi

Pada praktikum ini, kita akan mendalami penggunaan teknologi AJAX untuk menciptakan pengalaman pengguna yang lebih dinamis pada aplikasi web CodeIgniter 4. Fokus utamanya adalah memperbarui bagian-bagian tertentu dari halaman tanpa harus melakukan refresh halaman secara penuh.

## Tujuan Praktikum

1.  Menguasai konsep fundamental dan alur kerja AJAX.
2.  Terampil dalam mengintegrasikan AJAX ke dalam proyek CodeIgniter 4.
3.  Meningkatkan keahlian dalam menganalisis dan memperbaiki masalah (problem solving & debugging).

## Langkah-langkah Praktikum

### 1. Persiapan

- Memastikan jQuery telah diunduh dan ditempatkan di direktori `public/assets/js`.

### 2. Membuat Controller

- Membuat `AjaxController` yang berisi method `index`, `getData`, `store`, dan `update`.

**Kode AjaxController.php:**

```php
<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\Response;
use App\Models\ArtikelModel;

class AjaxController extends Controller
{
    public function index()
    {
        return view('ajax/index');
    }

    public function getData()
    {
        $model = new ArtikelModel();
        $data = $model->findAll();

        // Kirim data dalam format JSON
        return $this->response->setJSON($data);
    }

    public function store()
    {
        // Proses penyimpanan data (dapat diganti dengan logika penyimpanan ke database)
        $data = [
            'status' => 'Data berhasil disimpan'
        ];
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        // Proses update data (dapat diganti dengan logika update di database)
        $data = [
            'status' => 'Data berhasil diupdate'
        ];
        return $this->response->setJSON($data);
    }
}
```

**Screenshot:**
![alt text](<gambar/image.png>)

### 3. Membuat View

- Membuat view `ajax/index.php` untuk menampilkan data artikel dalam tabel dan menggunakan AJAX untuk pengambilan data.

**Kode index.php:**

```php
<?= $this->include('template/header'); ?>

<h1>Data Artikel</h1>

<table class="table-data" id="artikelTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        function showLoadingMessage() {
            $('#artikelTable tbody').html('<tr><td colspan="4">Memuat data...</td></tr>');
        }

        function loadData() {
            showLoadingMessage();

            $.ajax({
                url: "<?= base_url('ajax/getData') ?>",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    var tableBody = "";
                    for (var i = 0; i < data.length; i++) {
                        var row = data[i];
                        tableBody += '<tr>';
                        tableBody += '<td>' + row.id + '</td>';
                        tableBody += '<td>' + row.judul + '</td>';
                        tableBody += '<td><span class="status">---</span></td>';
                        tableBody += '<td>';
                        tableBody += '<a href="<?= base_url('artikel/edit/') ?>' + row.id + '" class="btn btn-primary">Edit</a>';
                        tableBody += ' <a href="#" class="btn btn-danger btn-delete" data-id="' + row.id + '">Delete</a>';
                        tableBody += '</td>';
                        tableBody += '</tr>';
                    }
                    $('#artikelTable tbody').html(tableBody);
                }
            });
        }

        loadData();

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            
            if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
                $.ajax({
                    url: "<?= base_url('artikel/delete/') ?>" + id,
                    method: "DELETE",
                    success: function(data) {
                        loadData();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error saat menghapus artikel: ' + textStatus + errorThrown);
                    }
                });
            }
        });
    });
</script>

<?= $this->include('template/footer'); ?>
```

**Screenshot:**
![alt text](<gambar/image-1.png>)

### 4. Menambahkan Route

- Menambahkan route untuk mengakses method yang ada di `AjaxController`.

**Kode Routes.php:**

```php
// Route untuk AjaxController
$routes->get('/ajax', 'AjaxController::index');
$routes->get('/ajax/getData', 'AjaxController::getData');
$routes->get('/ajax/delete/(:num)', 'AjaxController::delete/$1');
$routes->post('/ajax/store', 'AjaxController::store');
$routes->post('/ajax/update/(:num)', 'AjaxController::update/$1');
```

**Screenshot:**
![alt text](<gambar/image-2.png>)

## Konsep yang Dipelajari

- AJAX (Asynchronous JavaScript and XML)
- Penggunaan jQuery untuk menyederhanakan implementasi AJAX
- Pengiriman dan penerimaan data dengan format JSON
- Pembuatan controller dan view untuk menangani request AJAX

## Struktur File

```
app/
├── Controllers/
│   └── AjaxController.php
└── Views/
    └── ajax/
        └── index.php
```

# Praktikum 9: Implementasi AJAX Pagination dan Search

## Deskripsi

Melanjutkan dari praktikum sebelumnya, sesi ini akan fokus pada penerapan AJAX untuk fungsionalitas yang lebih kompleks, yaitu pagination dan pencarian data. Tujuannya adalah menciptakan antarmuka admin yang responsif dan efisien, di mana navigasi dan filter data dapat dilakukan secara instan.

## Tujuan Praktikum

1. Memahami penerapan AJAX untuk kasus pagination dan pencarian.
2. Mampu membangun fitur pagination dan pencarian yang didukung AJAX dalam CodeIgniter 4.
3. Meningkatkan kualitas interaksi pengguna (UX) dan kecepatan aplikasi.

## Langkah-langkah Praktikum

### 1. Persiapan

- ✅ MySQL Server aktif.
- ✅ Database `lab_ci4` tersedia.
- ✅ Tabel `artikel` dan `kategori` sudah ada dan berisi data.
- ✅ Library jQuery terpasang melalui CDN.

### 2. Modifikasi Controller Artikel

Mengubah method `admin_index()` di `Artikel.php` agar dapat mengembalikan data dalam format JSON jika request yang masuk adalah AJAX.

**Kode Controller yang dimodifikasi:**

```php
public function admin_index()
{
    $title = 'Daftar Artikel (Admin)';
    $model = new ArtikelModel();
    $q = $this->request->getVar('q') ?? '';
    $kategori_id = $this->request->getVar('kategori_id') ?? '';
    $page = $this->request->getVar('page') ?? 1;

    $builder = $model->table('artikel')
        ->select('artikel.*, kategori.nama_kategori')
        ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

    if ($q != '') {
        $builder->like('artikel.judul', $q);
    }
    if ($kategori_id != '') {
        $builder->where('artikel.id_kategori', $kategori_id);
    }

    $artikel = $builder->paginate(10, 'default', $page);
    $pager = $model->pager;

    $data = [
        'title' => $title,
        'q' => $q,
        'kategori_id' => $kategori_id,
        'artikel' => $artikel,
        'pager' => $pager
    ];

    if ($this->request->isAJAX()) {
        return $this->response->setJSON($data);
    } else {
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();
        return view('artikel/admin_index', 'data');
    }
}
```



### 3. Modifikasi View (admin_index.php)

Mengubah view `admin_index.php` untuk menggunakan jQuery AJAX. Kode yang menampilkan tabel dan pagination secara langsung dihapus dan digantikan dengan container untuk data dari AJAX.

**Kode View yang dimodifikasi:**

```php
<?= $this->include('template/admin_header'); ?>
<h2><?= $title; ?></h2>
<div class="row mb-3">
    <div class="col-md-6">
        <form id="search-form" class="form-inline">
            <input type="text" name="q" id="search-box" value="<?= $q; ?>" placeholder="Cari judul artikel" class="form-control mr-2">
            <select name="kategori_id" id="category-filter" class="form-control mr-2">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori']; ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>><?= $k['nama_kategori']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Cari" class="btn btn-primary">
        </form>
    </div>
</div>
<div id="article-container">
</div>
<div id="pagination-container">
</div>
```

**Implementasi jQuery AJAX:**

```javascript
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const articleContainer = $('#article-container');
    const paginationContainer = $('#pagination-container');
    const searchForm = $('#search-form');
    const searchBox = $('#search-box');
    const categoryFilter = $('#category-filter');

    const fetchData = (url) => {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(data) {
                renderArticles(data.artikel);
                if (data.pager && data.pager.links) {
                    renderPagination(data.pager, data.q, data.kategori_id);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                articleContainer.html('<div class="alert alert-danger">Gagal memuat data: ' + error + '</div>');
            }
        });
    };

    const renderArticles = (articles) => {
        let html = '<table class="table">';
        html += '<thead><tr><th>ID</th><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Aksi</th></tr></thead><tbody>';

        if (articles && articles.length > 0) {
            articles.forEach(article => {
                const isi = article.isi || '';
                const isiPreview = isi.length > 50 ? isi.substring(0, 50) + '...' : isi;
                html += `
            <tr>
                <td>${article.id}</td>
                <td>
                    <b>${article.judul}</b>
                    <p><small>${isiPreview}</small></p>
                </td>
                <td>${article.nama_kategori || 'Tidak ada kategori'}</td>
                <td>${article.tanggal || '-'}</td>
                <td>
                    <a class="btn btn-sm btn-info" href="<?= base_url(); ?>/admin/artikel/edit/${article.id}">Ubah</a>
                    <a class="btn btn-sm btn-danger" onclick="return confirm('Yakin menghapus data?');" href="<?= base_url(); ?>/admin/artikel/delete/${article.id}">Hapus</a>
                </td>
            </tr>
            `;
            });
        } else {
            html += '<tr><td colspan="5">Data tidak ditemukan.</td></tr>';
        }
        html += '</tbody></table>';
        articleContainer.html(html);
    };

    const renderPagination = (pager, q, kategori_id) => {
        let html = '<nav><ul class="pagination">';
        pager.links.forEach(link => {
            let url = link.url ? `${link.url}&q=${q}&kategori_id=${kategori_id}` : '#';
            html += `<li class="page-item ${link.active ? 'active' : ''}"><a class="page-link" href="${url}" data-url="${url}">${link.title}</a></li>`;
        });
        html += '</ul></nav>';
        paginationContainer.html(html);

        paginationContainer.find('.page-link').on('click', function(e) {
            e.preventDefault();
            const url = $(this).data('url');
            if (url && url !== '#') {
                fetchData(url);
            }
        });
    };

    searchForm.on('submit', function(e) {
        e.preventDefault();
        const q = searchBox.val();
        const kategori_id = categoryFilter.val();
        fetchData(`<?= base_url(); ?>/admin/artikel?q=${q}&kategori_id=${kategori_id}`);
    });

    categoryFilter.on('change', function() {
        searchForm.trigger('submit');
    });

    fetchData('<?= base_url(); ?>/admin/artikel');
});
</script>
<?= $this->include('template/admin_footer'); ?>
```


## Fitur yang Berhasil Diimplementasikan

- **AJAX Loading**: Data artikel dimuat secara asinkron.
- **Live Search**: Pencarian artikel secara real-time.
- **Filter Kategori**: Filter artikel berdasarkan kategori.
- **Pagination dengan AJAX**: Navigasi halaman tanpa reload.
- **Error Handling**: Menampilkan pesan jika terjadi error.

# Praktikum 10: REST API

## Deskripsi

Praktikum ini akan memperkenalkan Anda pada dunia API (Application Programming Interface) dengan arsitektur RESTful. Kita akan membangun sebuah backend service menggunakan CodeIgniter 4 yang dapat menyediakan data dalam format JSON untuk dikonsumsi oleh aplikasi lain.

## Tujuan Praktikum

1. Memahami peran dan fungsi sebuah API.
2. Mengerti prinsip-prinsip desain arsitektur RESTful.
3. Berhasil membangun REST API fungsional menggunakan CodeIgniter 4.

## Langkah-langkah Praktikum

### 1. Persiapan

- ✅ Text editor (VSCode) siap digunakan.
- ✅ Proyek `lab7_php_ci` terbuka.
- ✅ Postman terinstal untuk pengujian API.
- ✅ `ArtikelModel` sudah tersedia.

### 2. Membuat REST Controller

Membuat file `Post.php` sebagai REST Controller yang berisi fungsi untuk operasi CRUD (Create, Read, Update, Delete).

**File: `app/Controllers/Post.php`**

```php
<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }

    public function create()
    {
        $model = new ArtikelModel();
        $data = [
            'judul' => $this->request->getVar('judul'),
            'isi' => $this->request->getVar('isi'),
        ];
        $model->insert($data);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => ['success' => 'Data artikel berhasil ditambahkan.']
        ];
        return $this->respondCreated($response);
    }

    public function show($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }

    public function update($id = null)
    {
        $model = new ArtikelModel();
        $data = [
            'judul' => $this->request->getVar('judul'),
            'isi' => $this->request->getVar('isi'),
        ];
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => ['success' => 'Data artikel berhasil diubah.']
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => ['success' => 'Data artikel berhasil dihapus.']
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
}
```


### 3. Membuat Routing REST API

Mendefinisikan route untuk REST API di `app/Config/Routes.php`.

```php
// REST API routes
$routes->resource('post');
```
**Testing Route dengan Command:**

```bash
php spark routes
```

**Hasil Route yang Terbentuk:**

```
+--------+-------------------------------+------+--------------------------------------------+
| Method | Route                         | Name | Handler                                    |
+--------+-------------------------------+------+--------------------------------------------+
| GET    | post                          | »    | \App\Controllers\Post::index               |
| GET    | post/new                      | »    | \App\Controllers\Post::new                 |
| GET    | post/(.*)/edit                | »    | \App\Controllers\Post::edit/$1             |
| GET    | post/(.*)                     | »    | \App\Controllers\Post::show/$1             |
| POST   | post                          | »    | \App\Controllers\Post::create              |
| PATCH  | post/(.*)                     | »    | \App\Controllers\Post::update/$1           |
| PUT    | post/(.*)                     | »    | \App\Controllers\Post::update/$1           |
| DELETE | post/(.*)                     | »    | \App\Controllers\Post::delete/$1           |
+--------+-------------------------------+------+--------------------------------------------+
```

### 4. Testing REST API dengan Postman

Pengujian dilakukan untuk setiap endpoint (GET, POST, PUT, DELETE) menggunakan Postman untuk memastikan semua fungsi berjalan dengan baik.

**Screenshots:**
![alt text](<gambar/image-3.png>)
![alt text](<gambar/image-4.png>)
![alt text](<gambar/image-5.png>)
![alt text](<gambar/image-6.png>)
![alt text](<gambar/image-7.png>)

## Fitur REST API yang Berhasil Diimplementasikan

- **CRUD Operations**: Create, Read, Update, Delete.
- **HTTP Methods**: GET, POST, PUT, DELETE.
- **Response Format**: JSON dengan status code yang sesuai.
- **Error Handling**: Pesan error yang informatif.
- **Prinsip RESTful**: URL berbasis resource, penggunaan method HTTP yang tepat.

## Kesimpulan

Praktikum 10 berhasil mengimplementasikan REST API menggunakan CodeIgniter 4 dengan fitur lengkap CRUD operations. Implementasi ini memungkinkan:

1. **Integrasi Mudah**: API dapat diakses dari berbagai platform dan bahasa pemrograman
2. **Standar RESTful**: Mengikuti prinsip-prinsip REST API yang standar
3. **Format JSON**: Data exchange menggunakan format JSON yang universal
4. **Error Handling**: Penanganan error yang baik dengan status code yang sesuai
5. **Scalable**: Mudah dikembangkan untuk menambah endpoint baru

**Teknologi yang digunakan:**

- **CodeIgniter 4**: Framework PHP untuk backend API
- **ResourceController**: Base controller untuk REST API
- **ResponseTrait**: Trait untuk response handling
- **ArtikelModel**: Model untuk database operations
- **Postman**: Tool untuk testing REST API

**Screenshot Testing Lengkap:**
![alt text](<gambar/image-8.png>)

## Perbaikan dan Optimasi

### 1. Fix PUT Method Error 500

**Masalah:** Konflik parameter `$id` di method `update()`
**Solusi:** Menghapus `$id = $this->request->getVar('id');` karena ID sudah diambil dari URL parameter

### 2. Fix Artikel Detail Redirect

**Masalah:** Artikel yang ditambah via API tidak bisa dibuka detail karena tidak ada slug
**Solusi:** Menambahkan auto-generate slug dan tanggal di method `create()` dan `update()`

```php
// Perbaikan di method create() dan update()
$judul = $this->request->getVar('judul');
$data = [
    'judul' => $judul,
    'isi' => $this->request->getVar('isi'),
    'slug' => url_title($judul, '-', true),  // Auto-generate slug
    'tanggal' => date('Y-m-d H:i:s')         // Auto-generate timestamp
];
```

### 3. Cara Testing PUT yang Benar

- **Method:** PUT
- **URL:** `http://localhost:8080/post/2`
- **Body:** x-www-form-urlencoded
- **Parameters:** Hanya `judul` dan `isi` (ID diambil dari URL)

Sekarang semua endpoint REST API sudah berfungsi dengan baik! 🚀


# Praktikum 11: VueJS - Frontend API

## Deskripsi

Pada praktikum terakhir ini, kita akan melengkapi aplikasi kita dengan membangun antarmuka pengguna (frontend) yang modern menggunakan framework JavaScript, VueJS. Frontend ini akan berinteraksi dengan REST API yang telah kita buat, menciptakan sebuah aplikasi Single Page Application (SPA) yang utuh.

## Tujuan Praktikum

1. Mengenal konsep-konsep inti dari framework VueJS.
2. Mampu membangun aplikasi frontend yang dapat melakukan operasi CRUD dengan mengonsumsi REST API.

## Langkah-langkah Praktikum

### 1. Persiapan

Menggunakan VueJS dan Axios melalui CDN.

- **VueJS 3**: `<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>`
- **Axios**: `<script src="https://unpkg.com/axios/dist/axios.min.js"></script>`

### 2. Struktur Direktori

Membuat proyek baru dengan struktur file sebagai berikut:

```
lab8_vuejs/
│   index.html
└───assets/
    ├───css/
    │   style.css
    └───js/
        app.js
```

### 3. Membuat File HTML (`index.html`)

Membuat struktur dasar HTML yang akan menjadi tempat aplikasi VueJS di-mount.

**Screenshot:**
![alt text](<gambar/image-9.png>)

### 4. Membuat File JavaScript (`app.js`)

Menulis logika aplikasi VueJS, termasuk data, methods untuk operasi CRUD, dan lifecycle hooks.

**Screenshot:**
![alt text](<gambar/image-10.png>)

### 5. Membuat File CSS (`style.css`)

Menambahkan styling untuk mempercantik tampilan aplikasi.

**Screenshot:**
![alt text](<gambar/image-11.png>)

### 6. Testing Aplikasi VueJS

Melakukan pengujian untuk semua fitur CRUD: menampilkan, menambah, mengedit, dan menghapus data artikel melalui antarmuka VueJS.

**Screenshots:**
![alt text](<gambar/image-12.png>)
![alt text](<gambar/image-13.png>)
![alt text](<gambar/image-14.png>)
![alt text](<gambar/image-15.png>)

## Fitur yang Berhasil Diimplementasikan

- **CRUD Operations dengan VueJS**: Create, Read, Update, Delete.
- **Reactive Data Binding**: Two-way data binding dan konten dinamis.
- **Event Handling**: @click, @submit.prevent.
- **Integrasi API**: Menggunakan Axios untuk komunikasi dengan backend.
- **User Interface**: Desain responsif dengan modal dialog.

## Konsep VueJS yang Dipelajari

- **Vue Instance & Mounting**: `createApp().mount()`
- **Data Properties**: `data()`
- **Methods**: `methods: {}`
- **Lifecycle Hooks**: `mounted()`
- **Template Directives**: `v-for`, `v-if`, `v-model`, `@click`

## Improvisasi dan Pengembangan Lanjutan

### 1. Peningkatan UI/UX Halaman VueJS

- **Desain Modern**: Menggunakan Bootstrap 5 untuk tampilan yang lebih modern.
- **Layout Card**: Mengubah tampilan tabel menjadi layout card.
- **Icons**: Menambahkan Font Awesome untuk ikon.

### 2. Halaman Home untuk Artikel Berita

- **Landing Page**: Membuat halaman home yang menarik untuk menampilkan artikel.
- **Fitur**: Hero section, grid artikel, filter, dan pencarian.

**Screenshot Improvisasi UI:**
![alt text](<gambar/image-16.png>)

**Screenshot Halaman Home:**
![alt text](<gambar/image-17.png>)
![alt text](<gambar/image-18.png>)


# 🎯 Kesimpulan Keseluruhan Praktikum 7-11

Serangkaian praktikum ini secara komprehensif telah memandu proses pembuatan aplikasi web full-stack dari awal hingga akhir dengan memanfaatkan teknologi modern.

## 📋 Ringkasan Praktikum

- **Praktikum 8**: Implementasi AJAX.
- **Praktikum 9**: AJAX untuk Pagination dan Search.
- **Praktikum 10**: Pembuatan REST API.
- **Praktikum 11**: Frontend dengan VueJS.

## 🚀 Teknologi yang Dikuasai

| **Backend**   | **Frontend**      | **Database**        | **Tools** |
| ------------- | ----------------- | ------------------- | --------- |
| CodeIgniter 4 | VueJS 3           | MySQL               | Postman   |
| REST API      | Bootstrap 5       | Query Builder       | Git       |
| AJAX          | JavaScript ES6+   | Relasi Database     | VS Code   |
| PHP 8+        | Axios             | Migrasi & Seeding   | XAMPP     |

## 🎨 Fitur Unggulan

- **Backend**: Relasi database, REST API, pencarian canggih, pagination AJAX.
- **Frontend**: UI reaktif, desain responsif, live search, form modal.

## 📈 Pembelajaran dan Pencapaian

- **Keterampilan Teknis**: Pengembangan full-stack, pembuatan API, JavaScript modern, desain database, desain responsif.
- **Keterampilan Non-Teknis**: Pemecahan masalah, dokumentasi, organisasi kode, pengujian.

## 🌟 Hasil Akhir

Aplikasi web yang dihasilkan adalah sistem manajemen artikel yang lengkap dengan:
- ✅ **Panel Admin**: Untuk mengelola konten.
- ✅ **Antarmuka Publik**: Untuk membaca artikel.
- ✅ **REST API**: Layanan backend yang dapat digunakan oleh berbagai klien.
- ✅ **Frontend Modern**: Antarmuka yang responsif dan interaktif.

---

Melalui praktikum 8 hingga 11, telah diperoleh pemahaman yang solid mengenai pengembangan aplikasi web modern. Sinergi antara **CodeIgniter 4** sebagai backend dan **VueJS 3** sebagai frontend terbukti mampu menghasilkan aplikasi yang andal, mudah dikembangkan, dan memiliki antarmuka yang intuitif.


## SEKIAN TERIMA KASIH
