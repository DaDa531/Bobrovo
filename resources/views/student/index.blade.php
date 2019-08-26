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
        <div class="col-md-12">
            <h1>Zoznam žiakov</h1>
        </div>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.7/slimselect.min.css" rel="stylesheet">
    <form method="POST" action="{{ route('student.maddgroup') }}">
        @csrf
    <div class="row">
        <div class="col-md-9 form-group form-check">
            <p>TO DO: UMOŽNIŤ SORT PODĽA PRIEZVISKA, VYHĽADANIE KONKRÉTNEHO ZIAKA, TLAČ ZOZNAMU ŽIAKOV S KÓDMI</p>
            @if (isset($students))
                <table class="table">
                    <tr>
                        <th>Meno a priezvisko</th>
                        <th>Kód</th>
                        <th>Dátum pridania</th>
                        <th class="text-center">Upraviť</th>
                        <th class="text-center">Vymazať</th>
                    </tr>
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="pupils[]" id="{{ $student->id }}" value="{{ $student->id }}">
                                    <label class="custom-control-label" for="{{ $student->id }}"><a href="{{ route('student.show', $student->id) }}">{{ $student->first_name}} {{ $student->last_name}}</a></label>
                                </div>
                            </td>
                            <td>{{ $student->code }}</td>
                            <td>{{ $student->createdAtToString() }}</td>
                            <td class="text-center">
                                <a href="{{ route('student.edit', $student->id) }}" title="Upraviť {{ $student->first_name . ' ' . $student->last_name }}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td class="text-center">
                                @if ($student->canDelete())
                                    <!--<form action="{{ route('student.destroy', $student->id) }}" method="post" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger px-4 py-0" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>-->
                                    <a href="{{ route('student.destroy', $student->id) }}" class="text-danger" title="Vymazať {{ $student->first_name . ' ' . $student->last_name }}"><i class="fa fa-trash"></i></a>
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
        <div class="col-md-3">
            <div class="form-group">
                <label for="group">Zvoľ skupinu:</label>
                <select name="group" id="slim-select" multiple>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Pridať žiakov do skupiny</button>
        </div>
    </div>
    </form>

</div>
@endsection