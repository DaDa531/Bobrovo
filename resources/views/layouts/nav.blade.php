<!-- Main navigation -->
<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container">

        <!-- Company name shown on mobile -->
        <a class="navbar-brand d-md-none d-lg-none d-xl-none" href="{{ url('/') }}">
            <img src="/img/logo-male.png" width="30" height="30" class="d-inline-block align-top mr-1" alt="Bobrovo logo">
        </a>

        <!-- Mobile menu toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Main navigation items -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}"><img src="/img/logo-male.png" width="25" height="25" class="d-inline-block align-top mr-1" alt="Bobrovo logo">BOBROVO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/ziak') }}">Žiak</a>
                </li>
            </ul>
	
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Prihlásenie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Registrácia</a>
                </li>
            </ul>

        </div>
    </div>
</nav>