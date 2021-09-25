// window.FlashMessage.success('Success', {
//     timeout: 1000,
//     interactive: false,
//     progress: true,
// });



$(document).ready(function() {

    let kondisi = false;
    let statuskerja = false;


    // mengatur animasi dan mengisi inputan data kondisi
    $('.icon-kondisi .icon-kondisi-items i').on('click', function(e) {
            if (document.querySelector('.icon-kondisi .icon-kondisi-items i.clicked') !== null) {
                document.querySelector('.icon-kondisi .icon-kondisi-items i.clicked').classList.remove('clicked');
            }
            e.target.classList.add('clicked');
            $('#inputkondisi').val($(this).data('kondisi'));
            if ($('#inputkondisi').val() !== "") {
                kondisi = true;
            }
            if (kondisi == true && statuskerja == true) {
                $('.tombolabsen').prop('disabled', false);
            }
        })
        // mengatur animasi dan mengisi inputan data status kerja
    $('.work-status-ilustration').on('click', function(e) {
        if (document.querySelector('.work-status-ilustration.clicked') !== null) {
            document.querySelector('.work-status-ilustration.clicked').classList.remove('clicked');
        }
        e.target.classList.add('clicked');
        $('#inputstatuskerja').val($(this).data('statuskerja'));
        if ($('#inputstatuskerja').val() !== "") {
            statuskerja = true;
        }

        if (kondisi == true && statuskerja == true) {
            $('.tombolabsen').prop('disabled', false);
        }

    });

    $('.tombolabsen').on('click', function(e) {
        let inputPosisi = $('#inputposisi').val();
        if (inputPosisi == "") {
            $('#ask-permission').addClass('show');
            e.preventDefault();
        }
    });


})