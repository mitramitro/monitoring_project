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
        font-size: 48px;
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

</style>

</head>
<body>

    @livewire('display.monitor')

</body>
</html>
