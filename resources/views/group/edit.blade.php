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
        <div class="col-md-6">
            <form method="POST" action="{{ route('group.update', $group->id) }}">
                @csrf
                <div class="form-group">
                    <label for="name"><strong>Meno</strong></label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? $group->name }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Popis</label>
                    <textarea id="group-description" class="form-control wyswyg-editor" name="description" rows=4" >{{ old('description') ?? $group->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Zmeniť údaje</button>
            </form>
        </div>
        <div class="col-md-6">
            <p class="mb-1">Žiaci v skupine ({{ count($students) }})</p>
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
    </div>

</div>
@endsection