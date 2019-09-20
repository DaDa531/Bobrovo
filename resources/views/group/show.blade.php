@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - skupina {{ $group->name}}
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
            <h1>Skupina {{ $group->name}}</h1>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('student.pdf', $group->id) }}" class="d-inline mr-2">
                <button class="btn btn-secondary px-4"><i class="fa fa-lg fa-print pr-2"></i>Tlačiť kódy</button></a>

            <a href="{{ route('group.edit', $group->id) }}" class="d-inline mr-2">
                <button class="btn btn-secondary px-4"><i class="fa fa-lg fa-edit pr-2"></i>Upraviť</button></a>

            @if ($group->canDelete())
                <form action="{{ route('group.destroy', $group->id) }}" method="post" class="d-inline">
                    @csrf
                    <button class="btn btn-danger px-4" type="submit"><i class="fa fa-lg fa-trash pr-3"></i>Zrušiť</button>
                </form>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>
                <strong>Vytvorená:</strong> {{ $group->dateToString($group->created_at)}}<br>
                <strong>Popis:</strong> {{ $group->description}}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <h2>Žiaci v skupine ({{ count($students) }})</h2>
            @if (count($students)>0)
                <table class="table">
                    <tr>
                        <th>Meno a priezvisko</th>
                        <th>Kód</th>
                    </tr>
                @foreach ($students as $student)
                    <tr>
                        <td><a href="{{ route('student.show', $student->id) }}">{{$student->first_name}} {{$student->last_name}}</a></td>
                        <td>{{ $student->code }}</td>
                    </tr>
                @endforeach
                </table>
            @endif
        </div>
        <div class="col-md-8">
            <h2>Testy pridelené skupine ({{ count($test_assignments) }})</h2>
            @if (count($test_assignments)>0)
                <table class="table">
                    <tr>
                        <th>Názov</th>
                        <th>Dostupný od</th>
                        <th>Dostupný do</th>
                        <th>Časový<br> limit </th>
                        <th>Miešať<br> otázky</th>
                        <th>Zobraziť<br> výsledky</th>
                        <th>Akcie</th>
                    </tr>
                    @foreach ($test_assignments as $test)
                        <tr>
                            <td><a href="{{ route('test.show', $test->test->id) }}">{{$test->test->name}}</a></td>
                            <td>{{ $test->available_from}}</td>
                            <td>{{ $test->available_to}}</td>
                            <td>{{ $test->time_to_do}}</td>
                            <td>{{ $test->mixed_questions ? 'áno' : 'nie' }}</td>
                            <td>{{ $test->available_answers ? 'áno' : 'nie' }}</td>
                            <td>
                                @if ($test->available_from > $time)
                                    EDIT / DELETE
                                @elseif ($test->available_to < $time)
                                    VÝSLEDKY
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>Skupina nemá pridelené žiadne testy.</p>
            @endif

            <a href="{{ route('assignment.create', [0, $group->id]) }}" class="d-inline mr-2">
                <button class="btn btn-secondary px-4">Prideliť test</button></a>
        </div>
    </div>

</div>
@endsection