<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <title>Monitoring Project</title>


    <style>


        /* GLOBAL */
        body, html { margin: 0; padding: 0; background: #f3f4f6; 
        font-family: Arial, sans-serif;
                background: #f3f4f6; /* abu soft */
                margin: 0;
                padding: 0;}
        .display-wrapper { padding: 25px 40px; position: relative; }

        /* LOGO */
        .logo-top-right {
            position: absolute;
            top: 15px;
            right: 40px;
        }
        .logo-top-right img {
            height: 80px;
        }

        /* TITLE */
        .display-title {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 5px;
        }
        .display-date {
            font-size: 22px;
            font-weight: 600;
            color: #4b5563;
        }

        /* TABEL UTAMA */
        .display-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            font-size: 16px;
            border-radius: 12px;
            overflow: hidden;
        }
        .display-table thead {
            /* background: #1f2937; */
            background: #1f3723;
            color: white;
            font-weight: 700;
            text-transform: uppercase;
        }
        .display-table th,
        .display-table td {
            padding: 12px 20px;
            border-bottom: 1px solid #e5e7eb;
            text-align: center;
        }
        .display-table tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        /* ABSEN */
        .absen-title {
            margin-top: 32px;
            /* text-align: left; */
            font-size: 18px;
            font-weight: 800;
            color: #B91C1C;
        }
        .absen-table {
            width: 100%;
            background: white;
            font-size: 15px;
            border-radius: 10px;
            border-collapse: separate;
            overflow: hidden;
        }
        .absen-table thead {
            background: #B91C1C;
            color: white;
        }
        .absen-table th,
        .absen-table td {
            padding: 10px 18px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        /* SCROLL */
        .scroll-container {
            overflow-y: hidden;
            max-height: calc(100vh - 200px);
        }

        /* Handphone & Tablet No Scroll */
        @media (max-width: 1024px) {
            .scroll-container {
                overflow-y: visible !important;
            }
        }

        @media (max-width: 768px) {
            .logo-top-right {
                display: none !important;
            }
        }

        .off-red {
                color: #ff3434 !important;
                font-weight: bold;
            }


            /* FLOATING MENU */
/* Header Top */
.header-top {
    margin-top: 20px;
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 40px;
    /* background-color: #B91C1C */
}

.title-block {
    text-align: center;
}

/* Buttons */
.header-buttons {
    display: flex;
    gap: 12px;
}

.btn-header {
    padding: 10px 18px;
    font-size: 12px;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    color: white;
    display: inline-block;
    text-align: center;
}

.btn-map {
    background: #1f3723;
}

.btn-logout {
    background: #b91c1c;
}

/* Responsif HP/Tablet */
@media (max-width: 1024px) {
    .header-top {
        flex-direction: column;
        gap: 15px;
    }

    .btn-header {
        font-size: 16px;
        padding: 8px 14px;
    }
}

        </style>


</head>

<body>
  

    @livewire('display.monitor')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('scrollContainer');
            if (!container) return;

            const isTV = window.innerWidth >= 1400;
            if (!isTV) return;

            let scrollSpeed = 1;
            let interval;

            function startScroll() {
                interval = setInterval(() => {
                    container.scrollTop += scrollSpeed;

                    if (container.scrollTop + container.clientHeight >= container.scrollHeight) {
                        container.scrollTop = 0;
                    }
                }, 50);
            }

            if (container.scrollHeight > container.clientHeight) {
                startScroll();
            }
        });
    </script>

</body>
</html>
