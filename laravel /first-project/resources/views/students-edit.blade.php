@extends('app')

@section('students-edit')
    <div class="container">
        <form action="{{ route('students-update') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group hidden">
                <label for="id">Name</label>
                <input type="text" class="form-control" id="id" name="id" value="{{ $student->id }}">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="{{ $student->age }}">
            </div>
            <button type="submit" class="btn btn-primary">Change</button>
        </form>
    </div>
@endsection
