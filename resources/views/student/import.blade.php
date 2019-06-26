@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - import žiakov
@endsection

@section('content')
<div class="container">
    <div class="row">

        <!-- Main content -->
        <div class="col-md-12">
            <h1>Pridať žiakov zo súboru</h1>
            <div class="alert alert-warning">
                Súbor typu <strong>.csv</strong>, v ktorom prvý stĺpec je meno žiaka, 2. stĺpec je priezvisko žiaka a 3. stĺpec je kód žiaka (min. 12 znakov).
            </div>

            <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="student-file" name="student_file">
                        <label class="custom-file-label" for="student_file">Vybrať súbor</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="group">Skupina</label>
                    <select name="group" id="group" class="form-control">
                        <option value="">-- Vyber skupinu --</option>
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