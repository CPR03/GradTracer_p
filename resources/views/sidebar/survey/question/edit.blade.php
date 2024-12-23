@extends('layouts.admin-dashboard')
@section('content')
    
    @extends('layouts.survey')
    @section('survey')

    <div class="form-all">
        <div class="card">
            <div class="card-header1">
                <div class="card-body">
                   
                    <form action="/admin/questionnaires/{{ $question->id }}/{{ $answer->id }}/{{ $sections->id }}/update" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <h4><strong>Question Name:</strong> {{ $question_find->question }}</h4><br>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Answer: </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="staticEmail" value="{{ $answer_find->answer }}" name="answers">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Section: </label>
                                <div class="col-sm-10">
                                    <select name="answer_section_name" class="form-control form-control-sm check_inp">
                                        <option selected value="0">Show Next Section</option>
                                            @foreach($sections->sections as $key => $sectionz)
                                                <option value="{{ $sectionz->section_name }}">Show section {{ $key+1 }} ({{ $sectionz->section_name }})</option>
                                           @endforeach
                                    </select>
                                </div>
                            </div>
                
                            
                        @error('answer_find')
                        <span class="text-danger">{{ 'Please complete the choices field' }}</span>
                        @enderror
                        </div>
                        <br>
                        <div class="text-end">
                            <button type="button" class="btn btn-warning"><a style="color: inherit" href="{{ url()->previous() }}">Previous</a></button>
                            <button type="submit" class="btn btn-success">Update Answer</button>
                            
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

@endsection