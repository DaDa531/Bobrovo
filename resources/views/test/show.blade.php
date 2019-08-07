@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - test
@endsection

@section('content')
<div class="container">

    <div class="row mb-1">
        <div class="col-sm-6 col-12">
            @includeWhen(session('errors'), 'layouts.errors')
            @includeWhen(session('success'), 'layouts.success', ['success' => session('success')])
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h1>Test {{ $test->name }}</h1>
        </div>

        <div class="col-md-6 text-right">
            @if (!$test->isSolved())
                <a href="{{ route('test.edit', $test->id) }}" class="d-inline mr-2">
                    <button class="btn btn-secondary px-4"><i class="fa fa-edit pr-2"></i>Upraviť</button>
                </a>
            @endif

            @if ($test->canDelete())
                <a href="{{ route('test.destroy', $test->id) }}" class="d-inline mr-2">
                    <button class="btn btn-danger px-4"><i class="fa fa-trash pr-2"></i>Zrušiť</button>
                </a>
            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Popis:</strong> {{ $test->description }}</p>
        </div>
        <div class="col-md-6">
            MOZNO DAT DO KARTY
            <p><strong>Dostupný popis testu:</strong> {{ $test->available_description}}</p>
            <p><strong>Náhodné poradie otázok:</strong> {{ $test->mix_questions}}</p>
            <p><strong>Dostupné správne riešenia:</strong> {{ $test->available_answers}}</p>
            <p><strong>Verejný:</strong> {{ $test->public}}</p>
        </div>
    </div>

    <div class="row"
        <div class="col-md-12">
            @if (count($test->groups) != 0)
                <h3>Priradenie testu skupinám</h3>
                <p> TO DO; STAV: ČAKAJÚCI - ak dátum začatia este nebol, zobraziť KOS, PRAVE RIESENY alebo VYRIESENY - možnosť pozrieť štatiskitky<br> NAZOV SKUPINY</p>
                <table class="table">
                <tr>
                    <th>Skupina</th>
                    <th>Dostupný od:</th>
                    <th>Dostupný do:</th>
                    <th>Čas na vypracovanie (min):</th>
                    <th>Stav</th>
                </tr>
                @foreach ($test->groups as $assignment)
                    <tr>
                        <td>{{ $assignment->pivot->group_id }}</td>
                        <td>{{ $assignment->pivot->available_from }}</td>
                        <td>{{ $assignment->pivot->available_to }}</td>
                        <td>{{ $assignment->pivot->time_to_do }}</td>
                        <td> čakajúci</td>
                    </tr>
                @endforeach
                </table>
            @endif
        </div>
    </div>

</div>
@endsection