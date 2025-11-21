<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Permohonan PTPP</title>
    <style>
        table.table {
            border-collapse: collapse;
            margin-top: 0;
            text-align: left;
            font-size: 10.5px;
        }

        h1,
        h3 {
            margin-bottom: 0;
        }

        .textalign {
            text-align: center;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .page-break {
            page-break-after: always;
        }

        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }

        fs-8 {
            font-size: 8px;
        }
        .body_np table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    .body_np table th,
    .body_np table td {
        border: 1px solid #000;
        border-style: solid;
        padding: 6px;
        text-align: left;
    }
    </style>
</head>

<body>
    <table border="0" width="100%">
        <tr>
            <td>
                <h3><u>NOTA PERMINTAAN</u></h3>
                <span class="fw-bold">No: {{ $item->number }}</span>
            </td>
            <td align="right">
                <img src="templateadmin/images/logo-pertamina-patraniaga.png" style="width: 200px" alt="" />
            </td>
        </tr>
        <tr>
            <td>Balongan, {{ Carbon\Carbon::parse($item->date)->format('d F Y') }}</td>
        </tr>
    </table>
    <table border="0" style="margin-top: 20px;" width="100%">
        <tr>
            <td style="width: 15%;">Kepada </td>
            <td>: {{ $item->to }}</td>
        </tr>
        <tr>
            <td style="width: 15%;">Dari </td>
            <td>: {{ $item->from }}</td>
        </tr>


    </table>
    <table style="margin-top: 20px;" width="100%">
        <tr>
            <td style="width: 15%;">Lampiran </td>
            <td>:</td>
        </tr>

        <tr>
            <td style="width: 15%;margin-top: 20px;">Perihal </td>
            <td>: {{ $item->regarding }}</td>
        </tr>
    </table>

    <div style="margin-top: 30px" class="body_np">
        {!! $item->body !!}
    </div>

    <table border="0" width="100%" style="margin-top: 50px">
        <tr>
            <td class="text-center" width="33%" style="vertical-align: top;">
                <span>Dibuat Oleh</span>
                <br />
                {{ $item->from }}

            </td>
            <td class="text-center" style="vertical-align: top;" width="33%">
                <span>Mengetahui :</span>
                <br />
                {{ optional($approvalTeknik)->position ?? '-' }}


            </td>
            <td class="text-center" width="33%" style="vertical-align: top;">
                <span>Menyetujui :</span>
                <br />
                {{ optional($approvalManager)->position ?? '-' }}


            </td>

        </tr>

        <tr>
            <td class="text-center" style="vertical-align: middle;">
                <br />
                <div style="font-size: 14px;">
                    Signature : {{ $item->from }}
                </div>
                <br />
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <br />
                <div style="font-size: 14px;">
                    Signature : {{ optional($approvalTeknik)->position ?? '-' }}
                </div>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <br />
                <div style="font-size: 14px;">
                    Signature : {{ optional($approvalManager)->position ?? '-' }}
                </div>
                <br />
            </td>
        </tr>

        <tr>
            <td class="text-center" style="vertical-align: bottom;">
                <span class="fw-bold">Name : {{ $item->user->name }}</span>
                <br />
                <span class="fw-bold">Date : {{ Carbon\Carbon::parse($item->date)->format('d F Y') }}</span>
            </td>
            <td class="text-center" style="vertical-align: bottom;">
                <br />
                <span class="fw-bold">Name : {{ optional($approvalTeknik)->name ?? '-' }}</span>
                <br />
                <span class="fw-bold">Date : {{ optional($approvalTeknik?->created_at)->format('d F Y') ?? '-' }}</span>
            </td>
            <td class="text-center" style="vertical-align: bottom;">
                <span class="fw-bold">Name : {{ optional($approvalManager)->name ?? "-" }}</span>
                <br />
                <span class="fw-bold">Date : {{ optional($approvalManager?->created_at)->format('d F Y') ?? '-' }}</span>
            </td>
        </tr>
    </table>

    <table border="0" style="margin-top: 20px">
        <tr>
            <td>
                <img class="qrcode"
                    src="data:image/png;base64, {!! base64_encode(QrCode::size(50)->backgroundColor(255, 252, 245)->generate($url)) !!} ">
            </td>
            <td style="font-size: 12px">
                <i>
                    "Dokumen ini dianggap sah dengan menggunakan Approval digital dari sistem aplikasi Nota Permintaan dan kode QR
                    berikut berisi
                    informasi detail dari dokumen yang dicetak dari sistem aplikasi Nota Permintaan"
                </i>
            </td>
        </tr>
    </table>

    <div class="page-break"></div>
    <h2 class="text-center">LAMPIRAN</h2>
    <table border="0" width="100%">
        @foreach ($notePhoto as $photo)
        <tr>
            <td style="text-align: center">
                {{-- <div
                    style="width: 400px;height: 700px;background-image: url(storage/{{ $photo->photo }});background-size: cover;text-align: center;">
                </div> --}}
                <img 
                    src="{{ public_path('storage/'.$photo->photo) }}" 
                    style="max-width: 100%; max-height: 700px; object-fit: contain; border: 1px solid #ccc;"/>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>