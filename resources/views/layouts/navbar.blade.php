<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('merchant') ? 'active' : '' }}" href="{{ route('merchant.index') }}">Merchants</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('product') ? 'active' : '' }}" href="{{ route('product.index') }}">Products</a>
          </li>
        </ul>
        <span class="navbar-text">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
          <button type="submit" class="btn btn-sm btn-danger">Logout</button>
          </form>
        </span>
      </div>
    </div>
</nav>