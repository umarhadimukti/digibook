@extends('layouts.main')

@section('content')
    <div class="container py-4">
      {{-- container untuk input buku dan greeting text --}}
      <div class="row1 row">
        <div class="col-12 col-md-10">
          <form action="{{ route('user.dashboard.books') }}">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
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

      @if (request()->only('keyword') && count(request()->all()) == 1 && !$books_filter->count())
        <div class="row">
          <h5>Buku yang dicari tidak ada</h5>
          <div class="col-12 d-flex content-datanotfound">
            <img src="{{ asset('./img/notfound.jpg') }}" width="300" height="300" alt="">
          </div>
        </div>
      @elseif (request()->only('keyword') && count(request()->all()) == 1 && $books_filter->count())
        <div class="row2 row mt-4 content-search">
          <h5 class="fw-light fs-5 d-flex justify-content-start align-items-center gap-2">
            @if (request('keyword') != '')
              <ion-icon name="search-outline"></ion-icon>  
            @endif
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

      @if (request()->only('category') && !$books_filter->count())
        <div class="row">
          <h5>Tidak ada buku di kategori <span class="fw-bold">{{ request('category') }}</span></h5>
          <div class="col-12 d-flex content-datanotfound">
            <img src="{{ asset('./img/notfound.jpg') }}" width="300" height="300" alt="">
          </div>
        </div>
      @else
        @if (request()->only('category') && $books_filter->count())
          {{-- bagian buku terbaru --}}
          <div class="row2 row mt-4">
            <h4>Kategori {{ request('category') }}</h4>
            <!-- Slider main container -->
            <div class="swiper1">
              <!-- Additional required wrapper -->
              <div class="swiper-wrapper">
                @for ($i = 0; $i < count($books_filter); $i++)
                <!-- Slides -->
                <a href="/dashboard/book/{{ $books_filter[$i]->slug }}" class="swiper-slide">
                  <div class="wrapper-book">
                    <img src={{ $books_filter[$i]->cover }}>
                    <div class="description">
                      <h5 class="text-dark">{{ $books_filter[$i]->title }}</h5>
                      <small class="text-secondary fw-light">Dipost oleh {{ $books_filter[$i]->user->name }}</small>
                      <div class="wrapper-rating d-flex justify-content-between align-items-center">
                        <ion-icon name="star"></ion-icon>
                        <small class="text-dark">{{ $books_filter[$i]->rating }} / 5.0</small>
                      </div>
                      <p class="excerpt text-dark">{{ $books_filter[$i]->excerpt }}</p>
                    </div>
                  </div>
                </a>
                @endfor
              </div>
            </div>
          </div> 
        @else
          {{-- bagian buku terbaru --}}
          <div class="row2 row mt-4">
            <h4>Buku Terbaru</h4>
            <!-- Slider main container -->
            <div class="swiper1">
              <!-- Additional required wrapper -->
              <div class="swiper-wrapper">
                @for ($i = 0; $i < count($books_categories); $i++)
                <!-- Slides -->
                <a href="/dashboard/book/{{ $books_categories[$i]->slug }}" class="swiper-slide">
                  <div class="wrapper-book">
                    <img src={{ $books_categories[$i]->cover }}>
                    <div class="description">
                      <h5 class="text-dark">{{ $books_categories[$i]->title }}</h5>
                      <small class="text-secondary fw-light">Dipost oleh {{ $books_categories[$i]->user->name }}</small>
                      <div class="wrapper-rating d-flex justify-content-between align-items-center">
                        <ion-icon name="star"></ion-icon>
                        <small class="text-dark">{{ $books_categories[$i]->rating }} / 5.0</small>
                      </div>
                      <p class="excerpt text-dark">{{ $books_categories[$i]->excerpt }}</p>
                    </div>
                  </div>
                </a>
                @endfor
              </div>
            </div>
          </div>    
        @endif
      @endif


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