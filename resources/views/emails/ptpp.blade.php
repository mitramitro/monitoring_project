<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Bisnis</title>
    <style>
        /* Reset CSS dasar */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f5f7;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        table {
            border-spacing: 0;
            width: 100%;
        }

        td {
            padding: 0;
        }

        img {
            border: 0;
        }

        /* Container utama */
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f5f7;
            padding: 40px 0;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        /* Header */
        .header {
            background-color: #0d6efd;
            color: #ffffff;
            text-align: center;
            padding: 30px 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        /* Isi email */
        .content {
            padding: 30px 40px;
            color: #333333;
            line-height: 1.6;
        }

        .content h2 {
            color: #0d6efd;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .content p {
            margin: 10px 0;
            font-size: 15px;
        }

        /* Tombol utama */
        .btn {
            display: inline-block;
            background-color: #0d6efd;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0b5ed7;
        }

        /* Footer */
        .footer {
            text-align: center;
            color: #888888;
            font-size: 13px;
            padding: 25px 15px;
        }

        .footer a {
            color: #0d6efd;
            text-decoration: none;
        }

        /* Responsif untuk mobile */
        @media only screen and (max-width: 600px) {
            .content {
                padding: 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .content h2 {
                font-size: 18px;
            }

            .btn {
                padding: 10px 20px;
            }
        }
    </style>
</head>

<body>
    <center class="wrapper">
        <table class="main">
            <!-- Header -->
            <tr>
                <td class="header">
                    <!--<h1>{{ config('app.name') }}</h1>-->
                    <h1>MPS APP</h1>
                </td>
            </tr>

            <!-- Konten -->
            <tr>
                <td class="content">
                    <h2>Halo, {{ $name }} 👋</h2>

                    <p>Kami informasikan bahwa terdapat <strong>permohonan PTPP baru</strong> yang telah masuk ke sistem
                        .</p>

                    <table>
                        <tr>
                            <td>Nama Pemohon </td>
                            <td>: {{ $namaPemohon }}</td>
                        </tr>
                        <tr>
                            <td>Judul Temuan </td>
                            <td>: {{ $judulTemuan }}</td>
                        </tr>
                        <tr>
                            <td>Lokasi Temuan </td>
                            <td>: {{ $lokasiTemuan }}</td>
                        </tr>
                    </table>

                    <p>Mohon untuk segera melakukan <strong>review dan verifikasi</strong> terhadap permohonan tersebut
                        agar proses
                        dapat dilanjutkan sesuai prosedur.</p>

                    <p>Terima kasih atas perhatian dan kerja samanya.</p>
                    <br>
                    <p>Salam hormat,</p>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td class="footer">
                    <p>© {{ date('Y') }} {{ config('app.name') }}. Semua hak dilindungi.</p>
                    <p>
                        Email ini dikirim secara otomatis — mohon tidak membalas langsung.<br>
                    </p>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>