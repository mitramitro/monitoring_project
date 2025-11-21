<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Tangan</title>
</head>

<body>
    <div>
        <table align="center" style="border: 1px solid black; padding: 20px" width="480">
            <tr>

                <td style="font-weight: bold; text-align: center">
                    APLIKASI NOTA PERMINTAAN
                    <br>
                    INTEGRATED TERMINAL BALONGAN
                </td>
                <td>
                    <img src="{{ asset('templateadmin/images/logo-pertamina-patraniaga.png') }}" alt="" width="120">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    Menyatakan Bahwa :
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table>
                        <tr>
                            <td>Nomor Nota</td>
                            <td width="60" align="center">:</td>
                            <td>
                                {{ $item->number }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td align="center">:</td>
                            <td>
                                {{ Carbon\Carbon::parse($item->date)->format('d F Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td align="center">:</td>
                            <td style="text-transform: uppercase;">
                                {{ $item->regarding }}
                            </td>
                        </tr>
                        <tr>
                            <td>Dari</td>
                            <td align="center">:</td>
                            <td style="text-transform: uppercase;">
                                {{ $item->from }}
                            </td>
                        </tr>
                        <tr>
                            <td>Kepada</td>
                            <td align="center">:</td>
                            <td style="text-transform: uppercase;">
                                {{ $item->to }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td align="center">:</td>
                            <td style="text-transform: uppercase;">
                                {{ $item->status }}
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="font-weight: bold; text-align: center; padding: 20px; font-size: 18px">
                    Adalah benar, sah dan tercatat di system kami
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px" colspan="3">
                    Informasi detail hasil dokumen dapat dilihat melalui barcode yang terdapat pada
                    bawah dokumen
                </td>
            </tr>

            <tr>
                <td colspan="2">
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
                                {{ $approvalTeknik->position }}
                            </td>
                            <td class="text-center" width="33%" style="vertical-align: top;">
                                <span>Menyetujui :</span>
                                <br />
                                {{ $approvalManager->position }}


                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" style="vertical-align: bottom;">
                                <span class="fw-bold">Name : {{ $item->user->name }}</span>
                                <br />
                                <span class="fw-bold">Date : {{ Carbon\Carbon::parse($item->date)->format('d F Y')
                                    }}</span>
                            </td>
                            <td class="text-center" style="vertical-align: bottom;">
                                <br />
                                <span class="fw-bold">Name : {{ $approvalTeknik->name }}</span>
                                <br />
                                <span class="fw-bold">Date : {{
                                    Carbon\Carbon::parse($approvalTeknik->created_at)->format('d F Y')
                                    }}</span>
                            </td>
                            <td class="text-center" style="vertical-align: bottom;">
                                <span class="fw-bold">Name : {{ $approvalManager->name }}</span>
                                <br />
                                <span class="fw-bold">Date : {{
                                    Carbon\Carbon::parse($approvalManager->created_at)->format('d F Y')
                                    }}</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>


    </div>
</body>

</html>