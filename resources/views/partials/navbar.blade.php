<nav class="navbar navbar-expand-lg bg-body-tertiary py-4">
  <div class="container d-flex flex-row gap-5 justify-content-between">
    <img src="{{ asset('./img/logo.svg') }}" alt="">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav d-flex w-50 justify-content-around">
        <a class="nav-link d-flex align-items-center gap-1 {{ $active == 'books' ? 'active border-bottom border-dark' : '' }}" href="{{ route('user.dashboard.books') }}">
          <ion-icon name="home-outline"></ion-icon>
          <span>Dashboard</span>
        </a>
        <a class="nav-link d-flex align-items-center gap-1 {{ $active == 'categories' ? 'active border-bottom border-dark' : '' }}" href="{{ route('user.dashboard.categories') }}">
          <ion-icon name="albums-outline"></ion-icon>
          <span>Kategori</span>
        </a>
        <a class="nav-link d-flex align-items-center gap-1 {{ $active == 'profile' ? 'active border-bottom border-dark' : '' }}" href="{{ route('user.dashboard.profile') }}">
          <ion-icon name="person-outline"></ion-icon>
          <span>Profil Saya</span>
        </a>
      </div>
    </div>
  </div>
</nav>