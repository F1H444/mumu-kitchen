# Setup EmailJS untuk Invoice Email

## Langkah-langkah Setup EmailJS:

### 1. Daftar di EmailJS

1. Kunjungi [https://www.emailjs.com/](https://www.emailjs.com/)
2. Daftar atau login dengan akun Anda
3. Gratis untuk 200 email per bulan

### 2. Buat Email Service

1. Di dashboard EmailJS, klik **"Email Services"**
2. Klik **"Add New Service"**
3. Pilih provider email Anda (Gmail, Outlook, dll)
4. Ikuti petunjuk untuk connect email Anda
5. **Copy Service ID** yang muncul

### 3. Buat Email Template

1. Di dashboard EmailJS, klik **"Email Templates"**
2. Klik **"Create New Template"**
3. Buat template dengan struktur berikut:

**Subject:**

```
Invoice Pembayaran #{{no_pemesanan}} - Mumu Kitchen
```

**Content:**

```html
{{{invoice_html}}}
```

4. **Copy Template ID** yang muncul

### 4. Dapatkan Public Key

1. Di dashboard EmailJS, klik **"Account"**
2. Scroll ke bawah ke bagian **"API Keys"**
3. **Copy Public Key** Anda

### 5. Update File .env

Buka file `.env` dan update nilai berikut dengan credentials EmailJS Anda:

```env
EMAILJS_SERVICE_ID=your_service_id_here
EMAILJS_TEMPLATE_ID=your_template_id_here
EMAILJS_PUBLIC_KEY=your_public_key_here
```

Ganti:

- `your_service_id_here` dengan Service ID dari langkah 2
- `your_template_id_here` dengan Template ID dari langkah 3
- `your_public_key_here` dengan Public Key dari langkah 4

### 6. Konfigurasi Laravel Mail (Alternatif)

Jika Anda ingin menggunakan Laravel Mail native tanpa EmailJS, update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Mumu Kitchen"
```

**Catatan untuk Gmail:**

- Aktifkan "2-Step Verification" di akun Google Anda
- Buat "App Password" khusus untuk aplikasi ini
- Gunakan App Password sebagai `MAIL_PASSWORD`

### 7. Testing

Setelah setup selesai:

1. Lakukan test pembayaran
2. Cek email customer yang melakukan pembayaran
3. Invoice otomatis akan dikirim setelah pembayaran sukses

## Troubleshooting

### Email tidak terkirim?

1. Cek log di `storage/logs/laravel.log`
2. Pastikan credentials EmailJS sudah benar
3. Pastikan user memiliki email di database

### Gmail memblokir email?

1. Pastikan menggunakan App Password, bukan password biasa
2. Aktifkan "Less secure app access" (tidak direkomendasikan)
3. Atau gunakan EmailJS sebagai alternatif yang lebih mudah

## Fitur yang Sudah Diimplementasi

✅ **Status Pembayaran Otomatis**

- Setelah pembayaran sukses via Midtrans, status langsung menjadi "Selesai"
- Tidak ada lagi status "Menunggu Bayar" setelah pembayaran

✅ **Email Invoice Otomatis**

- Invoice dikirim otomatis ke email customer setelah pembayaran berhasil
- Template invoice premium dengan desain modern
- Responsive untuk mobile dan desktop

✅ **Detail Invoice Lengkap**

- No. Invoice dan No. Pemesanan
- List produk yang dibeli
- Informasi pengiriman lengkap
- Total pembayaran dengan breakdown
- Link untuk melihat detail pesanan
