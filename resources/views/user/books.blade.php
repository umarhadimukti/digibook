@extends('layouts.main')

@section('content')
    <div class="container py-4">
      {{-- container untuk input buku dan greeting text --}}
      <div class="row1 row">
        <div class="col-12 col-md-10">
          <form action="{{ route('user.dashboard.books') }}">
            <div class="input-wrapper">
              <input type="text" name="keyword" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Cari buku..." value="{{ request('keyword') }}">
              <ion-icon name="search-outline"></ion-icon>
              <button type="submit" hidden>Cari</button>
            </div>
          </form>
        </div>
        <div class="col-12 col-md-2">
          <span>Halo, Umar Hadi Mukti</span>
        </div>
      </div>

      @if (request('keyword') && !$books_filter->count())
        <div class="row">
          <div class="col-12 d-flex content-datanotfound">
            <img src="{{ asset('./img/notfound.jpg') }}" width="300" height="300" alt="">
          </div>
        </div>
      @else
        @if (request('keyword') && $books_filter->count())
          <div class="row2 row mt-4 content-search">
            <h5 class="fw-light fs-5 d-flex justify-content-start align-items-center gap-2">
              <ion-icon name="search-outline"></ion-icon>
              <span class="fw-bold">{{ request('keyword') }}</span>
            </h5>
            <!-- Slider main container -->
            <div class="swiper1">
              <!-- Additional required wrapper -->
              <div class="swiper-wrapper">
                @foreach ($books_filter as $book)
                <!-- Slides -->
                <a href="/dashboard/book/{{ $book->slug }}" class="swiper-slide">
                  <div class="wrapper-book">
                    <img src={{ $book->cover }}>
                    <div class="description">
                      <h5 class="text-dark">{{ $book->title }}</h5>
                      <small class="text-secondary fw-light">Dipost oleh {{ $book->user->name }}</small>
                      <div class="wrapper-rating d-flex justify-content-between align-items-center">
                        <ion-icon name="star"></ion-icon>
                        <small class="text-dark">{{ $book->rating }} / 5.0</small>
                      </div>
                      <p class="excerpt text-dark">{{ $book->excerpt }}</p>
                    </div>
                  </div>
                </a>
                @endforeach
              </div>
            </div>
          </div> 
        @endif
      @endif

      {{-- bagian buku terbaru --}}
      <div class="row2 row mt-4">
        <h4>Buku Terbaru</h4>
        <!-- Slider main container -->
        <div class="swiper1">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            @for ($i = 0; $i < 5; $i++)
            <!-- Slides -->
            <a href="/dashboard/book/{{ $books_latest[$i]->slug }}" class="swiper-slide">
              <div class="wrapper-book">
                <img src={{ $books_latest[$i]->cover }}>
                <div class="description">
                  <h5 class="text-dark">{{ $books_latest[$i]->title }}</h5>
                  <small class="text-secondary fw-light">Dipost oleh {{ $books_latest[$i]->user->name }}</small>
                  <div class="wrapper-rating d-flex justify-content-between align-items-center">
                    <ion-icon name="star"></ion-icon>
                    <small class="text-dark">{{ $books_latest[$i]->rating }} / 5.0</small>
                  </div>
                  <p class="excerpt text-dark">{{ $books_latest[$i]->excerpt }}</p>
                </div>
              </div>
            </a>
            @endfor
          </div>
        </div>
      </div>

      {{-- bagian semua buku --}}
      <div class="row3 row my-5">
        <h4>Semua Buku</h4>
          <!-- Slider main container -->
          <div class="swiper2">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
              @foreach ($books as $book)
              <!-- Slides -->
              <a href="/dashboard/book/{{ $book->slug }}" class="swiper-slide">
                <div class="wrapper-book">
                  <img src={{ $book->cover }}>
                </div>
              </a>
              @endforeach
            </div>
          </div>
      </div>
    </div>
@endsection