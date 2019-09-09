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
        <div class="col-md-9">
            <p><strong>Popis:</strong> {{ $test->description }}</p>
        </div>
        <div class="col-md-3">
            <p><strong>Dostupný popis testu:</strong> {{ $test->available_description ? 'áno' : 'nie' }}</p>
            <p><strong>Verejný:</strong> {{ $test->public ? 'áno' : 'nie' }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (count($group_assignments) != 0)
                <h3>Pridelenie testu skupinám</h3>
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
                        <td>{{ $group->mixed_questions ? 'áno' : 'nie' }}</td>
                        <td>{{ $group->available_answers ? 'áno' : 'nie' }}</td>
                        <td>{{ $group->available_from }}</td>
                        <td>{{ $group->available_to }}</td>
                        <td>{{ $group->time_to_do }}</td>
                        <td>
                            @if ($group->available_from > $time)
                                EDIT / DELETE
                            @elseif ($group->available_to < $time)
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