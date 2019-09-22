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
        <div class="col-md-9">
            <h1>Test {{ $test->name }}</h1>
            TO DO: SPRAVIŤ NIEČO S ROZLOŽENIM
        </div>

        <div class="col-md-3">
            @if (!$test->isSolved())
                <a href="{{ route('test.edit', $test->id) }}" class="d-inline mr-2">
                    <button class="btn btn-secondary px-4"><i class="fa fa-edit pr-2"></i>Upraviť TODO</button>
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
        <div class="col-md-9">
            <p><strong>Popis:</strong> {{ $test->description }}</p>
        </div>
        <div class="col-md-3">
            <p><strong>Dostupný popis testu:</strong> {{ $test->available_description ? 'áno' : 'nie' }}</p>
            <p><strong>Verejný:</strong> {{ $test->public ? 'áno' : 'nie' }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <h3>Úlohy v teste</h3>
        </div>
        <div class="col-md-3">
            <a href="{{ route('test.selecttasks', $test->id) }}" class="d-inline mr-2">
                <button class="btn btn-secondary px-4"><i class="fa fa-edit pr-2"></i>Pridať/zrušiť úlohy</button>
            </a>
            <a href="" class="d-inline mr-2">
                <button class="btn btn-secondary px-4"><i class="fa fa-edit pr-2"></i>Náhľad testu TODO</button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (count($tasks) != 0)
                <table class="table">
                    <tr>
                        <th>Názov</th>
                        <th>Typ</th>
                        <th>Kategória</th>
                        <th>Téma</th>
                        <th>Hodnotenie</th>
                    </tr>
                    @foreach($tasks as $task)
                        <tr>
                            <td><a href="{{ route('tasks.show', $task->id) }}">{{ $task->title}}</a></td>
                            <td>{{ $task->type }}</td>
                            <td>
                                @if (count($task->categories) > 0)
                                    @foreach ($task->categories as $category)
                                        {{$category->name}}<br>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if (count($task->topics) > 0)
                                    @foreach ($task->topics as $topic)
                                        {{$topic->name}}<br>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{$task->averageRating() }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                Test je prázdny.
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <h3><h3>Pridelenie testu skupinám</h3></h3>
        </div>
        <div class="col-md-3">
            <a href="{{ route('assignment.create', $test->id) }}" class="d-inline mr-2">
                <button class="btn btn-secondary px-4"><i class="fa fa-edit pr-2"></i>Prideliť test TODO</button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (count($group_assignments) != 0)
                TO DO: AKCIE: ak je test pred vypracovaním, možno zmeniť alebo zrušiť pridelenie, ak je po, možno zobraziť výsledky
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
                @foreach ($group_assignments as $group)
                    <tr>
                        <td><a href="{{ route('group.show', $group->group->id) }}">{{$group->group->name}}</a></td>
                        <td>{{ $group->mix_questions ? 'áno' : 'nie' }}</td>
                        <td>{{ $group->available_answers ? 'áno' : 'nie' }}</td>
                        <td>{{ $group->available_from }}</td>
                        <td>{{ $group->available_to }}</td>
                        <td>{{ $group->time_to_do }}</td>
                        <td>
                            @if ($group->available_from > $time)
                                <a href="{{ route('assignment.edit', $group->id) }}">EDIT</a> / DELETE
                            @elseif ($group->available_to < $time)
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