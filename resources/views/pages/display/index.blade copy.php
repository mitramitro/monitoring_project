<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Monitoring Project</title>

    <style>

    /* ======== GLOBAL DISPLAY STYLE ======== */
    html, body,h1,h3 {
            margin: 0;
            padding: 0;
        }

    body {
        font-family: Arial, sans-serif;
        background: #f3f4f6; /* abu soft */
        margin: 0;
        padding: 0;
    }

    .display-wrapper {
        padding: 8px;
        background-color: rgb(248, 248, 248);
    }

    h1.display-title {
        font-size: 32px;
        font-weight: 800;
        color: #1f2937;
        text-align: center
        /* margin-bottom: 10px; */
    }

    h3.display-date {
        font-size: 24px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 24px;
        text-align: center
    }


    /* ======== TABLE STYLE ======== */
    table.display-table {
        width: 100% !important;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        font-size: 12px;
        border-radius: 16px;
        overflow: hidden;
    }

    /* Header */
    table.display-table thead {
        background: #1f2937;
        color: white;
        font-size: 12px;
        font-weight: 700;
    }

    table.display-table th {
        padding: 14px 26px !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-right: 1px solid #2d3748;
    }
    table.display-table th:last-child {
        border-right: none;
    }

    /* Body rows */
    table.display-table td {
        padding: 16px 26px !important;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
        text-align: center
    }

    /* Zebra stripe */
    table.display-table tbody tr:nth-child(even) {
        background: #f9fafb;
    }

    /* Hover effect */
    table.display-table tbody tr:hover {
        background: #eef2ff;
        transition: 0.2s;
    }

    /* Remove last border */
    table.display-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* ======== ABSEN REASON TABLE STYLE ======== */
h3.absen-title {
    font-size: 20px;
    font-weight: 700;
    color: #B91C1C;
    margin: 20px 0 10px 0;
    text-align: center;
}

table.absen-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    font-size: 11px; /* Lebih kecil dari tabel utama */
    border-radius: 12px;
    overflow: hidden;
}

/* Header */
table.absen-table thead {
    background: #B91C1C; /* Merah gelap */
    color: white;
    font-weight: 700;
}

table.absen-table th {
    padding: 10px 20px !important;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

/* Body */
table.absen-table td {
    padding: 12px 20px !important;
    border-bottom: 1px solid #f1f1f1;
    text-align: center;
    vertical-align: middle;
}

/* Zebra */
table.absen-table tbody tr:nth-child(even) {
    background: #fdf2f2; /* merah muda sangat lembut */
}

/* Hover */
table.absen-table tbody tr:hover {
    background: #fee2e2;
    transition: 0.2s;
}

table.absen-table tbody tr:last-child td {
    border-bottom: none;
}


/* logo  */
.logo-top-right {
        position: fixed;        /* tidak ikut scroll */
        top: 8px;              /* jarak dari atas */
        right: 24px;            /* jarak dari kanan */
        z-index: 9999;          /* selalu di atas */
    }

    .logo-top-right img {
        height: 80px;           /* sesuaikan ukuran */
        object-fit: contain;
    }

</style>

</head>
<body>

    @livewire('display.monitor')

</body>
</html>
