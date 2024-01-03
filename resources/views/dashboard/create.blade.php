<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigiBook {{ $title ? "- {$title}" : "" }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('./img/logoround.png') }}">
    <link rel="stylesheet" href="{{ asset('./css/dashboard/create.css') }}">
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
          <h5 class="fw-bold mb-3">Tambah Buku Baru</h5>
          <form action="/dashboard-books/books" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
            </div>
            <div class="mb-3">
              <label for="title" class="form-label text-secondary">Judul Buku</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"  placeholder="Masukkan Judul Buku.." required value="{{ old('title') }}">
              @error('title')
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
              <label for="category_id" class="form-label text-secondary">Kategori</label>
              <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id" required>
                @foreach ($categories as $category)
                  @if (old('category_id') == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                  @endif
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <div class="form-floating">
                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi" id="description" name="description" required style="height: 150px;">{{ old('description') }}</textarea>
                <label for="description">Masukkan Deskripsi</label>
              </div>
              @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="jumlah" class="form-label text-secondary">Jumlah Buku</label>
              <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Buku.. (*angka)" min="1" required value="{{ old('jumlah') }}">
            </div>
            <div class="mb-3">
              <label for="rating" class="form-label text-secondary">Rating</label>
              <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" placeholder="Masukkan Rating Buku.. (*angka)" min="1" max="5" required value="{{ old('rating') }}">
              @error('rating')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="book" class="form-label text-secondary">Upload Buku (*pdf)</label>
              <input type="file" class="form-control @error('book') is-invalid @enderror" id="book" name="book" placeholder="Masukkan Buku.." required>
              @error('book')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="book" class="form-label text-secondary">Upload Cover Buku (*png, jpg, jpeg, svg)</label>
              <img class="img-fluid img-preview mb-3 col-sm-2 rounded shadow" alt="">
              <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" onchange="previewImage()" placeholder="Masukkan Cover Buku.." required>
              @error('cover')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <button type="submit" class="btn btn-tambah">Buat Buku</button>
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
      const title = document.querySelector('#title');
      const slug = document.querySelector('#slug');

      // ketika ada perubahan pada input title, kirim data title ke method checkslug lalu ambil data slug
      title.addEventListener('change', function() {
        fetch(`/dashboard-books/slug/check-slug?title=${title.value}`)
          .then(response => response.json())
          .then(data => slug.value = data.slug)
      });

      function previewImage() {
        const cover = document.querySelector('#cover');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(cover.files[0]);

        oFReader.onload = function(oFREvent) {
          imgPreview.src = oFREvent.target.result;
        }
      }
    </script>
  </body>
</html>