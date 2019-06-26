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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Úlohy</a>
                    <div class="dropdown-menu navbar-dark bg-primary">
                        <a class="dropdown-item" href="{{ route('tasks') }}">Zoznam úloh</a>
                        <a class="dropdown-item" href="{{ route('tasks.create') }}">Pridať úlohu</a>
                        <a class="dropdown-item" href="{{ route('tasks.my') }}">Moje úlohy</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Žiaci</a>
                    <div class="dropdown-menu navbar-dark bg-primary">
                        <a class="dropdown-item" href="{{ route('student') }}">Zoznam žiakov</a>
                        <a class="dropdown-item" href="{{ route('student.create') }}">Pridať žiaka</a>
                        <a class="dropdown-item" href="{{ route('student.import') }}">Importovať žiakov</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Skupiny</a>
                    <div class="dropdown-menu navbar-dark bg-primary">
                        <a class="dropdown-item" href="{{ route('group') }}">Zoznam skupín</a>
                        <a class="dropdown-item" href="{{ route('group.create') }}">Vytvoriť skupinu</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Testy</a>
                    <div class="dropdown-menu navbar-dark bg-primary">
                        <a class="dropdown-item" href="{{ route('test') }}">Zoznam testov</a>
                        <a class="dropdown-item" href="{{ route('test.create') }}">Vytvoriť test</a>
                    </div>
                </li>

            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Profil</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post" class="form-inline header-search-form my-2">
                        @csrf
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">ODHLÁSIŤ</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>