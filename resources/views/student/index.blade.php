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
    <form method="POST">
        @csrf
    <div class="row">
        <div class="col-md-8 form-group form-check">
            <p>TO DO: UMOŽNIŤ SORT PODĽA PRIEZVISKA, VYHĽADANIE KONKRÉTNEHO ZIAKA, TLAČ ZOZNAMU ŽIAKOV S KÓDMI</p>
            @if (isset($students))
                <table class="table">
                    <tr>
                        <th>Meno a priezvisko</th>
                        <th>Kód</th>
                        <th>Dátum pridania</th>
                        <th class="text-center">Upraviť</th>
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
        <div class="col-md-4">
            <div class="form-group">
                <button type="submit" value="delete" class="btn btn-danger px-4" formaction="{{ route('student.multidestroy') }}"><i class="fa fa-trash pr-2"></i> Zrušiť označených žiakov</button>
            </div>

            <div class="form-group">
                <label for="group" class="d-inline">pridať do skupiny:</label>
                <!--<select name="group" id="group" class="custom-select">-->
                <select name="group" id="slim-select" multiple >
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach

                </select>
                <button type="submit" value="add" class="btn btn-primary px-4 mt-2 d-inline" formaction="{{ route('student.maddgroup') }}">Pridať označených žiakov do skupiny</button>
            </div>
        </div>
    </div>
    </form>

</div>
@endsection