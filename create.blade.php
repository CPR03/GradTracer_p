<!-- Original CODE -->

@extends('layouts.admin-dashboard')
@section('content')

    @extends('layouts.survey')
    @section('survey')

    <div class="form-all">
        <div class="card">
            <div class="card-header1">
                <div class="card-body">
                    @foreach($questionnaire_id as $questionnaires)
                    <form action="{{ route('admin.survey.store',$questionnaires->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="question[questionnaire_id]" value="{{$questionnaires->id}}">
                        @error('answers.*.answer')
                        <span class="text-danger">{{ 'Please complete the choices field' }}</span>
                        @enderror>

                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input name="question[question]" value="{{old('question.question')}}" type="text" class="form-control" id="question" aria-describedby="questionHelp" placeholder="Enter Question">
                            <div id="questionHelp" class="form-text">Give your question</div>
                            @error('question.question')
                            <span class="text-danger">{{ 'Question title is Required' }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <fieldset>
                                <legend>Question Answer Type</legend>
                                <label for="select">Choose Question Type:</label>

                                <select name="question[questionType]" id="select" class="form-select" aria-label="Default select example">
                                    <option  selected>Select Question Type</option>
                                    <option  value="radio" >Radio</option>
                                    <option  value="check">Check</option>
                                    <option  value="textBox">Text</option>
                                    <option  value="simple">Simple Input</option>
                                    <option  value="date">Date</option>
                                </select>
                            </fieldset>

                                <!-- RADIO QUESTION TYPE -->
                            <div id="radio_input" style="display: none">
                                <div class="callout callout-info">
                                    <table width="100%" class="table">
                                        <colgroup>
                                            <col width="10%">
                                            <col width="80%">
                                            <col width="10%">
                                        </colgroup>
                                        <thead>
                                            <tr class="">
                                                <th class="text-center"></th>

                                                <th class="text-center">
                                                    <label for="" class="control-label">Choices</label>
                                                </th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="">
                                                <td class="text-center">
                                                    <div class="icheck-primary d-inline" data-count = '1'>
                                                        <input type="radio" id="answer1" name="label[]" checked="">
                                                        <label for="answer1">
                                                        </label>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <input type="text" id="radio1" class="form-control form-control-sm check_inp"  name="answers[][answer]">
                                                </td>
                                                <td class="text-center"></td>
                                            </tr>

                                            <tr class="">
                                                <td class="text-center">
                                                    <div class="icheck-primary d-inline" data-count = '2'>
                                                        <input type="radio" id="answer2" name="label[]" checked="">
                                                        <label for="answer2">
                                                        </label>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <input type="text" id="radio2" class="form-control form-control-sm check_inp"  name="answers[][answer]">
                                                </td>
                                                <td class="text-center"></td>
                                            </tr>

                                        </tbody>

                                    </table>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <button class="btn btn-sm btn-flat btn-default" type="button" onclick="new_radio($(this))"><i class="fa fa-plus"></i> Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF RADIO QUESTION TYPE -->

                            <!-- TEXTFIELD QUESTION TYPE -->
                            <div id="textfield_input" style="display: none">
                                <br>
                                <div class="form-outline-dark mb-4">
                                    <textarea class="form-control" id="textBox" name="answers[][answer]" rows="4" value="Write Something here..." placeholder="Text"></textarea>
                                </div>
                            </div>
                            <!-- END OF TEXTFIELD QUESTION TYPE -->

                            <!-- SIMPLE INPUT QUESTION TYPE -->
                            <div id="simple_input" style="display: none">
                                <br>
                                <div class="form-check mb-4">
                                    <input type="text" id="simpleInput" name="answers[]answer" value="input" class="form-control" >
                                </div>
                            </div>
                            <!-- END OF SIMPLE INPUT QUESTION TYPE -->

                            <!-- DATE QUESTION TYPE -->
                            <div id="date_input" style="display: none">
                                <br>
                                <div class="form-check mb-4">
                                    <input type="date" id="dateInput" name="answers[]answer" value="dd/mm/yyyy" class="form-control form-icon-trailing" >
                                </div>
                            </div>
                            <!-- END OF DATE QUESTION TYPE -->

                            <!-- CHECKBOX QUESTION TYPE -->
                            <div id="check_input"  style="display: none">
                                <div class="callout callout-info">
                                    <table width="100%" class="table">
                                        <colgroup>
                                            <col width="10%">
                                            <col width="80%">
                                            <col width="10%">
                                        </colgroup>
                                        <thead>
                                            <tr class="">
                                                <th class="text-center"></th>

                                                <th class="text-center">
                                                    <label for="" class="control-label">Check List</label>
                                                </th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="">
                                                <td class="text-center">
                                                    <div class="icheck-primary d-inline" data-count = '1'>
                                                        <input type="checkbox" id="check1" name="label[]" checked="">
                                                        <label for="answer1">
                                                        </label>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <input type="text" id="checkBox1" class="form-control form-control-sm check_inp" name="answers[][answer]">
                                                </td>
                                                <td class="text-center"></td>
                                            </tr>
                                            <tr class="">
                                                <td class="text-center">
                                                    <div class="icheck-primary d-inline" data-count = '2'>
                                                        <input type="checkbox" id="answer2" name="label[]" checked="">
                                                        <label for="answer2">
                                                        </label>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <input type="text" id="checkBox2" class="form-control form-control-sm check_inp" name="answers[][answer]">
                                                </td>
                                                <td class="text-center"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <button class="btn btn-sm btn-flat btn-default" type="button" onclick="new_check($(this))"><i class="fa fa-plus"></i> Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF CHECKBOX QUESTION TYPE -->
                            <br>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success btn-sm">Add New question</button>
                              </div>

                        </div>

                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection

@endsection
