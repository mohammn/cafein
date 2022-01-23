<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-lg-2">
                <h2 class="card-title">Laporan</h2>
                <label id="pesanError" class="badge badge-danger"></label>
            </div>
            <div class="col-lg-2">
                <select class="form-control" onChange="tampilkan()" id="jenisLaporan">
                    <option value="1" selected>Semua</option>
                    <option value="2">Menu</option>
                    <option value="3">Pelanggan</option>
                </select>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="pillInput">Tanggal</label>
                    <input type="date" class="form-control input-pill" id="tanggalMulai" onChange="tampilkan()" placeholder="Rp">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="pillInput">Sampai</label>
                    <input type="date" class="form-control input-pill" onChange="tampilkan()" id="tanggalSelesai" placeholder="Rp">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <p>Pemasukan :</p>
                    <h5 class="card-title" id="pemasukan">Rp. 0</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="tempatTabel">

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalRincian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Pesanan</h5>
            </div>
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white">Nama</span>
                                </div>
                                <input type="text" id="nama" class="form-control" disabled aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white">No Meja</span>
                                </div>
                                <input type="number" id="noMeja" class="form-control" disabled aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table text-center bg-white" id="dataTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jml</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="tabelRincian">
                        <td colspan="5">Memuat data....</td>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white">Rp.</span>
                                </div>
                                <input type="number" id="totalHarga" class="form-control" disabled aria-label="Amount (to the nearest dollar)" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="idTransaksi">
                <input type="hidden" id="statusTransaksi">
                <button type="button" class="btn btn-warning" onclick="tutupModalRincian()">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    settanggal()
    tampilkan()

    function settanggal() {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);

        $("#tanggalMulai").val(today)
        $("#tanggalSelesai").val(today)
    }

    function tampilkan() {
        // tampilkanChart()
        var tanggalMulai = $("#tanggalMulai").val()
        var tanggalSelesai = $("#tanggalSelesai").val()

        if (tanggalMulai > tanggalSelesai) {
            $("#pesanError").html("Tanggal Mulai tidak Boleh <br> Melebihi tanggal Selesai")
        } else {
            if ($("#jenisLaporan").val() == 1) {
                laporanSemua(tanggalMulai, tanggalSelesai);
            } else if ($("#jenisLaporan").val() == 2) {
                laporanMenu(tanggalMulai, tanggalSelesai)
            } else {
                laporanAntrian(tanggalMulai, tanggalSelesai)
            }
        }
    }

    function laporanSemua(tanggalMulai, tanggalSelesai) {
        $("#pesanError").html("")
        $("#tombolProses").html('<i class="fa fa-spinner fa-pulse"></i> Memproses...')

        var keuntungan = 0;
        var totalKeuntungan = 0;

        var tabel = '<table id="tabelLaporan" class="display table table-striped table-hover" ><thead><tr><th>NO</th><th>TANGGAL</th><th>NAMA</th><th>HARGA</th><th>JUMLAH</th><th>TOTAL</th><th>KARYAWAN</th></tr></thead><tbody>'


        $.ajax({
            url: '<?= base_url() ?>/laporan/laporanSemua',
            method: 'post',
            data: "tanggalMulai=" + tanggalMulai + "&tanggalSelesai=" + tanggalSelesai,
            dataType: 'json',
            success: function(data) {
                for (let i = 0; i < data.length; i++) {
                    keuntungan = (data[i].harga * data[i].jumlah)
                    totalKeuntungan += keuntungan
                    tabel += '<tr>'
                    tabel += '<td>' + (i + 1) + '</td>'
                    tabel += '<td>' + data[i].tanggal + '</td>'
                    tabel += '<td>' + data[i].namaMenu + '</td>'
                    tabel += '<td>' + formatRupiah(data[i].harga) + '</td>'
                    tabel += '<td>' + data[i].jumlah + '</td>'
                    tabel += '<td>' + formatRupiah((data[i].harga * data[i].jumlah).toString()) + '</td>'
                    tabel += '<td>' + data[i].namaUser + '</td>'
                    tabel += '</tr>'
                }

                if (data.length == 0) {
                    tabel += "<td colspan='7' class='text-center'>Data Masih Kosong</td>"
                }
                tabel += '</tbody></table>'
                $("#tempatTabel").html(tabel)
                $("#pemasukan").html('Rp. ' + formatRupiah(totalKeuntungan.toString()))

                // $('#tabelLaporan').DataTable({
                //     "pageLength": 10,
                // });
            }
        });
    }

    function laporanMenu(tanggalMulai, tanggalSelesai) {
        $("#pesanError").html("")

        var keuntungan = 0;
        var totalKeuntungan = 0;

        var tabel = '<table id="tabelLaporan" class="display table table-striped table-hover" ><thead><tr><th>NO</th><th>NAMA</th><th>HARGA</th><th>JUMLAH</th><th>TOTAL</th></tr></thead><tbody>'


        $.ajax({
            url: '<?= base_url() ?>/laporan/laporanMenu',
            method: 'post',
            data: "tanggalMulai=" + tanggalMulai + "&tanggalSelesai=" + tanggalSelesai,
            dataType: 'json',
            success: function(data) {
                for (let i = 0; i < data.length; i++) {
                    keuntungan = (data[i].harga * data[i].jumlah)
                    totalKeuntungan += keuntungan
                    tabel += '<tr>'
                    tabel += '<td>' + (i + 1) + '</td>'
                    tabel += '<td>' + data[i].nama + '</td>'
                    tabel += '<td>' + formatRupiah(data[i].harga) + '</td>'
                    tabel += '<td>' + data[i].jumlah + '</td>'
                    tabel += '<td>' + formatRupiah((data[i].harga * data[i].jumlah).toString()) + '</td>'
                    tabel += '</tr>'
                }

                if (data.length == 0) {
                    tabel += "<td colspan='7' class='text-center'>Data Masih Kosong</td>"
                }
                tabel += '</tbody></table>'
                $("#tempatTabel").html(tabel)
                $("#pemasukan").html('Rp. ' + formatRupiah(totalKeuntungan.toString()))
            }
        });
    }

    function laporanAntrian(tanggalMulai, tanggalSelesai) {
        $("#pesanError").html("")

        var keuntungan = 0;
        var totalKeuntungan = 0;

        var tabel = '<table id="tabelLaporan" class="display table table-striped table-hover" ><thead><tr><th>NO</th><th>NAMA</th><th>NO. MEJA</th><th>JUMLAH PESANAN</th><th>PEMBAYARAN</th><th>RINCIAN</th></tr></thead><tbody>'

        $.ajax({
            url: '<?= base_url() ?>/laporan/laporanAntrian',
            method: 'post',
            data: "tanggalMulai=" + tanggalMulai + "&tanggalSelesai=" + tanggalSelesai,
            dataType: 'json',
            success: function(data) {
                for (let i = 0; i < data.length; i++) {
                    totalKeuntungan += data[i].pembayaran
                    tabel += '<tr>'
                    tabel += '<td>' + (i + 1) + '</td>'
                    tabel += '<td>' + data[i].nama + '</td>'
                    tabel += '<td>' + data[i].noMeja + '</td>'
                    tabel += '<td>' + data[i].jumlahPesan + '</td>'
                    tabel += '<td>' + formatRupiah(data[i].pembayaran.toString()) + '</td>'
                    tabel += "<td><button href='#' class='btn btn-inverse-success btn-sm' onClick='tampilkanRincian(" + data[i].id + ",\"" + data[i].nama + "\", \"" + data[i].noMeja + "\")'><i class='mdi mdi-format-list-bulleted-type'></i><i class='mdi mdi-food-fork-drink'></i></button></td>"
                    tabel += '</tr>'
                }
                if (data.length == 0) {
                    tabel += "<td colspan='7' class='text-center'>Data Masih Kosong</td>"
                }
                tabel += '</tbody></table>'
                $("#tempatTabel").html(tabel)
                $("#pemasukan").html('Rp. ' + formatRupiah(totalKeuntungan.toString()))
            }
        });
    }

    function tampilkanRincian(id, nama, noMeja) {
        $("#nama").val(nama)
        $("#noMeja").val(noMeja)
        var isiPesanan = ""
        var totalHarga = 0
        $.ajax({
            url: '<?= base_url() ?>/antrian/rincianPesanan',
            method: 'post',
            data: "idAntrian=" + id,
            dataType: 'json',
            success: function(data) {
                if (data) {
                    for (let i = 0; i < data.length; i++) {
                        totalHarga += data[i].harga * data[i].jumlah
                        isiPesanan += "<tr><td>" + data[i].nama + "</td><td>" + data[i].jumlah + "</td><td>" + formatRupiah(data[i].harga.toString()) + "</td><td>" + formatRupiah((data[i].harga * data[i].jumlah).toString()) + "</td></tr>"
                    }
                } else {
                    isiPesanan = "<td colspan='4'>Antrian Masih Kosong :)</td>"
                }
                $("#tabelRincian").html(isiPesanan)
                $("#totalHarga").val(formatRupiah(totalHarga.toString()))

                $("#modalRincian").modal("show")
            }
        });
    }

    function tutupModalRincian() {
        $("#modalRincian").modal("hide")
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<?php $this->endSection() ?>