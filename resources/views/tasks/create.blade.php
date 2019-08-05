@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - pridať úlohu
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
        <div class="col-md-12">
            <h1>Pridať úlohu</h1>

            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="form-group">
                    <label for="title" class="mb-0 font-weight-bold">Názov</label>
                    <input id=title" type="text" class="mb-2 form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="question" class="mb-0 font-weight-bold">Zadanie</label>
                    <textarea id="question" class="mb-2 form-control" name="question" rows=3" required>{{ old('question') }}</textarea>
                </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @foreach (['a','b','c','d'] as $answer)
                <div class="form-group">
                    <label for="{{$answer}}" class="mb-0 font-weight-bold">Odpoveď {{ $answer }}</label>
                    <input id="{{$answer}}" type="text" class="mb-2 form-control{{ $errors->has($answer) ? ' is-invalid' : '' }}" name="{{$answer}}" value="{{ old($answer) }}" required>
                    @if ($errors->has($answer))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first($answer) }}</strong>
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <strong>Správna odpoveď</strong>
            <div class="form-group">
                @foreach (['a','b','c','d'] as $answer)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="correct_{{ $answer }}" name="answer" value="{{ $answer }}" {{ old('answer') == $answer ? "checked" : ''}}>
                        <label class="custom-control-label" for="correct_{{ $answer }}">{{ $answer }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-2">
            <strong>Kategória</strong>
            <div class="form-group form-check">
                @foreach ($categories as $category)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="category_{{ $category->id }}" name="categories[]" value="{{$category->id}}" {{ old('categories') != null and in_array($category->id, old('categories')) ? "checked" : '' }}>
                        <label class="custom-control-label" for="category_{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-7">
            <strong>Téma</strong>
            <div class="form-group form-check">
                @foreach ($topics as $topic)
                    <div class="custom-control custom-checkbox {{ $topic->parent_id != null ? 'pl-5 mt-1': '' }}">
                        <input type="checkbox" class="custom-control-input" id="topic_{{ $topic->id }}" name="topics[]" value="{{$topic->id}}" {{ old('topics') != null and in_array($topic->id, old('topics')) ? "checked" : '' }}>
                        <label class="custom-control-label" for="topic_{{ $topic->id }}">{{ $topic->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description_student" class="mb-0">Vysvetlenie pre žiaka</label>
                <textarea id="description_student" class="form-control" name="description_student" rows=3" >{{ old('description_student') }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_teacher" class="mb-0">Vysvetlenie pre učiteľa</label>
                <textarea id="description_teacher" class="form-control" name="description_teacher" rows=3" >{{ old('description_teacher') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Uložiť</button>
        </form>

        </div>
    </div>

</div>
@endsection