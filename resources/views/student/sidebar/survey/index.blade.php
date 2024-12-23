@extends('student.layouts.student-dashboard')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{url('css/survey.css')}}">

    <div class="form-all">
        <ul class="page-section">
            <li>
                <div class="form-header-group header-large">
                    <div class="header-text httal htvam">
                    
                        <h1 id="header_1" class="form-header">
                        
                            Hello
                            
                        </h1>
                        
                        <div id="subHeader_1" class="form-subHeader">
                        Thank you for taking the time to answer these questions. The following questions are about to know how well known and successful is [Site Name]
                        </div>
                        <div class="text-end">
                            <a href="/surveys/{{ $questionnaires->id }}-{{ Str::slug($questionnaires->title) }}" class="btn btn-success btn-sm">Take Survey</button></a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
@endsection