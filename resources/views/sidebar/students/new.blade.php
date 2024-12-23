@extends('layouts.admin-dashboard')
@section('content')
@extends('layouts.survey')
@section('survey')

        <div class="form-all">
            <div class="card">
                <div class="card-header" style="background-color: #fff"><b>Create Department User</b></div>
                    <div class="card-body">

                        <form action="{{ route('admin.departments.store')}}" method="post">
                            @csrf
                            @method('post')

                            <div class="mb-3">
                                <label for="name" class="form-label">Enter Name:</label>
                                <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="name" placeholder="Enter Name">

                                @error('title')
                                    <span class="text-danger">{{ 'Please Enter Name' }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Enter Email:</label>
                                <input name="email" value="{{ old('email') }}" type="email" class="form-control" id="email" placeholder="Enter Email">

                                @error('email')
                                    <span class="text-danger">{{ 'Please Enter Email' }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Enter Password:</label>
                                <input name="password" value="{{ old('password') }}" type="password" class="form-control" id="password" placeholder="Enter Password">

                                @error('password')
                                    <span class="text-danger">{{ 'Please Enter Password' }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password: </label>
                                <input name="password_confirmation" value="{{ old('password_confirmation') }}" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">

                                @error('password_confirmation')
                                    <span class="text-danger">{{ 'Please Enter Password' }}</span>
                                @enderror
                            </div>
                            <h3 class="text-xl my-4 text-gray-600">Role</h3>
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach($roles as $role)
                                        <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="roles[]" value="{{$role->id}}">
                                                    <span class="ml-2 text-black-900">{{ $role->name }}</span>
                                                </label>
                                        </div>
                                    @endforeach
                                </div>
                                <br>
                            <button type="submit" class="btn" id="confirmBtn">Create Questionaire</button>

                        </form>
                    </div>
            </div>
        </div>

@endsection
@endsection
