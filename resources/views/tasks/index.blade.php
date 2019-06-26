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
            @if (isset($tasks))

                <table class="table">
                    <tr>
                        <th>Názov</th>
                        <th>Typ</th>
                        <th>Náročnosť</th>
                        <th>Téma</th>
                        <th>Hodnotenie</th>
                    </tr>
                    @foreach($tasks as $task)
                        <tr>
                            <td><a href="{{ route('tasks.show', $task->id) }}">{{ $task->title}}</a></td>
                            <td>{{ $task->type }}</td>
                            <td>{{ $task->difficulty }}</td>
                            <td>
                            @if (count($task->topics) > 0)
                                @foreach ($task->topics as $topic)
                                    {{$topic->name}}<br>
                                @endforeach
                                </ul>
                            @endif
                            </td>
                            <td>{{$task->averageRating() }}</td>
                        </tr>
                    @endforeach

                </table>
                {{ $tasks->links() }}
            @else
                <div>
                    Žiadne otázky
                </div>
            @endif


            <!-- Example pagination Bootstrap component -->
            <!--<nav>
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>-->
        </div>

    </div>
</div>
@endsection