<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gumbang Food</title>
    <script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
    <!-- <script defer src="/__/firebase/4.8.0/firebase-app.js"></script> -->
    <!-- include only the Firebase features as you need -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- <script defer src="/__/firebase/4.8.0/firebase-database.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <!-- initialize the SDK after all desired features are loaded -->
    <!-- <script defer src="/__/firebase/init.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/scan_login.css') }}">
</head>

<body>

    <div class="container-fluid">
        <div class="row login-wrapper">
            <div class="col-sm-4 p-5 login-form-wrapper">
                <div class="col-sm-12 instruction-wrapper ">
                    <img src="{{ asset('img/ilustration_icon/auth.svg') }}" alt="" width="300" class="mb-5" style="opacity: 0.8;">
                    <h4>Langkah-langkah masuk dengan QRCODE</h4>
                    <ol>
                        <li>Login ke aplikasi menggunakan Smartphone</li>
                        <li>pilih menu <i class="fas fa-bars"></i> dan pilih login QRCODE</li>
                        <li>Arahkan Scanner ke qrcode   </li>
                    </ol>
                    <a href="{{ URL::to('/login-biasa') }}">Login Biasa?</a>
                </div>
            </div>
            <div class="col-sm-8 login-ilustration-wrapper bg text-main">
                <h4>QRCODE LOGIN</h4>
                <p class="m-0">Scan qrcode di bawah ini setelah menggunakan Smartphone anda sesuai</p>
                <p class="mb-5"> dengan instruksi disamping</p>
                <div id="qrcode"></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('AdminLTE-3.1.0/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        let randval = "";
        let current_ref = null;
        let qrcode = new QRCode("qrcode",{
          colorDark: "#295353",
          colorLight: "#E1E2E5",
        });
        let tout;

        function loginCheck(){
            $.ajax({
                url: '/Qrcodelogin/public/ajax/qrcodeCheck',
                dataType: 'json',
                success: function(data){

                    if(!data){
                        console.log('tdk ada yg logn');
                    } else {
                        if(data.token == randval){
                            $.ajax({
                            url: '/Qrcodelogin/public/ajax/ajaxPostLogin',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method:'post',
                            data:{username:data.username,password:data.password},
                            success: function(data){
                                if(data == 1){
                                    // alert('what');
                                    location.reload();
                                }
                            }
                        })
                        document.body.innerHTML = "loading";
                        clearTimeout(tout);
                        }
                    }
                }
            });
            tout = setTimeout(loginCheck, 1000 * 1);
        }

        function refreshQRCode() {
            randval = Math.random().toString(16).slice(2);
            qrcode.makeCode(randval);
            tout = setTimeout(refreshQRCode, 1000 * 10);
        }
        $(document).ready(function() {
            $(".profile").hide();
            loginCheck();
            refreshQRCode();
        });
    </script>

</body>


</html>
