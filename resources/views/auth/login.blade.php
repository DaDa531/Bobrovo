@extends('layouts.master')

@section('title')
    Bobrovo - prihlásenie
@endsection

@section('content')
<div class="container">
    <div class="row">
        <!-- prihlásenie ZIAK -->
        <div class="card-deck col-md-12">
            <div class="card cardz">
                <div class="card-body cardz">
                    <h1>ŽIAK</h1>
                    <p>Po prihlásení sa do prostredia žiak môže:</p>
                    <ul>
                        <li>prezerať úlohy súťaže iBobor zo všetkých doterajších ročníkov,</li>
                        <li>riešiť testy, ktoré mu priradil učiteľ,</li>
                        <li>pozerať si výsledky vyriešených testov.</li>
                    </ul>
                    <h2>Prihlásenie žiaka</h2>
                    <p>Na prihlásenie potrebuješ kód od učiteľa/ky informatiky.</p>
                    <!--<form id="studentlogin" method="POST" action="/action_page.php">
                        <div class="form-group">
                            <label for="kod">Kód:</label>
                            <input type="text" class="form-control" id="kod" placeholder="Zadaj kód" name="kod">
                        </div>
                        <button type="submit" class="btn btn-dark">Prihlásiť</button>
                    </form>-->
                </div>
            </div>

            <!-- prihlásenie UCITEL -->
            <div class="card cardo">
                <div class="card-body cardo">
                    <h1>UČITEĽ</h1>
                    <p>Po prihlásení sa do prostredia učiteľ môže:</p>
                    <ul>
                        <li>prezerať úlohy súťaže iBobor zo všetkých doterajších ročníkov,</li>
                        <li>prezerať, vytvárať a upravovať testy pre svojich žiakov,</li>
                        <li>prezerať a vytvárať skupiny žiakov a priraďovať im testy,</li>
                        <li>komentovať a hodnotiť otázky,</li>
                        <li>diskutovať s ostatnými učiteľmi a tvorcami otázok súťaže iBobor.</li>
                    </ul>

                    <h2>Prihlásenie učiteľa</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Heslo:</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-dark">Prihlásiť</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection