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
                            <td>{{ $test->dateToString($test->created_at) }}</td>
                            <td class="text-center">
                                @if ($test->canDelete())
                                    <form action="{{ route('test.destroy', $test->id) }}" method="post" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-trash px-4 py-0" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
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