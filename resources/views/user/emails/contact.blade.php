<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }
        .header {
            background-color: #3b82f6;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f8fafc;
        }
        .detail {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #4b5563;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.8em;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pesan Kontak Baru</h1>
        </div>
        <div class="content">
            <div class="detail">
                <span class="label">Nama:</span> {{ $data['name'] }}
            </div>
            <div class="detail">
                <span class="label">Email:</span> {{ $data['email'] }}
            </div>
            <div class="detail">
                <span class="label">Subjek:</span> {{ $data['subject'] }}
            </div>
            <div class="detail">
                <span class="label">Pesan:</span>
                <p>{{ $data['message'] }}</p>
            </div>
        </div>
        <div class="footer">
            Pesan ini dikirim melalui formulir kontak website Desa Wisata Arjasa
        </div>
    </div>
</body>
</html>