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
            <a href="{{ route('student.show', $student->id) }}" class="d-inline mr-2"><button class="btn btn-secondary px-4">Späť</button></a>
        </div>
    </div>

    <!-- Main content -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.7/slimselect.min.css" rel="stylesheet">
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

        </div>
        <div class="col-md-6">
            <p class="mb-1">Skupiny</p>
            @if (count($assigned_groups) == 0)
                Žiak nie je zatiaľ zaradený do žiadnej skupiny.
            @else
                <table class="table">
                    <tr>
                        <th>Skupina</th>
                        <th class="text-right">Vymazať žiaka zo skupiny</th>
                    </tr>
                    @foreach ($assigned_groups as $group)
                        <tr>
                            <td>{{$group->name}}</td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('student.removegroup', [$student->id, $group->id]) }}" class="d-inline">
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

            @if (count($available_groups) > 0)
                <form method="POST" action="{{ route('student.addgroup', $student->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="groups">Pridať žiaka do skupiny (skupín)</label>
                        <select name="groups[]" id="slim-select" multiple>
                            @foreach($available_groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Pridať do skupiny</button>
                </form>
            @endif

        </div>
    </div>

</div>
@endsection