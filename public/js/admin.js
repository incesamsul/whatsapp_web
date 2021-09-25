$(document).ready(function() {




    // datatable
    $("#table1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": [{
                    extend: 'excel',
                    // text: 'Export excel data absen',
                    // className: 'btn btn-default',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'print',
                    // className: 'btn btn-default',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }, "colvis"
            ]
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');

    // edit data user
    $('#table1 tbody').on('click', 'tr td a.edit', function(e) {
        e.preventDefault();
        let dataEdit = $(this).data('edit');
        $('#modalUserLabel').html("Ubah User");
        $('#nama').val(dataEdit.name);
        $('#name').val(dataEdit.nama);
        $('#nohp').val(dataEdit.nohp);
        $('#alamat').val(dataEdit.alamat);
        $('#email').val(dataEdit.email);
        $('#satuan').val(dataEdit.satuan);
        $('#kategori').val(dataEdit.kategori);
        $('#barcode').val(dataEdit.barcode);
        $('#harga').val(dataEdit.harga);
        $('#stok').val(dataEdit.stok);
        $('#nama_produk').val(dataEdit.nama_produk);
        $('#jumlah').val(dataEdit.jumlah);
        $('#keterangan').val(dataEdit.keterangan);
        $('#tanggal').val(dataEdit.tanggal);
        $('#id_user').val(dataEdit.id);
        $('#btn-modal-user').html('Ubah User');
        $('#btn-modal').html('Ubah data');
        if ($('.judul-halaman').html() == 'Data Pelanggan') {
            $('#form').attr('action', 'ubah-pelanggan')
        } else if ($('.judul-halaman').html() == 'Data suplier') {
            $('#form').attr('action', 'ubah-suplier')
        } else if ($('.judul-halaman').html() == 'Data satuan') {
            $('#form').attr('action', 'ubah-satuan')
        } else if ($('.judul-halaman').html() == 'Data kategori') {
            $('#form').attr('action', 'ubah-kategori')
        } else if ($('.judul-halaman').html() == 'Data produk') {
            $('#form').attr('action', 'ubah-produk')
        } else if ($('.judul-halaman').html() == 'Data stok masuk') {
            $('#form').attr('action', 'ubah-stok_masuk')
        } else if ($('.judul-halaman').html() == 'Data stok keluar') {
            $('#form').attr('action', 'ubah-stok_keluar')
        } else if ($('.judul-halaman').html() == 'Data transaksi') {
            $('#form').attr('action', 'ubah-transaksi')
        }
        $('#form-user').attr('action', 'ubah-user')

    });

    // hapus data user
    $('#table1 tbody').on('click', 'tr td a.hapus', function(e) {
        e.preventDefault();
        let idUser = $(this).data('iduser');
        console.log(idUser);
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mr-2',
                cancelButton: 'btn btn-danger ml-2'
            },
            // buttonsStyling: false
        })

        let route = 'hapus-user';
        let routeBack = 'managementuser';
        if ($('.judul-halaman').html() == 'Data Pelanggan') {
            route = 'hapus-pelanggan';
            routeBack = 'pelanggan';
        } else if ($('.judul-halaman').html() == 'Data suplier') {
            route = 'hapus-suplier';
            routeBack = 'suplier';
        } else if ($('.judul-halaman').html() == 'Data satuan') {
            route = 'hapus-satuan';
            routeBack = 'satuan-produk';
        } else if ($('.judul-halaman').html() == 'Data kategori') {
            route = 'hapus-kategori';
            routeBack = 'kategori-produk';
        } else if ($('.judul-halaman').html() == 'Data produk') {
            route = 'hapus-produk';
            routeBack = 'produk';
        } else if ($('.judul-halaman').html() == 'Data stok masuk') {
            route = 'hapus-stok_masuk';
            routeBack = 'stok-masuk';
        } else if ($('.judul-halaman').html() == 'Data stok keluar') {
            route = 'hapus-stok_keluar';
            routeBack = 'stok-keluar';
        } else if ($('.judul-halaman').html() == 'Data transaksi') {
            route = 'hapus-transaksi';
            routeBack = 'transaksi';
        }
        swalWithBootstrapButtons.fire({
            title: 'Apakah anda yakin?',
            text: "Data tidak bisa kembali lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus saja!',
            cancelButtonText: 'No, batal!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    "headers": { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
                    url: '/Qrcodelogin/public/admin/' + route,
                    method: 'post',
                    data: { idUser: idUser },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire(
                                'Selamat!',
                                'Data berhasil di hapus!',
                                'success'
                            )
                            setTimeout(() => {
                                document.location.href = '/Qrcodelogin/public/admin/' + routeBack;
                            }, 500);
                        }
                    }
                });
                swalWithBootstrapButtons.fire(
                    'terhapus!',
                    'file anda sudah terhapus.',
                    'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    });

    // tambah data user
    $('#btn-tambah-user').on('click', function() {
        $('#form-user').attr('action', 'tambah-user')
        $('#modalUserLabel').html("Tambah User");
        $('#nama').val("");
        $('#email').val("");
    });

    // filter data laporan harian
    $('#btn-laporan-harian').on('click', function(e) {
        e.preventDefault();
        document.location.href = '/admin/laporan-harian/' + $('#input-date-laporan-harian').val();
    });
    // filter data laporan per pegawai
    $('#btn-laporan-perpegawai').on('click', function(e) {
        e.preventDefault();
        document.location.href = '/admin/laporan-perpegawai/' + $('#input-laporan-perpegawai').val();
    });

    // filter data laporan perbulan
    $('#btn-laporan-bulanan').on('click', function(e) {
        e.preventDefault();
        document.location.href = '/admin/laporan-bulanan/' + $('#input-laporan-bulanan').val();
    });

    // filter chart data absensi bulanan
    $('#btn-chart-bulanan').on('click', function(e) {
        e.preventDefault();
        document.location.href = '/admin/dashboard/chart-bulanan/' + $('#input-chart-bulanan').val();
    });

    // filter chart data absensi tahunan
    $('#btn-chart-tahunan').on('click', function(e) {
        e.preventDefault();
        document.location.href = '/admin/dashboard/chart-tahunan/' + $('#input-chart-tahunan').val();
    });

    // tombol detail absen
    $('#table1 tbody').on('click', 'tr td button.btn-detail-absen', function() {
        let dataAbsen = $(this).data('detailabsen');
        // console.log(dataAbsen);
        let checkin = dataAbsen.checkin;
        let lapor_posisi_1 = dataAbsen.lapor_posisi_1;
        let lapor_posisi_2 = dataAbsen.lapor_posisi_2;
        let checkout = dataAbsen.checkout;
        $('#modalDetailLabel').html("Detail Absen " + dataAbsen.user.name);
        // segment checkin
        $('#lokasi-checkin').html(dataAbsen.posisi_checkin);
        $('#kordinat-checkin').html("<b>Latitude</b> : " + dataAbsen.latitude_checkin + " Dan <b>Longitude : </b> " + dataAbsen.longitude_checkin);
        $('#kondisi-dan-waktu-checkin').html("Melakukan Checkin pada <b>" + checkin + "</b> Dengan kondisi <b>" + dataAbsen.kondisi_checkin + "</b> dan Status kerja <b>" + dataAbsen.status_kerja_checkin + "</b>");

        // segment lapor posisi 1
        (!dataAbsen.posisi_lapor_posisi_1) ? $('#lokasi-lapor-posisi-pertama').html("<p class='text-danger'>Belum melakukan lapor posisi pertama</p>"): $('#lokasi-lapor-posisi-pertama').html(dataAbsen.posisi_lapor_posisi_1);
        (!dataAbsen.posisi_lapor_posisi_1) ? $('#kordinat-lapor-posisi-pertama').html("<p class='text-danger'>Belum melakukan lapor posisi pertama</p>"): $('#kordinat-lapor-posisi-pertama').html("<b>Latitude</b> : " + dataAbsen.latitude_lapor_posisi_1 + " Dan <b>Longitude : </b> " + dataAbsen.longitude_lapor_posisi_1);
        (!dataAbsen.posisi_lapor_posisi_1) ? $('#kondisi-dan-waktu-lapor-posisi-pertama').html("<p class='text-danger'>Belum Melakukan lapor posisi 1</p>"): $('#kondisi-dan-waktu-lapor-posisi-pertama').html("Melakukan lapor posisi 1 pada <b>" + lapor_posisi_1 + "</b> Dengan kondisi <b>" + dataAbsen.kondisi_lapor_posisi_1 + "</b>" + "</b> dan Status kerja <b>" + dataAbsen.status_kerja_lapor_posisi_1 + "</b>");

        // segment lapor posisi 2
        (!dataAbsen.posisi_lapor_posisi_2) ? $('#lokasi-lapor-posisi-kedua').html("<p class='text-danger'>Belum melakukan lapor posisi kedua</p>"): $('#lokasi-lapor-posisi-kedua').html(dataAbsen.posisi_lapor_posisi_2);
        (!dataAbsen.posisi_lapor_posisi_1) ? $('#kordinat-lapor-posisi-kedua').html("<p class='text-danger'>Belum melakukan lapor posisi kedua</p>"): $('#kordinat-lapor-posisi-kedua').html("<b>Latitude</b> : " + dataAbsen.latitude_lapor_posisi_2 + " Dan <b>Longitude : </b> " + dataAbsen.longitude_lapor_posisi_2);
        (!dataAbsen.posisi_lapor_posisi_2) ? $('#kondisi-dan-waktu-lapor-posisi-kedua').html("<p class='text-danger'>Belum Melakukan lapor posisi 2</p>"): $('#kondisi-dan-waktu-lapor-posisi-kedua').html("Melakukan lapor posisi 2 pada <b>" + lapor_posisi_2 + "</b> Dengan kondisi <b>" + dataAbsen.kondisi_lapor_posisi_2 + "</b>" + "</b> dan Status kerja <b>" + dataAbsen.status_kerja_lapor_posisi_2 + "</b>");

        // segment checkout
        (!checkout) ? $('#lokasi-checkout').html("<p class='text-danger'>Belum melakukan checkout</p>"): $('#lokasi-checkout').html(dataAbsen.posisi_checkout);
        (!checkout) ? $('#kordinat-checkout').html("<p class='text-danger'>Belum melakukan checkout</p>"): $('#kordinat-checkout').html("<b>Latitude</b> : " + dataAbsen.latitude_checkout + " Dan <b>Longitude : </b> " + dataAbsen.longitude_checkout);
        (!checkout) ? $('#kondisi-dan-waktu-checkout').html("<p class='text-danger'>Belum Melakukan checkout</p>"): $('#kondisi-dan-waktu-checkout').html("Melakukan checkout pada <b>" + checkout + "</b> Dengan kondisi <b>" + dataAbsen.kondisi_checkout + "</b>" + "</b> dan Status kerja <b>" + dataAbsen.status_kerja_checkout + "</b>");
        // segment jumlah jam kerja

        if (!checkout) {
            if (!lapor_posisi_2) {
                if (!lapor_posisi_1) {
                    console.log(".... hanya melakukan checkou");
                } else {
                    $('#jml-jam-kerja').html(calculateTime(checkin, lapor_posisi_1).jam + " jam " + calculateTime(checkin, lapor_posisi_1).menit + " menit ");
                }
            } else {
                $('#jml-jam-kerja').html(calculateTime(checkin, lapor_posisi_2).jam + " jam " + calculateTime(checkin, lapor_posisi_2).menit + " menit ");
            }
        } else {
            $('#jml-jam-kerja').html(calculateTime(checkin, checkout).jam + " jam " + calculateTime(checkin, checkout).menit + " menit ");
        }
        // console.log(lapor_posisi_1);
        // console.log(lapor_posisi_2);
        // console.log(checkout);
    });

    function calculateTime(start, end) {

        let jamMulai = start.split(":")[0];
        let jamAkhir = end.split(":")[0];
        let menitMulai = start.split(":")[1];
        let menitAkhir = end.split(":")[1];
        if (menitMulai > menitAkhir) {
            menitAkhir = parseInt(menitAkhir) + 60;
            jamAkhir = parseInt(jamAkhir) - 1;
        }

        selisihJam = jamAkhir - jamMulai;
        selisihMenit = menitAkhir - menitMulai;
        return { jam: selisihJam, menit: selisihMenit };


    }



})
