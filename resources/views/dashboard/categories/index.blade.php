<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigiBook {{ $title ? "- {$title}" : "" }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('./css/dashboard/categories/index.css') }}">
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
          <h4 class="fw-bold">Daftar Kategori</h4>
          @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          @if ($categories->count())
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <td scope="col" class="text-center">No.</td>
                    <td scope="col" class="text-center">Nama Kategori</td>
                    <td scope="col" class="text-center">Aksi</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                    <tr>
                      <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                      <td class="text-center">{{ $category->name }}</td>
                      <td class="d-flex justify-content-center gap-3 aksi">
                        <a href="{{ route('dashboard.categories.categories.edit', $category->slug) }}" class="text-decoration-none">
                          <ion-icon name="create-outline" class="edit text-warning fs-5"></ion-icon>
                        </a>
                        <form action="{{ route('dashboard.categories.categories.destroy', $category->id) }}" method="post">
                          @method('delete')
                          @csrf
                          <button type="submit" onclick="return confirm('Apakah yakin ingin menghapus?')" class="btn-hapus">
                            <ion-icon name="trash-outline" class="delete text-danger fs-5"></ion-icon>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <h5 class="fw-bold mt-3">Tambah Kategori Baru</h5>
            <a href="{{ route('dashboard.categories.categories.create') }}" class="text-decoration-none btn btn-tambah border">
              Tambah Kategori
            </a>
          @else
            <div class="alert alert-danger text-center" role="alert">
              Kamu belum menambahkan kategori!
              <a href="{{ route('dashboard.categories.categories.create') }}" class="text-decoration-none">
                Tambah Kategori
              </a>
            </div>
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