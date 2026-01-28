<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - Mumu Kitchen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #d97706;
            --dark: #1c2e26;
            --success: #22c55e;
        }

        body {
            background: linear-gradient(135deg, var(--dark) 0%, #2d4a3a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .success-container {
            background: white;
            border-radius: 20px;
            padding: 50px;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--success) 0%, #16a34a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: scaleIn 0.5s ease-out;
        }

        .success-icon i {
            font-size: 50px;
            color: white;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        h1 {
            color: var(--dark);
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid var(--primary);
            padding: 20px;
            margin: 30px 0;
            text-align: left;
            border-radius: 8px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #666;
            font-size: 14px;
        }

        .info-value {
            color: var(--dark);
            font-weight: 600;
            font-size: 14px;
        }

        .btn-primary-custom {
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background: #c26906;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(217, 119, 6, 0.3);
            color: white;
        }

        .btn-secondary-custom {
            background: transparent;
            color: var(--dark);
            border: 2px solid var(--dark);
            padding: 15px 40px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
            transition: all 0.3s ease;
        }

        .btn-secondary-custom:hover {
            background: var(--dark);
            color: white;
        }

        .email-status {
            background: #fef3c7;
            border: 1px solid #fbbf24;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 14px;
            color: #92400e;
        }

        .email-status i {
            margin-right: 8px;
        }

        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #fbbf24;
            border-radius: 50%;
            border-top-color: #92400e;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>

        <h1>Pembayaran Berhasil!</h1>
        <p class="subtitle">Terima kasih telah berbelanja di Mumu Kitchen</p>

        <div class="info-box">
            <div class="info-row">
                <span class="info-label">No. Pemesanan</span>
                <span class="info-value" id="orderNumber">-</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status Pesanan</span>
                <span class="info-value"><span style="color: var(--success)">✓ Selesai</span></span>
            </div>
            <div class="info-row">
                <span class="info-label">Status Pembayaran</span>
                <span class="info-value"><span style="color: var(--success)">✓ Lunas</span></span>
            </div>
        </div>

        <div class="email-status" id="emailStatus">
            <i class="fas fa-envelope"></i>
            <span id="emailMessage">Invoice sedang dikirim ke email Anda...</span>
            <div class="loading-spinner" id="loadingSpinner"></div>
        </div>

        <p style="color: #666; font-size: 14px; margin: 20px 0;">
            Pesanan Anda sedang diproses dan akan segera dikirim.
            Anda dapat melihat detail pesanan di halaman riwayat.
        </p>

        <div style="margin-top: 30px;">
            <a href="/riwayat" class="btn-primary-custom">
                <i class="fas fa-history"></i> Lihat Riwayat Pesanan
            </a>
            <a href="/" class="btn-secondary-custom">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script>
        // Get order data from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('order_id');
        const orderNumber = urlParams.get('order_number');

        if (orderNumber) {
            document.getElementById('orderNumber').textContent = '#' + orderNumber;
        }

        // Simulate email sending status (in real implementation, this would be triggered by backend)
        setTimeout(() => {
            const emailStatus = document.getElementById('emailStatus');
            const emailMessage = document.getElementById('emailMessage');
            const loadingSpinner = document.getElementById('loadingSpinner');

            emailStatus.style.background = '#d1fae5';
            emailStatus.style.borderColor = '#6ee7b7';
            emailStatus.style.color = '#065f46';
            emailMessage.innerHTML = '<i class="fas fa-check-circle"></i> Invoice telah dikirim ke email Anda!';
            loadingSpinner.style.display = 'none';
        }, 3000);

        // Auto redirect to history after 10 seconds
        let countdown = 10;
        const countdownInterval = setInterval(() => {
            countdown--;
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                window.location.href = '/riwayat';
            }
        }, 1000);
    </script>
</body>

</html>
