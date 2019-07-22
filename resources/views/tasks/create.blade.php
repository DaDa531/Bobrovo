@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - pridať úlohu
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h2>Pridať úlohu</h2>

            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <div class="form-group">
                    <label for="question">Zadanie</label>
                    <textarea id="question" class="form-control wyswyg-editor" name="description" rows=3" ></textarea>

                    Otázka

                    Možnosti - 4x obyč input

                    Správna odpoveď - výber zo 4

                    Téma

                    Kategória

                    <label for="description-pupil">Vysvetlenie pre žiaka</label>
                    <textarea id="description-pupil" class="form-control wyswyg-editor" name="description-pupil" rows=3" ></textarea>

                    <label for="description-teacher">Vysvetlenie pre učiteľa</label>
                    <textarea id="description-teacher" class="form-control wyswyg-editor" name="description-teacher" rows=3" ></textarea>



                </div>

                <button type="submit" class="btn btn-primary">Uložiť</button>
            </form>

        </div>
    </div>
</div>
@endsection