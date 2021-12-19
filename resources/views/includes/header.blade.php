<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none me-4 text-uppercase fs-5">
          MegaTest
        </a>
        {{-- @class(['nav-link', 'px-2', 'text-white' => Route::not('home'), 'text-secondary' => Route::is('home')]) --}}
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{ route('home') }}" class="nav-link px-2 {{ (Route::is('home') ? 'text-secondary' : 'text-white') }}">Главная</a></li>
          <li><a href="{{ route('tests') }}" class="nav-link px-2 {{ (Route::is('tests') ? 'text-secondary' : 'text-white') }}">Тесты</a></li>
        </ul>

        <!--form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form-->

        <div class="text-end">
          <button type="button" class="btn btn-outline-light me-2">Войти</button>
          <button type="button" class="btn btn-warning">Регистрация</button>
        </div>
      </div>
    </div>
  </header>