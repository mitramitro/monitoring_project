let idPerpustakaanKeliling = 0;
$("#tambahKomponenPerpustakaanKeliling").click(function () {
    idPerpustakaanKeliling++;
    const htmlJenisPerpustakaan = $("#komponentjenisperpustakaan").val();
    $("#komponenPerpustakaanKeliling").append(`
            <div class="my-3 row align-items-end" id="PerpustakaanKeliling${idPerpustakaanKeliling}">
                <div class="col-sm-4 mb-2">
                    <label class="col-form-label" for="jenis_perpustakaan_pusling${idPerpustakaanKeliling}">
                        Jenis Perpustakaan <span class="text-danger">*</span>
                    </label>
                    <select name="jenis_perpustakaan_pusling[]" id="jenis_perpustakaan_pusling${idPerpustakaanKeliling}" class="form-control" required>
                    ${htmlJenisPerpustakaan}
                    </select>
                </div>
                <div class="col-sm-4 mb-2">
                    <label class="col-form-label" for="nama_perpustakaan_keliling${idPerpustakaanKeliling}">
                        Titik Layanan <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="nama_perpustakaan_keliling[]" id="nama_perpustakaan_keliling${idPerpustakaanKeliling}"
                        placeholder="Masukan nama perpustakaan"
                        required>
                </div>
                <div class="col-sm-2 mb-2">
                    <label class="col-form-label" for="jumlah_pengunjung${idPerpustakaanKeliling}">
                        Jumlah Pengunjung <span class="text-danger">*</span>
                    </label>
                    <input type="number" class="form-control" name="jumlah_pengunjung[]" id="jumlah_pengunjung${idPerpustakaanKeliling}"
                        value="0"
                        required>
                </div>  
                <div class="col-sm-2 mb-2">
                    <button class="btn btn-danger" onclick="hapusKomponenPerpustakaanKeliling(${idPerpustakaanKeliling})" type="button">
                        <i class="fa fa-trash"></i>
                        Hapus
                    </button>
                </div>
            </div>
        `);
    $("#totalPerpustakaanKeliling").html(idPerpustakaanKeliling);
});

function hapusKomponenPerpustakaanKeliling(id) {
    $(`#PerpustakaanKeliling${id}`).remove();
    idPerpustakaanKeliling--;
    $("#totalPerpustakaanKeliling").html(idPerpustakaanKeliling);
}

let idHibahBuku = 0;
$("#tambahKomponenHibahBuku").click(function () {
    idHibahBuku++;
    const htmlJenisPerpustakaan = $("#komponentjenisperpustakaan").val();
    $("#komponenHibahBuku").append(`
            <div class="my-3 row align-items-end" id="HibahBuku${idHibahBuku}">
                <div class="col-sm-4 mb-2">
                    <label class="col-form-label" for="jenis_perpustakaan_hibah_buku${idHibahBuku}">
                        Jenis Perpustakaan <span class="text-danger">*</span>
                    </label>
                    <select name="jenis_perpustakaan_hibah_buku[]" id="jenis_perpustakaan_hibah_buku${idHibahBuku}" class="form-control" required>
                    ${htmlJenisPerpustakaan}
                    </select>
                </div>
                <div class="col-sm-4 mb-2">
                    <label class="col-form-label" for="nama_perpustakaan_hibah_buku${idHibahBuku}">
                        Nama Perpustakaan <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="nama_perpustakaan_hibah_buku[]" id="nama_perpustakaan_hibah_buku${idHibahBuku}"
                        placeholder="Masukan nama perpustakaan"
                        required>
                </div>  
                <div class="col-sm-2 mb-2">
                    <label class="col-form-label" for="jumlah_hibah_buku${idHibahBuku}">
                        Total Eksemplar <span class="text-danger">*</span>
                    </label>
                    <input type="number" class="form-control" name="jumlah_hibah_buku[]" id="jumlah_hibah_buku${idHibahBuku}"
                        value="0"
                        required>
                </div>
                <div class="col-sm-2 mb-2">
                    <button class="btn btn-danger" onclick="hapusKomponenHibahBuku(${idHibahBuku})" type="button">
                        <i class="fa fa-trash"></i>
                        Hapus
                    </button>
                </div>
            </div>
        `);
    $("#totalHibahBuku").html(idHibahBuku);
});

function hapusKomponenHibahBuku(id) {
    $(`#HibahBuku${id}`).remove();
    idHibahBuku--;
    $("#totalHibahBuku").html(idHibahBuku);
}

let idSilangLayan = 0;
$("#tambahKomponenSilangLayan").click(function () {
    idSilangLayan++;
    const htmlJenisPerpustakaan = $("#komponentjenisperpustakaan").val();
    $("#komponenSilangLayan").append(`
            <div class="my-3 row align-items-end" id="SilangLayan${idSilangLayan}">
                <div class="col-sm-4 mb-2">
                    <label class="col-form-label" for="jenis_perpustakaan_silang_layan${idSilangLayan}">
                        Jenis Perpustakaan <span class="text-danger">*</span>
                    </label>
                    <select name="jenis_perpustakaan_silang_layan[]" id="jenis_perpustakaan_silang_layan${idSilangLayan}" class="form-control" required>
                    ${htmlJenisPerpustakaan}
                    </select>
                </div>
                <div class="col-sm-4 mb-2">
                    <label class="col-form-label" for="nama_perpustakaan_silang_layan${idSilangLayan}">
                        Nama Perpustakaan <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="nama_perpustakaan_silang_layan[]" id="nama_perpustakaan_silang_layan${idSilangLayan}"
                        placeholder="Masukan nama perpustakaan"
                        required>
                </div>
                <div class="col-sm-2 mb-2">
                    <label class="col-form-label" for="jumlah_silang_layan${idSilangLayan}">
                        Total Eksemplar <span class="text-danger">*</span>
                    </label>
                    <input type="number" class="form-control" name="jumlah_silang_layan[]" id="jumlah_silang_layan${idSilangLayan}"
                        value="0"
                        required>
                </div>  
                <div class="col-sm-2 mb-2">
                    <button class="btn btn-danger" onclick="hapusKomponenSilangLayan(${idSilangLayan})" type="button">
                        <i class="fa fa-trash"></i>
                        Hapus
                    </button>
                </div>
            </div>
        `);
    $("#totalSilangLayan").html(idSilangLayan);
});

function hapusKomponenSilangLayan(id) {
    $(`#SilangLayan${id}`).remove();
    idSilangLayan--;
    $("#totalSilangLayan").html(idSilangLayan);
}
