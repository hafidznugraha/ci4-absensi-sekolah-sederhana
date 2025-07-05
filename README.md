<h1 align="center">
  <br>
  <img src="https://raw.githubusercontent.com/codeigniter4/CodeIgniter4/develop/user_guide_src/source/_static/ci-logo.png" alt="CodeIgniter 4" width="120">
  <br>
  Sistem Absensi Sekolah
  <br>
</h1>

<h4 align="center">Aplikasi Web Absensi Siswa berbasis CodeIgniter 4, dibuat untuk latihan pengembangan sistem informasi sekolah.</h4>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/CodeIgniter4-%23EE4623.svg?style=flat&logo=codeigniter&logoColor=white" alt="CI4 Badge" /></a>
  <a href="https://github.com/hafidznugraha/web-absensi"><img src="https://img.shields.io/github/stars/hafidznugraha/web-absensi?style=social" alt="Star"></a>
  <a href="mailto:nugrahahafidz02@gmail.com"><img src="https://img.shields.io/badge/email-kontak-green.svg" alt="Email"></a>
  <a href="https://www.linkedin.com/in/hafidz-nugraha-sisfo-unjani"><img src="https://img.shields.io/badge/LinkedIn-Hubungi-blue.svg" alt="LinkedIn"></a>
</p>

<p align="center">
  <a href="#fitur-utama">Fitur Utama</a> •
  <a href="#cara-menjalankan">Cara Menjalankan</a> •
  <a href="#teknologi">Teknologi</a> •
  <a href="#kontribusi">Kontribusi</a> •
  <a href="#lisensi">Lisensi</a>
</p>

---

## 📸 Screenshot

![screenshot](https://raw.githubusercontent.com/hafidznugraha/web-absensi/main/public/screenshots/dashboard_admin.png)

---

## ✨ Fitur Utama

- Login multi-role: Admin, Guru, dan Siswa
- Siswa dapat mengisi absensi dengan keterangan dan bukti
- Guru dapat melihat dan memverifikasi absensi siswa
- Admin mengelola data siswa, guru, jadwal, dan akun
- UI sederhana berbasis Bootstrap
- Konfirmasi & notifikasi menggunakan modal
- Sistem dirancang dengan pendekatan MVC (Model–View–Controller)

---

## 🛠️ Cara Menjalankan

### Persiapan:
1. Pastikan sudah menginstall:
   - PHP 8.x
   - Composer
   - XAMPP / MySQL / MariaDB
2. Clone repository ini:
   ```bash
   git clone https://github.com/hafidznugraha/web-absensi.git
   cd web-absensi
3. Jalankan composer:
   composer install
4. Duplikat .env.example menjadi .env, lalu atur database sesuai config lokal kamu:
   database.default.hostname = localhost
   database.default.database = absensi
   database.default.username = root
   database.default.password =
5. Buat database absensi, lalu import file .sql jika tersedia
6. Jalankan server lokal:
   php spark serve
7. Buka di browser:
8. http://localhost:8080

## ⚙️ Teknologi

| Bahasa / Framework | Keterangan                       |
| ------------------ | -------------------------------- |
| PHP                | Bahasa backend utama             |
| CodeIgniter 4      | Framework utama                  |
| MySQL              | Database                         |
| Bootstrap 5        | UI Framework                     |
| JavaScript/jQuery  | Interaktifitas                   |
| VS Code            | Code editor                      |
| Git & GitHub       | Version control                  |
| Kali Linux         | OS alternatif untuk pengembangan |

## 🤝 Kontribusi
Proyek ini dibuat secara mandiri untuk pengembangan skill backend dan CI4.
Jika kamu tertarik untuk mempelajari atau memberikan feedback, silakan fork dan open issue ✨

## 📄 Lisensi
Proyek ini menggunakan lisensi MIT — bebas digunakan, dipelajari, dan dimodifikasi.

Dibuat dengan ❤️ oleh Hafidz Nugraha

---

## 🔧 Langkah Selanjutnya:
- Simpan file ini dengan nama `README.md` di root folder proyek kamu
- Lalu commit & push:

```bash
git add README.md
git commit -m "Tambah README dengan format profesional"
git push origin main
