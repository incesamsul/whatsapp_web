<!doctype html>
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec" prefix="og: http://ogp.me/ns#" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Qrcode Login</title>
    <script src="https://www.gstatic.com/firebasejs/8.8.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.8.0/firebase-database.js"></script>
    <link rel="stylesheet" href="{{ asset('css/scan.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/fontawesome-free/css/all.css') }}">


</head>

<body>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <div class="container-fluid bg-primary">
        <div class="row bg-black">


            <div class="col">
                <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

                <div class="col-sm-12 cam-vid-wrapper">
                    <video id="preview" class="p-1 border" style="width:100%;"></video>
                </div>

                <div class="cam-design-wrapper">
                </div>
                <div class="bottom-capt">
                    <h5><i class="fas fa-qrcode"></i> QRCODE LOGIN</h5>
                </div>
                <div class="cam-frame">
                    <h5><i class="fas fa-qrcode"></i> QRCODE LOGIN</h5>
                </div>

                <script type="text/javascript">
                    var scanner = new Instascan.Scanner({
                        video: document.getElementById('preview'),
                        scanPeriod: 5,
                        mirror: false
                    });
                    let username = @json(auth()->user()->username);
                    let password = @json(auth()->user()->password);
                    scanner.addListener('scan', function(content) {
                        console.log(content);
                        if(content.length !== 13){
                            alert('qrcode tidak valid');
                        } else {
                            $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/Qrcodelogin/public/ajax/login-qrcode',
                            data:{token:content,username:username,password:password},
                            method: 'post',
                            success: function(data){
                                console.log(data);
                                // alert("Login Berhasil ... ");
                                window.location.href = '/Qrcodelogin/public/kasir';

                            }
                        });
                        }
                        //window.location.href=content;
                    });
                    Instascan.Camera.getCameras().then(function(cameras) {
                        if (cameras.length > 0) {
                            scanner.start(cameras[1]);
                            $('[name="options"]').on('change', function() {
                                if ($(this).val() == 1) {
                                    if (cameras[0] != "") {
                                        scanner.start(cameras[0]);
                                    } else {
                                        alert('No Front camera found!');
                                    }
                                } else if ($(this).val() == 2) {
                                    if (cameras[1] != "") {
                                        scanner.start(cameras[1]);
                                    } else {
                                        alert('No Back camera found!');
                                    }
                                }
                            });
                        } else {
                            console.error('No cameras found.');
                            alert('No cameras found.');
                        }
                    }).catch(function(e) {
                        console.error(e);
                        alert(e);
                    });
                </script>
                {{-- <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                    <label class="btn btn-primary active">
					<input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
				  </label>
                    <label class="btn btn-secondary">
					<input type="radio" name="options" value="2" autocomplete="off"> Back Camera
				  </label>
                </div> --}}
            </div>




        </div>
    </div>

</body>

</html>
