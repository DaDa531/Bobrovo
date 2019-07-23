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
                    <textarea id="question" class="mb-2 form-control" name="description" rows=3" ></textarea>

                    <label for="answer-a">Odpoveď a)</label>
                    <input id="answer-a" type="text" class="mb-2 form-control{{ $errors->has('answer-a') ? ' is-invalid' : '' }}" name="answer-a" value="{{ old('answer-a') }}" required autofocus>
                    @if ($errors->has('answer-a'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('answer-a') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="answer-b">Odpoveď b)</label>
                    <input id="answer-b" type="text" class="mb-2 form-control{{ $errors->has('answer-b') ? ' is-invalid' : '' }}" name="answer-b" value="{{ old('answer-b') }}" required autofocus>
                    @if ($errors->has('answer-b'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('answer-b') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="answer-c">Odpoveď c)</label>
                    <input id="answer-c" type="text" class="mb-2 form-control{{ $errors->has('answer-c') ? ' is-invalid' : '' }}" name="answer-c" value="{{ old('answer-c') }}" required autofocus>
                    @if ($errors->has('answer-c'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('answer-c') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="answer-d">Odpoveď d)</label>
                    <input id="answer-d" type="text" class="mb-2 form-control{{ $errors->has('answer-d') ? ' is-invalid' : '' }}" name="answer-d" value="{{ old('answer-d') }}" required autofocus>
                    @if ($errors->has('answer-d'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('answer-d') }}</strong>
                        </span>
                    @endif
                </div>

                Správna odpoveď
                <div class="form-group form-check">
                    @foreach (['a','b','c','d'] as $answer)
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="correctanswer-{{ $answer }}" name="answers[]" value="{{ $answer }}">
                            <label class="custom-control-label" for="correctanswer-{{ $answer }}">{{ $answer }}</label>
                        </div>
                    @endforeach
                </div>

                Téma
                <div class="form-group form-check">
                    @foreach ($topics as $topic)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="topic-{{ $topic->id }}" name="categories[]" value="{{$topic->id}}">
                            <label class="custom-control-label" for="topic-{{ $topic->id }}">{{ $topic->name }}</label>
                        </div>
                    @endforeach
                </div>

                Kategória
                <div class="form-group form-check">
                    @foreach ($categories as $category)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="category-{{ $category->id }}" name="categories[]" value="{{$category->id}}">
                            <label class="custom-control-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="description-pupil">Vysvetlenie pre žiaka</label>
                    <textarea id="description-pupil" class="form-control wyswyg-editor" name="description-pupil" rows=3" ></textarea>
                </div>

                <div class="form-group">
                    <label for="description-teacher">Vysvetlenie pre učiteľa</label>
                    <textarea id="description-teacher" class="form-control wyswyg-editor" name="description-teacher" rows=3" ></textarea>
                </div>



                <button type="submit" class="btn btn-primary">Uložiť</button>
            </form>

        </div>
    </div>
</div>
@endsection