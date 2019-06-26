@if (count($errors))
    <div class="form-group">
        <div class="alert alert-danger">
            <ul class="list-unstyled mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif