@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - upraviť žiaka
@endsection

@section('content')
<div class="container">


    <div class="row">
        <div class="col-md-6">
            <h1>Upraviť žiaka</h1>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('student.show', $student->id) }}" class="d-inline mr-2"><button class="btn btn-secondary px-4">Späť na žiaka</button></a>
        </div>
    </div>

    <!-- Main content -->
    <div class="row">
        <div class="col-md-6">

            <form method="POST" action="{{ route('student.update', $student->id) }}">
                @csrf

                <div class="form-group">
                    <label for="first_name"><strong>Meno</strong></label>
                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') ?? $student->first_name }}" required autofocus>
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="last_name"><strong>Priezvisko</strong></label>
                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') ?? $student->last_name }}" required>
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>

                <button class="btn btn-primary px-4" type="submit">
                    Zmeniť údaje
                </button>
            </form>

            <!--
            <form method="POST" action="{{ route('student.update', $student->id) }}">
                @csrf
                <div class="form-group mt-4">
                    <label for="code"><strong>Kód</strong></label>
                    <input id="code" type="text" class="form-control" name="code" value="{{ old('code') ?? $student->code }}" disabled>
                </div>

                <button class="btn btn-primary px-4" type="submit">
                    Vygenerovať nový kód
                </button>
            </form>
            -->
        </div>

        <div class="col-md-6">
            <h2>Účasť v skupinách</h2>
            @if (count($assigned_groups) == 0)
                Žiak nie je zaradený do žiadnej skupiny.
            @else
                @if (count($assigned_groups)>0)
                    <form method="post" action="{{ route('student.removegroup', $student->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="groups">Žiak je zaradený do skupín:</label>
                            <select name="groups[]" id="groups" class="custom-select" size = {{ count($assigned_groups) > 10 ? 20 : count($assigned_groups)}} multiple>
                                @foreach($assigned_groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-danger px-4" type="submit"><i class="fa fa-lg fa-trash pr-3"></i>Odobrať žiaka z označených skupín</button>
                    </form>
                @endif
            @endif

            @if (count($available_groups) > 0)
                <form method="POST" action="{{ route('student.addgroup', $student->id) }}">
                    @csrf
                    <div class="form-group mt-4">
                        <label for="groups">Ostatné skupiny:</label>
                        <select name="groups[]" id="groups" class="custom-select" size = {{ count($available_groups) > 10 ? 20 : count($available_groups)}} multiple>
                            @foreach($available_groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Pridať žiaka do zvolených skupín</button>
                </form>
            @endif

        </div>
    </div>

</div>
@endsection