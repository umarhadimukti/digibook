<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigiBook {{ $title ? "- {$title}" : "" }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('./css/dashboard/categories/create.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/swiper-bundle.min.css') }}">
  </head>
  <body>
    {{-- include navbar --}}
    @include('partials.navbar')

    <div class="container py-4 mt-2">
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
          <h5 class="fw-bold mb-3">Tambah Kategori Baru</h5>
          <form action="{{ route('dashboard.categories.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label text-secondary">Nama Kategori</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  placeholder="Masukkan Nama Kategori.." required value="{{ old('name') }}">
              @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="slug" class="form-label text-secondary">Slug</label>
              <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Masukkan Slug.." required value="{{ old('slug') }}">
              @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="image" class="form-label text-secondary">Upload Gambar Kategori (*png, jpg, jpeg, svg)</label>
              <img class="img-fluid img-preview mb-3 col-sm-2 rounded shadow" alt="">
              <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()" required>
              @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <button type="submit" class="btn btn-tambah">Buat Kategori</button>
          </form>
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
    <script>
      const name = document.querySelector('#name');
      const slug = document.querySelector('#slug');

      // ketika ada perubahan pada input name, kirim data name ke method checkslug lalu ambil data slug
      name.addEventListener('change', function() {
        fetch(`/dashboard-categories/slug/check-slug?name=${name.value}`)
          .then(response => response.json())
          .then(data => slug.value = data.slug)
      });

      function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
          imgPreview.src = oFREvent.target.result;
        }
      }
    </script>
  </body>
</html>