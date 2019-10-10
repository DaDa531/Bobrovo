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
                <form action="{{ route('test.destroy', $test->id) }}" method="post" class="d-inline">
                    @csrf
                    <button class="btn btn-danger px-4" type="submit"><i class="fa fa-lg fa-trash pr-3"></i>Zrušiť</button>
                </form>
            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p><strong>Popis:</strong> {{ $test->description }}</p>
            <p><strong>Dostupný popis testu:</strong> {{ $test->available_description ? 'áno' : 'nie' }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <h3>Úlohy v teste</h3>
        </div>
        <div class="col-md-3 text-right">
            @if (!$test->isSolved())
                <form action="{{ route('test.selecttasks', $test->id) }}" method="post">
                    @csrf
                    <button class="btn btn-secondary px-4" type="submit" title="Pridať úlohy"><i class="fa fa-edit pr-2"></i>Pridať úlohy</button>
                </form>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (count($tasks) != 0)
                <ul>
                    @foreach($tasks as $task)
                        <li><a href="{{ route('tasks.show', $task->id) }}">{{ $task->title}}</a></li>
                    @endforeach
                </ul>
                <a href="">
                    <button class="btn btn-secondary px-4"><i class="fa fa-edit pr-2"></i>Náhľad testu TODO</button>
                </a>
            @else
                Test je prázdny.
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Pridelenie testu skupinám</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('assignment.create', $test->id) }}" class="d-inline mr-2">
                <button class="btn btn-secondary px-4">Prideliť test skupine</button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (count($group_assignments) != 0)
                TO DO: zobrazenie výsledkov
                <table class="table">
                <tr>
                    <th>Skupina</th>
                    <th>Miešať otázky</th>
                    <th>Zobraziť výsledky</th>
                    <th>Dostupný od:</th>
                    <th>Dostupný do:</th>
                    <th>Časový limit (min):</th>
                    <th>Akcie</th>
                </tr>
                @foreach ($group_assignments as $assignment)
                    <tr>
                        <td><a href="{{ route('group.show', $assignment->group->id) }}">{{$assignment->group->name}}</a></td>
                        <td>{{ $assignment->mix_questions ? 'áno' : 'nie' }}</td>
                        <td>{{ $assignment->available_answers ? 'áno' : 'nie' }}</td>
                        <td>{{ $assignment->available_from }}</td>
                        <td>{{ $assignment->available_to }}</td>
                        <td>{{ $assignment->time_to_do }}</td>
                        <td>
                            @if ($assignment->available_from > $time)
                                <a href="{{ route('assignment.edit', $assignment->id) }}" title="Upraviť pridelenie"><i class="fa fa-edit"></i></a>

                                <form action="{{ route('assignment.destroy', $assignment->id) }}" method="post" class="d-inline" title="Zrušiť pridelenie">
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
                Test zatiaľ nebol pridelený žiadnej skupine.
            @endif
        </div>
    </div>

</div>
@endsection