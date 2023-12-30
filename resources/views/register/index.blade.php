<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigiBook {{ $title ? "- {$title}" : "" }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('./css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/swiper-bundle.min.css') }}">
  </head>
  <body>

    <div class="container py-4">
      <div class="row1 row">
        <div class="col-12 col-md-6 container-image-login">
          <img src={{ asset('./img/loginimage.svg') }} width="460" alt="">
        </div>
        <div class="col-12 col-md-6 container-login">
          <div class="wrapper-login d-flex flex-column justify-content-start">
            <img src="{{ asset('./img/logo.svg') }}" width="300" alt="">
            <div class="text-login">
              <p class="text-secondary">Telusuri buku yang sedang populer dan dapatkan pengetahuan di dalam hidup kamu</p>
            </div>
            <form method="POST" class="form-login" action="{{ route('register') }}">
              @csrf
              <div>
                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Nama Lengkap">
              </div>
              <div>
                <input type="email" name="email" class="form-control" id="email" placeholder="Alamat Email">
              </div>
              <div>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
              </div>
              <div>
                <input type="password" name="password2" class="form-control" id="password2" placeholder="Konfirmasi Password">
              </div>
              <button type="submit" name="login" class="btn btn-register">Daftar Akun</button>
              <a href="{{ route('login') }}" class="btn btn-to-login">Masuk</a>
            </form>
          </div>
        </div>
      </div>
      <p class="text-center text-secondary">&copy; 2023. Umar Hadi Mukti. Digital Book</p
    </div>

    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- ion icons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    {{-- swiper js --}}
    <script src="{{ asset('./js/swiper-bundle.min.js') }}"></script>
    {{-- script js --}}
    {{-- <script src="{{ asset('./js/categories.js') }}"></script> --}}
  </body>
</html>