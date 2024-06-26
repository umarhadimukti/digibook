<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigiBook {{ $title ? "- {$title}" : "" }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('./img/logoround.png') }}">
    <link rel="stylesheet" href="{{ asset('./css/dashboard/book.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/swiper-bundle.min.css') }}">
  </head>
  <body>
    {{-- include navbar --}}
    @include('partials.navbar')

    <div class="container py-4 mt-3">
      <div class="row1 row gap-3">
        <div class="col-12 col-md-3">
          <div class="book-cover">
            <img src="{{ asset('storage/covers/'.$book->cover) }}" alt="">
          </div>
        </div>
        <div class="col-12 col-md-8">
          <div class="wrapper-description">
            <h4 class="fw-bold">{{ $book->title }}</h4>
            <small class="text-secondary">
              Dipost oleh {{ $book->user->name }} | ({{ $book->created_at->diffForHumans() }}) | Kategori
              <a href="/dashboard?category={{ $book->category->slug }}" class="text-black text-decoration-none">{{ $book->category->name }}</a>
            </small>
            <div class="wrapper-rating d-flex gap-2 justify-content-start align-items-center">
              <ion-icon name="star"></ion-icon>
              {{ $book->rating }} / 5.0
            </div>
            <div class="wrapper-aksi mt-3">
              <a href="{{ route('dashboard.books.books.edit', $book->slug) }}" class="btn btn-ubah text-decoration-none">
                <ion-icon name="create-outline" class="edit text-warning"></ion-icon>
                <span>ubah</span>
              </a>
              <form action="{{ route('dashboard.books.books.destroy', $book->id) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" onclick="return confirm('Apakah yakin ingin menghapus?')" class="btn-hapus">
                  <ion-icon name="trash-outline" class="delete text-danger fs-5"></ion-icon>
                  <span>hapus</span>
                </button>
              </form>
            </div>
            <p class="mt-4">{{ $book->description }}</p>
          </div>
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