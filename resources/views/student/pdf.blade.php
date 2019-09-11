@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - zoznam žiakov
@endsection

@section('content')
    <div class="container">


        <div class="row">
            <div class="col-md-12">
                <h1>Zoznam žiakov</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>Meno a priezvisko</th>
                        <th>Kód</th>
                        <th>Dátum pridania</th>
                        <th class="text-center">Upraviť</th>
                        <th class="text-center">Zrušiť</th>
                    </tr>
                    @foreach ($students as $student)
                        <tr>
                            <td><a href="{{ route('student.show', $student->id) }}">{{ $student->first_name}} {{ $student->last_name}}</a></td>
                            <td>{{ $student->code }}</td>
                            <td>{{ $student->dateToString($student->created_at) }}</td>
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
            </div>
        </div>
        </form>

    </div>
@endsection