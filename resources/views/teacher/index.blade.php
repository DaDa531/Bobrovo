@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ
@endsection

@section('content')
<div class="container">
    <div class="row">

        <!-- Main content -->
        <div class="col-md-12">
            <section>
                <h1>Vitajte učiteľ {{ $currentUser->first_name }}</h1>

                <div class="alert alert-dark" role="alert">
                    <strong>aktuálne (30.1.2019)</strong>: pribudli otázky z ročníkov 2017/2018 a 2018/2019 vrátane interaktívnych otázok
                </div>

                <p>V tomto prostredí môžete:</p>

                <ul>
                    <li>prezerať úlohy súťaže iBobor zo všetkých doterajších ročníkov,</li>
                    <li>prezerať, vytvárať a upravovať testy pre svojich žiakov,</li>
                    <li>prezerať a vytvárať skupiny žiakov a priraďovať im testy,</li>
                    <li>komentovať a hodnotiť otázky,</li>
                    <li>diskutovať s ostatnými učiteľmi a tvorcami otázok súťaže iBobor.</li>
                </ul>

                <p>Veríme, že Vám toto prostredie bude prospešné.</p>

            </section>
        </div>

    </div>
</div>
@endsection