<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigiBook {{ $title ? "- {$title}" : "" }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('./css/book.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/swiper-bundle.min.css') }}">
  </head>
  <body>
    {{-- include navbar --}}
    @include('partials.navbar')

    <div class="container py-4">
      <div class="row1 row">
        <div class="col-12 col-md-3">
          <div class="wrapper-cover">
            <img src="{{ asset('storage/' . $book->cover) }}" alt="">
          </div>
        </div>
        <div class="col-12 col-md-8">
          <h4>{{ $book->title }}</h4>
          <small>Dipost oleh {{ $book->user->name }} | ({{ $book->created_at->diffForHumans() }}) | Kategori <a href="/dashboard?category={{ $book->category->slug }}" class="text-secondary text-decoration-none">{{ $book->category->name }}</a></small>
          <div class="wrapper-rating d-flex gap-2 justify-content-center align-items-center">
            <ion-icon name="star"></ion-icon>
            {{ $book->rating }} / 5.0
          </div>
          <div class="wrapper-download">
            <a href="/books-download/download?book={{ $book->book }}" class="btn btn-download">
              <ion-icon name="download-outline"></ion-icon>
              Download
            </a>
          </div>
          <p class="mt-3">{{ $book->description }}</p>
        </div>
      </div>
    </div>

    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- ion icons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    {{-- swiper js --}}
    <script src="{{ asset('./js/swiper-bundle.min.js') }}"></script>
  </body>
</html>