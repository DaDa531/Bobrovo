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
                    <a class="nav-link" href="ulohy.html">Úlohy</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Testy</a>
                    <div class="dropdown-menu navbar-dark bg-primary">
                        <a class="dropdown-item" href="examples.html">Vyriešené testy</a>
                        <a class="dropdown-item" href="three-column.html">Pripravené testy</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Odhlásiť</a>
                </li>
            </ul>

        </div>
    </div>
</nav>