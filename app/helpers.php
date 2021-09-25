<?php


function sweetAlert($pesan, $tipe)
{
    echo '<script>document.addEventListener("DOMContentLoaded", function() {
        Swal.fire(
            "' . $pesan . '",
            "proses berhasil di lakukan",
            "' . $tipe . '",
        );
    })</script>';
}

function numberToMonth($number)
{
    $strBln = '';
    switch ($number) {
        case 1:
            $strBln = "januari";
            break;
        case 2:
            $strBln = "Februari";
            break;
        case 3:
            $strBln = "Maret";
            break;
        case 4:
            $strBln = "April";
            break;
        case 5:
            $strBln = "Mei";
            break;
        case 6:
            $strBln = "Juni";
            break;
        case 7:
            $strBln = "Juli";
            break;
        case 8:
            $strBln = "Agustus";
            break;
        case 9:
            $strBln = "September";
            break;
        case 10:
            $strBln = "Oktober";
            break;
        case 11:
            $strBln = "November";
            break;
        case 12:
            $strBln = "Desember";
            break;
    }
    return $strBln;
}
