@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - testy
@endsection

@section('content')
<div class="container">

    <div class="row">

        <!-- Main content -->
        <div class="col-md-12">
            <h1>Zoznam testov</h1>

            @if (count($tests) != 0)

                <table class="table">
                    <tr>
                        <th>Názov</th>
                        <th>Priradený</th>
                        <th>Riešený</th>
                        <th>Vytvorený</th>
                        <th class="text-center">Vymazať</th>
                    </tr>
                    @foreach($tests as $test)
                        <tr>
                            <td><a href="{{ route('test.show', $test->id) }}">{{ $test->name}}</a></td>
                            <td>{{ $test->isAssigned() ? 'áno' : 'nie'}}</td>
                            <td>{{ $test->isSolved() ? 'áno' : 'nie' }}</td>
                            <td>{{ $test->createdAtToString($test->created_at) }}</td>
                            <td class="text-center">
                                @if ($test->canDelete())
                                    <a href="{{ route('test.destroy', $test->id) }}" class="text-danger" title="Vymazať {{ $test->name }}"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div>
                    Nemáte vytvorené žiadene testy.
                </div>
            @endif
        </div>

    </div>
</div>
@endsection