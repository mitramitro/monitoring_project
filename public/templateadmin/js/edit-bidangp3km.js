let idPembinaanPerpustakaan = Number($("#count_pembinaan_perpustakaan").val());
$("#totalPembinaanPerpustakaan").html(idPembinaanPerpustakaan);
console.log(idPembinaanPerpustakaan);
$("#tambahKomponenPembinaanPerpustakaan").click(function () {
    idPembinaanPerpustakaan++;
    const htmlJenisPerpustakaan = $("#komponentjenisperpustakaan").val();
    $("#komponenPembinaanPerpustakaan").append(`
            <div class="my-3 row align-items-end" id="PembinaanPerpustakaan${idPembinaanPerpustakaan}">
                <div class="col-sm-5 mb-2">
                    <label class="col-form-label" for="jenis_perpustakaan_pembinaan${idPembinaanPerpustakaan}">
                        Jenis Perpustakaan <span class="text-danger">*</span>
                    </label>
                    <select name="jenis_perpustakaan_pembinaan[]" id="jenis_perpustakaan_pembinaan${idPembinaanPerpustakaan}" class="form-control" required>
                    ${htmlJenisPerpustakaan}
                    </select>
                </div>
                <div class="col-sm-5 mb-2">
                    <label class="col-form-label" for="jenis_perpustakaan_pembinaan${idPembinaanPerpustakaan}">
                        Nama Perpustakaan <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="nama_perpustakaan_pembinaan[]" id="nama_perpustakaan_pembinaan${idPembinaanPerpustakaan}"
                        placeholder="Masukan nama perpustakaan"
                        required>
                </div>  
                <div class="col-sm-2 mb-2">
                    <button class="btn btn-danger" onclick="hapusKomponenPembinaanPerpustakaan(${idPembinaanPerpustakaan})" type="button">
                        <i class="fa fa-trash"></i>
                        Hapus
                    </button>
                </div>
            </div>
        `);
    $("#totalPembinaanPerpustakaan").html(idPembinaanPerpustakaan);
});

function hapusKomponenPembinaanPerpustakaan(id) {
    $(`#PembinaanPerpustakaan${id}`).remove();
    idPembinaanPerpustakaan--;
    $("#totalPembinaanPerpustakaan").html(idPembinaanPerpustakaan);
}

let idSafariLiterasi = Number($("#count_pembinaan_perpustakaan").val());
$("#totalSafariLiterasi").html(idSafariLiterasi);
$("#tambahKomponenSafariLiterasi").click(function () {
    idSafariLiterasi++;
    const htmlJenisPerpustakaan = $("#komponentjenisperpustakaan").val();
    $("#komponenSafariLiterasi").append(`
            <div class="my-3 row align-items-end" id="safariLiterasi${idSafariLiterasi}">
                <div class="col-sm-5 mb-2">
                    <label class="col-form-label" for="jenis_perpustakaan_safari${idSafariLiterasi}">
                        Jenis Perpustakaan <span class="text-danger">*</span>
                    </label>
                    <select name="jenis_perpustakaan_safari[]" id="jenis_perpustakaan_safari" class="form-control" required>
                    ${htmlJenisPerpustakaan}
                    </select>
                </div>
                <div class="col-sm-5 mb-2">
                    <label class="col-form-label" for="jenis_perpustakaan_safari${idSafariLiterasi}">
                        Nama Perpustakaan <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="nama_perpustakaan_safari[]" id="nama_perpustakaan_safari"
                        placeholder="Masukan nama perpustakaan"
                        required>
                </div>
                <div class="col-sm-2 mb-2">
                    <button class="btn btn-danger" onclick="hapusKomponenSafariLiterasi(${idSafariLiterasi})" type="button">
                        <i class="fa fa-trash"></i>
                        Hapus
                    </button>
                </div>
            </div>
        `);
    $("#totalSafariLiterasi").html(idSafariLiterasi);
});

function hapusKomponenSafariLiterasi(id) {
    $(`#safariLiterasi${id}`).remove();
    idSafariLiterasi--;
    $("#totalSafariLiterasi").html(idSafariLiterasi);
}
