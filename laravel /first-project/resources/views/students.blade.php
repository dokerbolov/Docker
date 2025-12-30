@extends('app')

@section('students')
    <div class="container">
        <h1>Students List</h1>

        @foreach($students as $student)
            <div class="card m-1">
                <h5 class="card-header">{{ $student->name }}</h5>
                <div class="card-body">
                    <p class="card-text">GROUP: {{ $student->group == null ? 'Not exist' : $student->group->name }}</p>
                    <p class="card-text">AGE: {{ $student->age }}</p>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2">
                            <a href="/students-edit/{{ $student->id }}" class="btn btn-primary">Edit Student</a>
                        </div>
                        <div class="col-1">
                            <form action="students-delete" method="post">
                                @csrf
                                <input hidden type="text" class="form-control" id="id" name="id" value="{{ $student->id }}">
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
