@extends('layouts.master-teacher')

@section('title')
    Bobrovo - úloha {{ $task->nazov}}
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
        <div class="col-md-6">
            <h1>Úloha {{ $task->title}}</h1>
        </div>

        <div class="col-md-6 text-right">
            @if ($task->canDelete())
                <a href="{{ route('tasks.edit', $task->id) }}" class="d-inline mr-2">
                    <button class="btn btn-secondary px-4"><i class="fa fa-edit pr-2"></i>Upraviť</button>
                </a>

                <a href="{{ route('tasks.destroy', $task->id) }}" class="d-inline mr-2">
                    <button class="btn btn-danger px-4"><i class="fa fa-trash pr-3"></i>Zrušiť</button>
                </a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Zadanie</h4>
                </div>
                <div class="card-body">
                    <p>{!! $task->question !!}</p>
                    <ul>
                        <li>{!! $task->answer == 'a' ? $task->a . '<span class="text-success"> <i class="fa fa-check"></i></span>': $task->a . '<span class="text-danger"> <i class="fa fa-times"></i></span>' !!}</li>
                        <li>{!! $task->answer == 'b' ? $task->b . '<span class="text-success"> <i class="fa fa-check"></i></span>': $task->b . '<span class="text-danger"> <i class="fa fa-times"></i></span>' !!}</li>
                        <li>{!! $task->answer == 'c' ? $task->c . '<span class="text-success"> <i class="fa fa-check"></i></span>': $task->c . '<span class="text-danger"> <i class="fa fa-times"></i></span>' !!}</li>
                        <li>{!! $task->answer == 'd' ? $task->d . '<span class="text-success"> <i class="fa fa-check"></i></span>': $task->d . '<span class="text-danger"> <i class="fa fa-times"></i></span>' !!}</li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Vysvetlenia</h4>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @if (!$task->description_teacher and !$task->description_student)
                            <li class="list-group-item">K úlohe nie sú priradené žiadne vysvetlenia.</li>
                        @endif
                        @if ($task->description_teacher)
                            <li class="list-group-item list-group-item-action">
                                <a data-toggle="collapse" href="#collapseOne"><h5>pre učiteľa</h5></a>
                            </li>
                            <li class="list-group-item collapse show" id="collapseOne">{{$task->description_teacher}}</li>
                        @endif
                        @if ($task->description_student)
                            <li class="list-group-item list-group-item-action" data-toggle="collapse" href="#collapseTwo">
                                <h5>pre žiaka</h5>
                            </li>
                            <li class="list-group-item collapse show" id="collapseTwo">{{$task->description_student}}</li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="card mb-2">
                <div class="card-header">
                    <h4>Kategória</h4>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @if (count($categories) == 0)
                            <li class="list-group-item">Úloha nie zaradená do žiadnej kategórie.</li>
                        @else
                            <li class="list-group-item">{{implode($categories->toArray(),', ')}}</li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <h4>Téma</h4>
                </div>
                <div class="card-body p-0">
                    @if (count($topics) == 0)
                        <li class="list-group-item">Úloha nie zaradená k žiadnej téme.</li>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($topics as $topic)
                                <li class="list-group-item">{{$topic->description}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>


            <div class="card mb-2">
                <div class="card-header">
                    <h4>Hodnotenie</h4>
                </div>
                <div class="card-body">
                    @for ($i = 0; $i < floor($rating); $i++ )
                        <i class="fa fa-star"></i>
                    @endfor
                    @if ($rating < 5 and floor($rating) != $rating)
                        <i class="fa fa-star-half-full"></i>
                    @endif
                    @for ($i = 0; $i < 5 - ceil($rating); $i++ )
                        <i class="fa fa-star-o"></i>
                    @endfor
                </div>
            </div>

            <div class="card">
                @if (count($comments) > 0)
                    <a data-toggle="collapse" href="#collapseComments">
                        <div class="card-header">
                            <h4>Komentáre ({{count($comments)}})</h4>
                        </div>
                    </a>
                    <div class="card-body p-0 collapse" id="collapseComments">
                        <ul class="list-group list-group-flush">
                            @foreach ($comments as $comment)
                                <li class="list-group-item">
                                    <strong>{{$comment->user->first_name}} {{$comment->user->last_name}}</strong>,
                                    {{$comment->created_at}}<br>
                                    {{$comment->comment}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="card-header">
                        <h4>Komentáre</h4>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Úlohu zatiaľ nikto nekomentoval.
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection