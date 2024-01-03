<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigiBook {{ $title ? "- {$title}" : "" }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('./css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/swiper-bundle.min.css') }}">
  </head>
  <body>
    {{-- include navbar --}}
    @include('partials.navbar')

    <div class="container py-4">
      <div class="row1 row">
        <h4>Kategori Buku</h4>
        <!-- Slider main container -->
        <div class="swiper1">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            @foreach ($categories as $category)
            <!-- Slides -->
            <a href="/dashboard?category={{ $category->slug }}" class="swiper-slide">
              <div class="wrapper-category">
                @if ($category->image)
                  <img src="{{ asset('storage/' . $category->image) }}" width="450" height="250">
                @else
                  <img src="https://source.unsplash.com/650x450?{{ $category->name }}">
                @endif
                <h4 class="text-center">{{ $category->name }}</h4>
              </div>
            </a>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
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