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
                <button type="button" class="btn btn-danger px-4" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-lg fa-trash pr-3"></i>Zrušiť
                </button>

                @include('group.modal')
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
                    @foreach ($test_assignments as $assignment)
                        <tr>
                            <td><a href="{{ route('test.show', $assignment->test->id) }}">{{$assignment->test->name}}</a></td>
                            <td>{{ $assignment->available_from}}</td>
                            <td>{{ $assignment->available_to}}</td>
                            <td>{{ $assignment->time_to_do}}</td>
                            <td>{{ $assignment->mix_questions ? 'áno' : 'nie' }}</td>
                            <td>{{ $assignment->available_answers ? 'áno' : 'nie' }}</td>
                            <td>
                                @if ($assignment->available_from > $time)
                                    <a href="{{ route('assignment.edit', $assignment->id) }}" title="Upraviť pridelenie"><i class="fa fa-edit"></i></a>

                                    <form action="{{ route('assignment.destroy', $assignment->id) }}" method="post" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-trash px-4 py-0" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                @elseif ($assignment->available_to < $time)
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