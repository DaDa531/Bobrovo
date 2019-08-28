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
            <a href="{{ route('group.edit', $group->id) }}" class="d-inline mr-2">
                <button class="btn btn-secondary px-4"><i class="fa fa-edit pr-2"></i>Upraviť</button>
            </a>

            @if ($group->canDelete())
                <a href="{{ route('group.destroy', $group->id) }}" class="d-inline mr-2">
                    <button class="btn btn-danger px-4"><i class="fa fa-trash pr-2"></i>Zrušiť</button>
                </a>
            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>TO DO: TLAČ ZOZNAMU ŽIAKOV S KÓDMI</p>
            <p><strong>Vytvorená:</strong> {{ $group->dateToString($group->created_at)}}</p>
            <p><strong>Popis:</strong> {{ $group->description}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3>Žiaci v skupine ({{ count($students) }})</h3>
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
            <h3>Testy pridelené skupine ({{ count($tests) }})</h3>
            @if (count($tests)>0)
                <table class="table">
                    <tr>
                        <th>Názov</th>
                        <th>Miešať<br> otázky</th>
                        <th>Zobraziť<br> výsledky</th>
                        <th>Dostupný od</th>
                        <th>Dostupný do</th>
                        <th>Časový<br> limit </th>
                        <th>Akcie</th>
                    </tr>
                    @foreach ($tests as $test)
                        <tr>
                            <td><a href="{{ route('test.show', $test->id) }}">{{$test->name}}</a></td>
                            <td>{{ $test->pivot->mixed_questions ? 'áno' : 'nie' }}</td>
                            <td>{{ $test->pivot->available_answers ? 'áno' : 'nie' }}</td>
                            <td>{{ $test->pivot->available_from}}</td>
                            <td>{{ $test->pivot->available_to}}</td>
                            <td>{{ $test->pivot->time_to_do}}</td>
                            <td>
                                @if ($test->pivot->available_from > $time)
                                    EDIT / DELETE
                                @elseif ($test->pivot->available_to < $time)
                                    VÝSLEDKY
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>

</div>
@endsection