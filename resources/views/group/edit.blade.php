@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - upraviť skupinu
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h1>Upraviť skupinu</h1>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('group.show', $group->id) }}" class="d-inline mr-2"><button class="btn btn-secondary px-4">Späť na skupinu</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('group.update', $group->id) }}" class="form-inline my-3">
                @csrf
                <label for="name"  class="mr-sm-2"><strong>Meno:</strong></label>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} mb-2 mr-sm-2" name="name" value="{{ old('name') ?? $group->name }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

                <label for="group-description" class="mr-sm-2">Popis:</label>
                <input id="group-description" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}  mb-2 mr-sm-2" name="description" value="{{ old('description') ?? $group->description }}" size="75">

                <button type="submit" class="btn btn-primary mb-2">Zmeniť údaje</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h2>Žiaci v skupine ({{ count($students) }})</h2>
            PREROBIT CEZ 2 SELECTY/
            ZISTIT PRECO NEFUNGUJE
            @if (count($students)>0)
                <table class="table">
                    <tr>
                        <th>Meno a priezvisko</th>
                        <th class="text-right">Vymazať žiaka zo skupiny</th>
                    </tr>
                    @foreach ($students as $student)
                        <tr>
                            <td><a href="{{ route('student.show', $student->id) }}">{{$student->first_name}} {{$student->last_name}}</a></td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('group.removestudent', [$group->id, $student->id]) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-trash px-4 py-0" type="submit" title="Vymazať žiaka zo skupiny">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
        <div class="col-md-6">
            <h3>Pridať žiakov do skupiny</h3>
            <form method="post" action="{{ route('group.addstudents', $group->id) }}">
                <div class="form-group">
                    <label for="pupils">Vyber žiakov:</label>
                    <select name="pupils[]" id="pupils" class="custom-select" size = {{ count($allstudents) > 10 ? 10 : count($allstudents)}} multiple>
                        @foreach($allstudents as $student)
                            <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Označených pridať do skupiny</button>
            </form>
        </div>
    </div>

</div>
@endsection