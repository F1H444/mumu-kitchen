# 📧 Cara Setup Email Invoice dengan Gmail

## 🔑 Step 1: Dapatkan App Password Gmail

### A. Login ke Google Account

1. Buka https://myaccount.google.com/
2. Login dengan email: **mumuuu112233@gmail.com**

### B. Aktifkan 2-Step Verification (Wajib!)

1. Di halaman Google Account, klik **"Security"** di sidebar kiri
2. Scroll ke bawah cari **"2-Step Verification"**
3. Klik **"Get Started"** atau **"Turn On"**
4. Ikuti petunjuk untuk mengaktifkan verifikasi 2 langkah (biasanya pakai SMS atau Google Authenticator)

### C. Buat App Password

1. Setelah 2-Step Verification aktif, balik ke halaman **"Security"**
2. Scroll ke bawah, cari bagian **"How you sign in to Google"**
3. Klik **"App passwords"** atau **"2-Step Verification"** → lalu cari link **"App passwords"**

    **Link langsung:** https://myaccount.google.com/apppasswords

4. Google akan minta password untuk konfirmasi
5. Di halaman App passwords:
    - **Select app:** Pilih "Mail" atau "Other (Custom name)"
    - **Type name:** Ketik "Mumu Kitchen"
    - Klik **"Generate"**
6. Google akan generate **16-digit password** seperti: `abcd efgh ijkl mnop`
7. **COPY password ini!** (hapus spasinya jadi: `abcdefghijklmnop`)

### D. Update File .env

Buka file `.env` di root project, update line ini:

```env
MAIL_PASSWORD=abcdefghijklmnop
```

Ganti `abcdefghijklmnop` dengan App Password yang tadi dicopy.

---

## ✅ Step 2: Restart Server Laravel

Setelah update `.env`, **wajib restart** server Laravel:

### Di Terminal yang menjalankan `php artisan serve`:

1. Tekan `Ctrl + C` untuk stop server
2. Jalankan lagi: `php artisan serve`

Atau restart semua:

```bash
# Stop semua terminal
# Lalu jalankan lagi:
npm run dev
php artisan serve
```

---

## 🧪 Step 3: Test Kirim Email

### Test Manual via Tinker:

```bash
php artisan tinker
```

Lalu jalankan:

```php
Mail::raw('Test email dari Mumu Kitchen', function($message) {
    $message->to('mumuuu112233@gmail.com')
            ->subject('Test Email');
});
```

Jika berhasil, akan muncul: `= true`

Cek inbox email `mumuuu112233@gmail.com`, harusnya ada email masuk!

### Test via Pembayaran:

1. Login ke website sebagai customer
2. Buat pesanan dan bayar
3. Setelah pembayaran sukses, cek email `mumuuu112233@gmail.com`
4. Harusnya ada email invoice masuk! 📧

---

## 🎨 Template Email yang Sudah Dibuat

Template email invoice sudah saya buat di:

```
resources/views/emails/invoice.blade.php
```

Template ini sudah include:
✅ Logo/Header Mumu Kitchen
✅ No. Invoice & Pemesanan
✅ List produk yang dibeli
✅ Info pengiriman lengkap
✅ Total pembayaran
✅ Status LUNAS
✅ Design modern & responsive
✅ Warna brand (#1c2e26 & #d97706)

---

## 🖼️ Tentang Gambar di Email

Di template email, bagian header menggunakan:

- **Emoji 🍽️** sebagai icon
- **Teks "MUMU KITCHEN"** dengan styling
- Tidak menggunakan gambar eksternal (agar email tidak diblock)

Jika Anda ingin **menambahkan logo gambar**, edit file:
`resources/views/emails/invoice.blade.php`

Ganti baris ini:

```html
<h1>🍽️ MUMU KITCHEN</h1>
```

Dengan:

```html
<img
    src="https://your-domain.com/logo.png"
    alt="Mumu Kitchen"
    style="max-width: 200px;"
/>
<h1>MUMU KITCHEN</h1>
```

**Tapi untuk email, lebih baik pakai emoji/text** karena:

- Lebih cepat load
- Tidak diblock email provider
- Lebih reliable

---

## ❗ Troubleshooting

### Email tidak terkirim?

1. **Cek log error:**

    ```bash
    tail -f storage/logs/laravel.log
    ```

2. **Pastikan .env sudah benar:**
    - MAIL_USERNAME = email Gmail lengkap
    - MAIL_PASSWORD = App Password (16 digit tanpa spasi)
    - MAIL_FROM_ADDRESS = sama dengan MAIL_USERNAME

3. **Restart server Laravel** setelah ubah .env

4. **Cek Gmail:**
    - 2-Step Verification sudah aktif?
    - App Password sudah dibuat?
    - Email tidak di spam folder?

5. **Cek firewall/antivirus:**
    - Kadang block port 587
    - Coba disable sementara untuk testing

### Error "Authentication failed"?

- App Password salah
- Copy paste ulang, pastikan tidak ada spasi
- Pastikan 2-Step Verification aktif

### Email masuk ke Spam?

- Normal untuk awal-awal
- Mark as "Not Spam" beberapa kali
- Setelah beberapa email, Gmail akan belajar

---

## 📊 Summary Setup

1. ✅ Aktifkan 2-Step Verification di Google
2. ✅ Buat App Password
3. ✅ Update MAIL_PASSWORD di .env
4. ✅ Restart server Laravel
5. ✅ Test kirim email via tinker
6. ✅ Test pembayaran untuk dapat invoice otomatis

---

**Setelah setup selesai, setiap kali ada pembayaran sukses:**

- ✅ Status otomatis jadi "Selesai"
- ✅ Email invoice otomatis terkirim ke customer
- ✅ Customer dapat konfirmasi pembayaran via email

**Mudah kan? 😊**
