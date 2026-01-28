# 🖼️ Tentang Gambar di Email Invoice

## 📧 Template Email Sudah Dibuat!

File: `resources/views/emails/invoice.blade.php`

---

## 🎨 Opsi untuk Logo/Icon di Email

### ✅ OPSI 1: Menggunakan Emoji (RECOMMENDED - Sudah Dipasang!)

**Kelebihan:**

- ✅ Tidak perlu upload gambar
- ✅ Langsung tampil di semua email client
- ✅ Tidak diblok oleh email provider
- ✅ Loading cepat
- ✅ Tidak ada broken image

**Yang sudah terpasang:**

```html
<h1 style="font-size: 48px;">🍽️</h1>
<h1 style="color: #d97706;">MUMU KITCHEN</h1>
```

Emoji yang bisa dipakai:

- 🍽️ (piring & sendok garpu)
- 🍴 (sendok garpu)
- 👨‍🍳 (chef)
- 🥘 (wajan masak)
- 🏪 (toko)

---

### 🖼️ OPSI 2: Menggunakan Logo Gambar

Jika Anda punya logo dan ingin pakai gambar:

#### Step 1: Upload Logo

1. Siapkan file logo (PNG/JPG, recommended: 400x400px atau 600x200px)
2. Upload ke folder: `public/images/`
3. Rename jadi: `logo.png` atau `logo-mumu-kitchen.png`

#### Step 2: Edit Email Template

Buka file: `resources/views/emails/invoice.blade.php`

Cari baris ini (sekitar line 20-30):

```html
<!-- OPSI 1: Gunakan Emoji (Recommended) -->
<h1 style="font-size: 48px; margin: 0; padding: 0;">🍽️</h1>
```

**Comment (nonaktifkan) baris emoji**, lalu **uncomment baris gambar**:

```html
<!-- OPSI 1: Gunakan Emoji -->
<!-- <h1 style="font-size: 48px; margin: 0; padding: 0;">🍽️</h1> -->

<!-- OPSI 2: Gunakan Gambar Logo -->
<img
    src="{{ asset('images/logo.png') }}"
    alt="Mumu Kitchen Logo"
    style="max-width: 120px; height: auto; display: block; margin: 0 auto;"
/>
```

#### Step 3: Gunakan URL Lengkap (Production)

Untuk email, lebih baik pakai URL lengkap:

```html
<img
    src="https://mumu-kitchen.com/images/logo.png"
    alt="Mumu Kitchen Logo"
    style="max-width: 120px; height: auto;"
/>
```

**Catatan:** Ganti `https://mumu-kitchen.com` dengan domain website Anda!

---

## 🎯 Rekomendasi Saya

**Untuk saat ini, pakai EMOJI dulu (Opsi 1)**

Alasan:

1. ✅ Simple & langsung jalan
2. ✅ Tidak perlu setup tambahan
3. ✅ Tidak ada masalah loading gambar
4. ✅ Professional & modern

**Nanti kalau sudah production dan punya domain**, baru ganti ke logo gambar jika mau.

---

## 📋 Isi Template Email yang Sudah Dibuat

Template email sudah include semua ini:

### 1. Header

- ✅ Logo/Emoji Mumu Kitchen
- ✅ Nama brand dengan warna brand
- ✅ Background gradient hijau (#1c2e26)

### 2. Greeting

- ✅ Sapaan ke customer (nama dari database)
- ✅ Ucapan terima kasih

### 3. Detail Invoice

- ✅ No. Invoice
- ✅ No. Pemesanan
- ✅ Tanggal pemesanan
- ✅ Status: LUNAS (badge hijau)

### 4. List Produk

- ✅ Nama produk
- ✅ Jumlah & harga satuan
- ✅ Subtotal per item
- ✅ Design card untuk setiap produk

### 5. Info Pengiriman

- ✅ Nama penerima
- ✅ No HP
- ✅ Alamat lengkap
- ✅ Kota, provinsi, kode pos
- ✅ Ekspedisi & layanan

### 6. Catatan (jika ada)

- ✅ Catatan dari customer

### 7. Total Pembayaran

- ✅ Subtotal produk
- ✅ Biaya pengiriman
- ✅ **TOTAL dengan font besar & warna orange**

### 8. Call to Action

- ✅ Button "Lihat Detail Pesanan"
- ✅ Link ke halaman riwayat

### 9. Footer

- ✅ Nama Mumu Kitchen
- ✅ Email kontak: mumuuu112233@gmail.com
- ✅ Disclaimer (email otomatis)

---

## 🎨 Warna Brand yang Dipakai

Sesuai brand Mumu Kitchen:

- **Hijau Tua:** #1c2e26 (header, text utama)
- **Orange:** #d97706 (highlight, CTA, total)
- **Hijau Muda:** #f0fdf4 (background shipping info)
- **Abu-abu:** #f8f9fa (background box)

---

## 📱 Responsive & Compatible

Template email ini:

- ✅ **Table-based HTML** (support semua email client)
- ✅ **Inline CSS** (agar styling tidak hilang)
- ✅ **Responsive** untuk mobile & desktop
- ✅ **Compatible** dengan:
    - Gmail
    - Outlook
    - Yahoo Mail
    - Apple Mail
    - Thunderbird
    - Dan lainnya

---

## 🧪 Preview Email

Untuk melihat tampilan email sebelum dikirim:

### Via Browser:

1. Buat route temporary di `routes/web.php`:

```php
Route::get('/preview-email', function() {
    $pembayaran = \App\Models\Pembayaran::with(['user', 'pengiriman.provinsi', 'pengiriman.kota', 'pesanan.produk'])->latest()->first();
    return view('emails.invoice', ['pembayaran' => $pembayaran]);
});
```

2. Akses: http://127.0.0.1:8000/preview-email

3. **Hapus route** setelah selesai preview!

---

## ✅ Summary

**Yang perlu Anda lakukan:**

1. ✅ Template email sudah dibuat ← **SELESAI!**
2. ⏳ Setup Gmail SMTP (ikuti file `SETUP_EMAIL_INVOICE.md`)
3. ⏳ Test kirim email

**Tentang gambar:**

- 📧 Saat ini pakai **EMOJI** 🍽️ (recommended)
- 🖼️ Bisa ganti ke **LOGO GAMBAR** nanti kalau mau

**Next step Anda:**

1. Baca file `SETUP_EMAIL_INVOICE.md`
2. Dapatkan App Password dari Gmail
3. Update `MAIL_PASSWORD` di `.env`
4. Restart server Laravel
5. Test pembayaran!

Mudah kan? 😊
