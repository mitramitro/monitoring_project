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

        h1 {
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
    </style>
</head>

<body>
    <table cellpadding="3" width="100%" border="1" class="table table-bordered" border-color="black">
        <tr>
            <td class="text-center">No. PTPP <i>(di isi oleh MR/Doc. Controller)</i> </td>
            <td rowspan="4" colspan="2" class="text-center">
                <table border="0">
                    <tr>
                        <td>
                            <h2 class="text-center">
                                PERMINTAAN TINDAKAN PERBAIKAN <br /> DAN PENCEGAHAN <br />
                                (PTPP) </h2>
                        </td>
                        <td>
                            <img src="templateadmin/images/logo-pertamina-patraniaga.png" style="width: 160px" alt="" />
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
        <tr>
            <td>No. {{ $item->number }}</td>
        </tr>
        <tr>
            <td class="text-center">
                {{ Carbon\Carbon::parse($item->date)->format('d F Y') }}
            </td>
        </tr>
        <tr>
            <td class="text-center fw-bold">
                {{ $item->title }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Kepada / Fungsi &nbsp; : {{ $item->to_function }}
            </td>
            <td>
                Area / Lokasi Temuan
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Dari / Fungsi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $item->from_function }}
            </td>

            <td>
                {{ $item->location->name }}
            </td>
        </tr>
        <tr>
            <td style="background-color: rgb(151, 182, 241)" colspan="3">
                <i>Di isi oleh pemohon / auditor</i>
            </td>
        </tr>
        <tr>
            <td class="text-center fw-bold" colspan="3">SUMBER KETIDAKSESUAIAN ATAU POTENSINYA</td>
        </tr>
        <tr>
            <td colspan="3">
                <table border="0">
                    @php
                    $potentialSource = array_map('trim', explode(',', $item->potential_source));
                    @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('Keluhan Pelanggan', $potentialSource)
                                ? 'checked' : '' }} />
                        </td>
                        <td>
                            Keluhan Pelanggan
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('MWT', $potentialSource) ? 'checked' : ''
                                }} />
                        </td>
                        <td>
                            MWT
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('Tinjauan Management', $potentialSource)
                                ? 'checked' : '' }} />
                        </td>
                        <td>
                            Tinjauan Management
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('Permintaan Perbaikan', $potentialSource)
                                ? 'checked' : '' }} />
                        </td>
                        <td>
                            Permintaan Perbaikan
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('Audit (Eksternal/Internal)',
                                $potentialSource) ? 'checked' : '' }} />
                        </td>
                        <td>
                            Audit (Eksternal/Internal)
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('Nearmiss', $potentialSource) ? 'checked'
                                : '' }} />
                        </td>
                        <td>
                            Nearmiss
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('Survey Pelanggan', $potentialSource)
                                ? 'checked' : '' }} />
                        </td>
                        <td>
                            Survey Pelanggan
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('Tinjauan Lapangan', $potentialSource)
                                ? 'checked' : '' }} />
                        </td>
                        <td>
                            Tinjauan Lapangan
                        </td>
                    </tr>
                </table>
            </td>
        <tr>
            <td class="text-center fw-bold" colspan="3">KETIDAKSESUAIAN ATAU POTENSI YANG DITEMUKAN</td>
        </tr>
        <tr>
            <td colspan="3">
                <div style="min-height: 100px">
                    {!! $item->discovered_potential !!}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Batas waktu reply / jawab :</td>
        </tr>
        <tr>
            <td colspan="2">
                Dokumentasi keadaan existing :
            </td>
            <td>
                *) Kategori : {!! $item->category == 'Urgent' ? 'Urgent' : '<s>Urgent</s>' !!} / {!! $item->category ==
                'Tidak Urgent' ? 'Tidak Urgent' : '<s>Tidak Urgent</s>' !!}
            </td>
        </tr>

    </table>
    <table cellpadding="3" width="100%" border="1" class="table table-bordered" border-color="black">
        <tr>
            <td rowspan="4" style="vertical-align: top;width: 60%">
                <div>
                    *) Dokumentasi Terlampir
                </div>
            </td>
            <td style="height: 10px !important">
                Pemohon / Auditor
            </td>
            <td>
                Disetujui Oleh
            </td>
        </tr>
        <tr>
            <td style="vertical-align: bottom" rowspan="2" class="text-center">
                <div>
                    Signature : {{ $item->from_function }}
                </div>
                <br />
                <span class="fw-bold">Name :{{ $item ? $item->name : '-' }}</span>
                

            </td>
            <td style="height: 0px;" class="text-center">
                <div class="fw-bold">{{ $approvalManager && $approvalManager->position ? $approvalManager->position : '-' }}</div>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <div>
                    Signature : {{ $approvalManager && $approvalManager->position ? $approvalManager->position : '-' }}
                </div>
                <br />
                <span class="fw-bold">Name :{{ $approvalManager && $approvalManager->name ? $approvalManager->name : '-' }}</span> 

            </td>
        </tr>
        <tr>
            <td class="text-center">Tgl : {{ $approvalTeknik && $approvalTeknik->created_at ? $approvalTeknik->created_at->format('d F Y'): '-' }}</td>
            <td class="text-center">Tgl : {{ $approvalManager && $approvalManager->created_at ? $approvalManager->created_at->format('d F Y'): '-' }}</td>
        </tr>
        <tr>
            <td colspan="3">
                <div style="min-height: 10px">

                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color: rgb(151, 182, 241)" colspan="3">
                <i>Di isi oleh penerima PTPP</i>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center">
                <span class="fw-bold text-center">TINDAK LANJUT</span>
            </td>
        </tr>
    </table>
    <table cellpadding="3" width="100%" border="1" class="table table-bordered" border-color="black">
        <tr>
            <td rowspan="4" style="vertical-align: top">
                <span class="fw-bold">PERBAIKAN / TINDAKAN SEMENTARA (Jika ada) :</span>
                <div>
                    {!! $item->temporary_measure !!}
                </div>
            </td>
            <td style="width: 20%">Tgl Terima PTPP :</td>
            <td colspan="2" class="text-center"> Penerima PTPP</td>
        </tr>
        <tr>
            <td rowspan="3">
                {{ Carbon\Carbon::parse($item->date_reveived)->format('d F Y') }}
            </td>
            <td style="width: 20%">Penanggung Jawab</td>
            <td>Disetujui Oleh,</td>
        </tr>
        <tr>
            <td rowspan="2">
                {{ $item->person_responsible }}
            </td>
            <td class="text-center" style="width: 20%">
                <span class="fw-bold text-center">
                    {{ optional($approvalTeknik)->position ?? '-' }}
                </span>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <div>
                    Signature : {{ $approvalTeknik && $approvalTeknik->position ? $approvalTeknik->position: '-' }}
                </div>
                <br />
                <span class="fw-bold">
                    Name : {{ optional($approvalTeknik)->name ?? '-' }}
                </span>
                <span class="fw-bold">
                    <br />
                    Date : {{ optional($approvalTeknik?->created_at)->format('d F Y') ?? '-' }}
                </span>
            </td>
        </tr>
    </table>

    <table cellpadding="3" width="100%" border="1" class="table table-bordered" border-color="black">
        <tr>

            <td>Analisa Penyebab</td>
            <td>Tindakan Perbaikan dan Pencegahan</td>
            <td>PIC</td>
            <td>Waktu Pelaksanaan</td>
        </tr>
        <tr>

            <td>
                <div style="min-height: 120px">
                    {!! $item->causal_analysis !!}
                </div>
            </td>
            <td>
                <div style="min-height: 120px">
                    {!! $item->preventive_measure !!}
                </div>
            </td>
            <td>
                <div style="min-height: 120px">
                    {{ $item->pic }}
                </div>
            </td>
            <td>
                <div style="min-height: 120px">
                    {{ Carbon\Carbon::parse($item->execution_date)->format('d F Y') }}
                </div>
            </td>
        </tr>
    </table>
    <table cellpadding="3" width="100%" border="1" class="table table-bordered" border-color="black">
        <tr>
            <td>
                <span class="fw-bold">Dokumen yang direvisi (jika ada) :</span>
                <table border="0">
                    @php
                    $documents = array_map('trim',
                    explode(',', $item->documents))
                    @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('Pedoman / Manual', $documents) ? 'checked'
                                : '' }}>
                        </td>
                        <td>
                            Pedoman / Manual
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('TKI', $documents) ? 'checked' : '' }}>
                        </td>
                        <td>
                            TKI
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('Formulir', $documents) ? 'checked' : ''
                                }}>
                        </td>
                        <td>
                            Formulir
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('TKO', $documents) ? 'checked' : '' }}>
                        </td>
                        <td>
                            TKO
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('TKPA', $documents) ? 'checked' : '' }}>
                        </td>
                        <td>
                            TKPA
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" {{ in_array('Lainnya', $documents) ? 'checked' : '' }}>
                        </td>
                        <td>
                            {{ $item->document_others ? $item->document_others : '_______' }}
                        </td>

                    </tr>
                </table>
            </td>
            <td>
                <span class="fw-bold">Target Waktu Verifikasi</span>
                <br /><br />
                <span class="fw-bold">Tgl : {{ Carbon\Carbon::parse($item->target_verification)->format('d F Y')
                    }}</span>
            </td>
        </tr>

        <tr>
            <td style="background-color: rgb(151, 182, 241)" colspan="2">
                <i>Di isi oleh penerima PTPP</i>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-center">
                <span class="fw-bold text-center">
                    VERIFIKASI PELAKSANAAN TINDAKAN PERBAIKAN DAN PENCEGAHAN
                </span>
            </td>
        </tr>
    </table>
    <table class="table table-bordered" width="100%" border="1">
        <tr>
            <td rowspan="3" style="vertical-align: top">
                Status :
                <table border="0">
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="" {{ $item->status == 'COMPLETED' ? 'checked' : '' }} >
                        </td>
                        <td>
                            Close
                        </td>
                        <td>
                            Tanggal Penyelesaian
                        </td>
                        <td>: {{ Carbon\Carbon::parse($item->completion_date)->format('d F Y')
                            }}</td>
                    </tr>
                </table>

                Catatan :
                <br />
                Jika tindakan perbaikan/pencegahan belum memenuhi maka terbitkan PTPP Baru

                <table border="0" width="100%">
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="" {{ $item->category_note == 'Efektif' ? 'checked' : ''
                            }} >
                            <br />
                            <input type="checkbox" name="" id="" {{ $item->category_note == 'Belum Efektif' ? 'checked'
                            : ''
                            }}>
                        </td>
                        <td>
                            Efektif
                            <br /><br />
                            Belum Efektif
                        </td>
                        <td style="border: 1px solid black;">
                            Catatan Rekomendasi Lanjutan :
                            <br />
                            {{ $item->recomendation_note }}
                        </td>
                    </tr>

                </table>

                *) Khusus untuk kategori audit
            </td>
            <td colspan="2">
                Approval Pemohon / Auditor
            </td>
        </tr>
        <tr>
            <td rowspan="2"></td>
            <td>Disetujui</td>
        </tr>
        <tr>
            <td class="text-center">
                <span class="fw-bold">
                    Signature : {{ optional($approvalManager)->position ?? '-' }}
                </span>
                <br />
                <span class="fw-bold">
                    Name : {{ optional($approvalManager)->name ?? '-' }}
                </span>
                <br /><br /><br />
                <span class="fw-bold">
                    Date : {{ optional($approvalManager?->created_at)->format('d F Y') ?? '-' }}
                </span>
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
                    "Dokumen ini dianggap sah dengan menggunakan Approval digital dari sistem aplikasi PTPP dan kode QR
                    berikut berisi
                    informasi detail dari dokumen yang dicetak dari sistem aplikasi PTPP"
                </i>
            </td>
        </tr>
    </table>
    <div class="page-break"></div>
    <h2 class="text-center">LAMPIRAN</h2>
    <h3>BEFORE</h3>
    <table border="0" width="100%">
        @foreach ($ptppPhotoBefore as $photo)
        <tr>
            {{-- <td style="text-align: center">
                <div
                    style="width: 400px;height: 700px;background-image: url(storage/{{ $photo->photo }});background-size: cover;text-align: center;">
                </div>
            </td> --}}
            <td style="text-align: center;">
                <img 
                    src="{{ public_path('storage/'.$photo->photo) }}" 
                    style="max-width: 100%; max-height: 700px; object-fit: contain; border: 1px solid #ccc;"/>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="page-break"></div>
    <h3>AFTER</h3>
    <table border="0" width="100%">
        @foreach ($ptppPhotoAfter as $photo)
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