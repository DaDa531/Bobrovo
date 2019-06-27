@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - import žiakov
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
            <h1>TO DO Pridať žiakov zo súboru</h1>
            <div class="alert alert-warning">
                Súbor typu <strong>.csv</strong>, v ktorom 1. stĺpec je meno žiaka, 2. stĺpec je priezvisko žiaka a 3. stĺpec je kód žiaka (min. 12 znakov).
            </div>

            <form method="POST" action="{{ route('student.multistore') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="studentFile" name="studentFile">
                        <label class="custom-file-label" for="studentFile">Vyber súbor</label>
                    </div>
                </div>
                <script>
                    // Add the following code if you want the name of the file appear on select
                    $(".custom-file-input").on("change", function() {
                        var fileName = $(this).val().split("\\").pop();
                        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    });
                </script>
                <div class="form-group">
                    <label for="group">Skupina</label>
                    <select name="group" id="group" class="form-control{{ $errors->has('group') ? ' is-invalid' : '' }}">
                        <option value="" {{ old('group') ? '' : ' selected' }} disabled></option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ old('group') == $group->id ? ' selected' : ''  }}>{{ $group->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('group'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('group') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Pridať</button>
            </form>

        </div>

    </div>
</div>
@endsection