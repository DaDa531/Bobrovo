@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - zoznam žiakov
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
            <h1>Zoznam žiakov</h1>
        </div>
        <div class="col-md-3 text-right">
            <a href="{{ route('student.pdf') }}" class="mr-2">
                <button class="btn btn-secondary px-4"><i class="fa fa-lg fa-print pr-2"></i>PDF</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>TO DO: SORTY a FILTRE, VYHĽADANIE KONKRÉTNEHO ZIAKA</p>
            @if (isset($students))
                <table class="table">
                    <tr>
                        <th>Meno a priezvisko</th>
                        <th>Kód</th>
                        <th>Dátum pridania</th>
                        <th>Skupina</th>
                        <th class="text-center">Upraviť</th>
                        <th class="text-center">Zrušiť</th>
                    </tr>
                    @foreach ($students as $student)
                        <tr>
                            <td><a href="{{ route('student.show', $student->id) }}">{{ $student->first_name}} {{ $student->last_name}}</a></td>
                            <td>{{ $student->code }}</td>
                            <td>{{ $student->dateToString($student->created_at) }}</td>
                            <td>{{implode(', ', $student->groups->pluck('name')->toArray())}}</td>
                            <td class="text-center">
                                <a href="{{ route('student.edit', $student->id) }}" title="Upraviť {{ $student->first_name . ' ' . $student->last_name }}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td class="text-center">
                                @if ($student->canDelete())
                                    <form action="{{ route('student.destroy', $student->id) }}" method="post" class="d-inline">
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
                {{ $students->links() }}
            @else
                <div>
                    Nemáte pridaných žiadnych žiakov.
                </div>
            @endif
        </div>
    </div>
    </form>

</div>
@endsection