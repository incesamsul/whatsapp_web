<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>gumbang food!</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row login-wrapper">
            <div class="col-sm-4 p-5 login-form-wrapper">
                <div class="mb-4"><h4>Gumbang Food</h4></div>
                <div class="mb-3">
                    <form action="{{ URL::to('/postlogin') }}" method="POST">
                        @csrf
                        @if (session('fail'))
                        <p class="text-danger">{{ session('fail') }}</p>
                        @endif
                    <label for="username" class="form-label text-secondary fw-bold small">Username atau Email</label>
                    <input autocomplete="off" type="username" class="form-custom" id="username" placeholder="" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-secondary fw-bold small">Kata Sandi</label>
                    <input autocomplete="off" type="password" class="form-custom" id="password" placeholder="" name="password">
                </div>
                <div class="mb-3">
                    <button class="btn-custom bg-main">Masuk</button>
                </form>
                </div>
                <div class="text-help">
                    <p class="text-secondary text-center fs-small">Login mengunakan <a href="{{ URL::to('/') }}">Qrcode ?</a></p>
                </div>
            </div>
            <div class="col-sm-8 login-ilustration-wrapper bg text-main">
                <h4>Gumbang Food</h4>
                <p class="mb-5">Dapatkan persediaan makanan beku dengan mudah hanya di Gumbang food</p>
                <img src="{{ asset('img/ilustration_icon/food.svg') }}" alt="" width="500">
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
