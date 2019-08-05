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
            <a href="{{ route('test.edit', $test->id) }}" class="d-inline mr-2">
                <button class="btn btn-secondary px-4"><i class="fa fa-edit pr-2"></i>Upraviť</button>
            </a>

            @if ($test->canDelete())
                <a href="{{ route('test.destroy', $test->id) }}" class="d-inline mr-2">
                    <button class="btn btn-danger px-4"><i class="fa fa-trash pr-2"></i>Zrušiť</button>
                </a>
            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Skupina:</strong> {{ $test->group_id }}</p>
            <p><strong>Popis:</strong> {{ $test->description }}</p>
            <p><strong>Dosupný od:</strong> {{ $test->available_from }}</p>
            <p><strong>Dosupný do:</strong> {{ $test->available_to }}</p>
            <p><strong>Čas na vypracovanie:</strong> {{ $test->time_to_do }} min.</p>
        </div>
        <div class="col-md-6">
            <h2>Nastavenia</h2>
            <p><strong>Dostupný popis testu:</strong> {{ $test->available_description}}</p>
            <p><strong>Náhodné poradie otázok:</strong> {{ $test->mix_questions}}</p>
            <p><strong>Dostupné správne riešenia:</strong> {{ $test->available_answers}}</p>
            <p><strong>Verejný:</strong> {{ $test->public}}</p>

        </div>
    </div>

</div>
@endsection