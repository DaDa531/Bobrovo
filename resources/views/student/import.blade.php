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
        <div class="col-md-8">
            <h1>Pridať žiakov zo súboru</h1>
            TO DO: ZOBRAZENIE NAZVU ZVOLENEHO SUBORU (MAM COPYPASTE Z BOOTSTRAPU, ALE NEFUNGUJE)

            <form method="POST" action="{{ route('student.multistore') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <strong>Zoznam žiakov</strong> (súbor <code>.csv</code>, v ktorom je pre každého žiaka záznam v tvare <code> meno_žiaka, priezvisko_žiaka, kód</code>)
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="studentFile" required>
                        <label class="custom-file-label" for="customFile">Zvoľte súbor</label>
                    </div>
                </div>

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
            <script>
                // NEFUNGUJE :(  display the name of the file on select
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            </script>

        </div>

    </div>
</div>
@endsection