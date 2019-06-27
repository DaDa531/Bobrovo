@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - pridaj žiaka
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
            <h1>Pridať žiaka</h1>

            <form method="POST" action="{{ route('student.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">Meno</label>
                        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Priezvisko</label>
                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>

                <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.22.0/slimselect.min.js"></script>
                <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.22.0/slimselect.min.css" rel="stylesheet">-->

                <div class="form-group">
                    <label for="groups[]">Skupiny</label>
                    PREROBIT NA SLIM SELECT
                    <select name="groups[]" id="group-select" class="form-control" multiple="multiple">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Pridať</button>
            </form>



        </div>

    </div>
</div>
@endsection