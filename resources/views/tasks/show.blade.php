@extends('layouts.master-teacher')

@section('title')
    Bobrovo - úloha {{ $task->nazov}}
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h2>Úloha {{ $task->title}}</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Zadanie</h4>
                </div>
                <div class="card-body">
                    <p>{{$task->question}}</p>
                    <ul>
                        <li>{{$task->a}}</li>
                        <li>{{$task->b}}</li>
                        <li>{{$task->c}}</li>
                        <li>{{$task->d}}</li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Vysvetlenia</h4>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @if (!$task->description_teacher and !$task->description)
                            <li class="list-group-item">K úlohe nie sú priradené žiadne vysvetlenia.</li>
                        @endif
                        @if ($task->description_teacher)
                            <li class="list-group-item list-group-item-action">
                                <a data-toggle="collapse" href="#collapseOne"><h5>pre učiteľa</h5></a>
                            </li>
                            <li class="list-group-item collapse" id="collapseOne">{{$task->description_teacher}}</li>
                        @endif
                        @if ($task->description)
                            <li class="list-group-item list-group-item-action" data-toggle="collapse" href="#collapseTwo">
                                <h5>pre žiaka</h5>
                            </li>
                            <li class="list-group-item collapse" id="collapseTwo">{{$task->description}}</li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <!--<h3>Náročnosť</h3>
            <p>{{$task->difficulty}}</p>-->

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
                                <li class="list-group-item">{{$topic->name}}</li>
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