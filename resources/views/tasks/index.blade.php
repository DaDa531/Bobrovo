@extends('layouts.master-teacher')

@section('title')
    Bobrovo - úlohy
@endsection

@section('content')
<div class="container">

    <div class="row">
        <!-- Main content -->
        <div class="col-md-12">
            <h1>Zoznam úloh</h1>
            TO DO: pridať filter podľa typu úlohy, vylepšiť vzhľad formulárov, zobraziť zapamätaný filter, skúsiť vue-select; neskôr celé filtrovanie cez Vue
            <h2>Filter</h2>
        </div>
    </div>


    <!-- Skusit pouzit Vue Select https://vue-select.org/ -->
    <form method="POST" action="{{ route('tasks.filter') }}">
        @csrf

    <div class="row">

        <div class="col-md-5">
            <div class="form-group">
                <label for="category">Kategória</label>
                <select name="category[]" id="category" class="custom-select" size="3" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->class }} )</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label for="topic">Téma</label>
                <select name="topic[]" id="topic" class="custom-select" size="3" multiple>
                    @foreach ($topics as $topic)
                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!--
        <div class="col-md-2">
            <p>Typ úloh</p>

            @foreach (['všetky','interaktívne','neinteraktívne'] as $type)
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="{{ $type }}" name="type" value="{{ $type }}" {{ old('type') == $type ? "checked" : ''}}>
                    <label class="custom-control-label" for="{{ $type}}">{{ $type }}</label>
                </div>
            @endforeach
        </div>
    -->

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Aplikuj filter</button>
        </div>

    </div>
    </form>

    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ route('tasks.resetfilter') }}">
                @csrf
                <button type="submit" class="btn btn-primary mb-2">Zruš filter</button>
            </form>
        </div>
    </div>

    @if (isset($tasks) and count($tasks) > 0)
        <form method="post" action="{{ route('test.addtasks') }}">
            @csrf
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>Názov</th>
                        <th>Typ</th>
                        <th>Kategória</th>
                        <th>Téma</th>
                        <th>Hodnotenie</th>
                    </tr>
                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="{{ $task->id }}" name="tasks[]" value="{{$task->id}}">
                                    <label class="custom-control-label" for="{{ $task->id }}"> <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title}}</a></label>
                                </div>
                            </td>
                            <td>{{ $task->type }}</td>
                            <td>
                                @if (count($task->categories) > 0)
                                    @foreach ($task->categories as $category)
                                        {{$category->name}}<br>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                            @if (count($task->topics) > 0)
                                @foreach ($task->topics as $topic)
                                    {{$topic->name}}<br>
                                @endforeach
                            @endif
                            </td>
                            <td>{{$task->averageRating() }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    @if (isset($test))
                        <!--<label for="test" class="font-weight-bold">Test</label>-->
                        <input type="hidden" name="test" value="{{$test->id}}">
                        <select name="t" id="test" class="custom-select" disabled>
                            <option value="{{$test->id}}" selected>{{$test->name}}</option>
                    @else
                        <!--<label for="test" class="font-weight-bold">Zvoľ test</label>-->
                        <select name="test" id="test" class="custom-select" required>
                            <option value="" disabled selected>- Zvoľ test - </option>
                            @foreach($tests as $test)
                                <option value="{{ $test->id }}">{{ $test->name }}</option>
                            @endforeach
                    @endif
                        </select>
                </div>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Pridať úlohy do testu</button>
            </div>
        </div>
        </form>
    @else
        <div class="row">
            <div class="col-md-12">
                Požiadavkám nezodpovedajú žiadne úlohy.
            </div>
        </div>
    @endif
</div>
@endsection