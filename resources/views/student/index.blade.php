@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - žiaci
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

        <!-- Main content -->
        <div class="col-md-12">
            <h1>Zoznam žiakov</h1>
            <p>TO DO: SORT PODLA PRIEZVISKA, VYHLADANIE KONKRETNEHO ZIAKA ?</p>
            @if (isset($students))

                <table class="table">
                    <tr>
                        <th>Meno a priezvisko</th>
                        <th>Kód</th>
                        <th>Vymazať</th>
                    </tr>
                    @foreach ($students as $student)
                        <tr>
                            <td><a href="{{ route('student.show', $student->id) }}">{{ $student->first_name}} {{ $student->last_name}}</a></td>
                            <td>{{ $student->code }}</td>
                            <td>
                                @if ($student->canDelete())
                                    <form action="{{ route('student.destroy', $student->id) }}" method="post" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger px-4 py-0 btn-trash" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </table>
                {{ $students->links() }}
            @else
                <div>
                    Nemáte pridaných žiadnych študentov
                </div>
            @endif
        </div>

    </div>
</div>
@endsection