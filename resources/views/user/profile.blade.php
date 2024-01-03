<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigiBook {{ $title ? "- {$title}" : "" }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('./img/logoround.png') }}">
    <link rel="stylesheet" href="{{ asset('./css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/swiper-bundle.min.css') }}">
  </head>
  <body>
    {{-- include navbar --}}
    @include('partials.navbar')

    <div class="container py-4 mt-5">
      <div class="row1 row">
        <div class="col-12 col-md-4">
          <div class="wrapper-navigation-1">
            <div class="profile-card">
              <h5>{{ auth()->user()->name }}</h5>
              <h6 class="text-secondary">{{ auth()->user()->username }}</h6>
              <h6 class="text-secondary">{{ auth()->user()->email }}</h6>
              <h6 class="text-secondary">{{ auth()->user()->phone }}</h6>
            </div>
            <div class="navigation">
              <form action="{{ route('logout') }}" onsubmit="return confirm('Yakin ingin keluar?')" method="post">
                @csrf
                <button type="submit" class="btn btn-keluar">
                  <ion-icon name="log-out-outline"></ion-icon>
                  <span>Keluar</span>
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8 wrapper-navigation-2">
          <a href="{{ route('dashboard.books.books.index') }}" class="link-item">
            <ion-icon name="book-outline"></ion-icon>
            <h5>Daftar Buku</h5>
          </a>
          <a href="{{ route('dashboard.books.books.create') }}" class="link-item">
            <ion-icon name="add-circle-outline"></ion-icon>
            <h5>Tambah Buku</h5>
          </a>

          @if (auth()->user()->role_id == 1)
            <a href="{{ route('dashboard.categories.categories.index') }}" class="link-item">
              <ion-icon name="grid-outline"></ion-icon>
              <h5>Tambah Kategori</h5>
            </a>
            <a href="{{ route('user.dashboard.export') }}" class="link-item">
              <ion-icon name="add-circle-outline"></ion-icon>
              <h5>Export Semua Data Buku</h5>
            </a>
          @endif
        </div>
      </div>
    </div>

    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- ion icons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    {{-- swiper js --}}
    <script src="{{ asset('./js/swiper-bundle.min.js') }}"></script>
    {{-- script js --}}
    <script src="{{ asset('./js/categories.js') }}"></script>
  </body>
</html>