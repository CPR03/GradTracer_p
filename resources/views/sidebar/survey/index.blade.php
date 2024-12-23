<div class="form-all">
  <ul class="page-section">
          <li>
              <div class="form-header-group header-large">
                  <div class="header-text httal htvam">
                  
                      <h1 id="header_1" class="form-header">
                      
                          {{ $questionnaire->title }}
                          
                      </h1>
                      
                      <div id="subHeader_1" class="form-subHeader">
                      Thank you for taking the time to answer these questions. The following questions are about to know how well known and successful is [Site Name]
                      </div>
                      <div class="text-end">
                          <a href="/admin/questionnaires/{{ $questionnaire->id }}/questions/create" class="btn btn-success btn-sm">Add New question</button></a>
                      </div>
                  </div>
              </div>
          </li>

          <li>
              <div class="form-header-group header-large">
                  <div class="header-text httal htvam">
                  
                      <h1 id="header_1" class="form-header">
                              {{ $section->section_name }}
                      </h1>
                      
                      <div class="text-end">
                          <a href="/admin/questionnaires/{{ $questionnaire->id }}/questions/create" class="btn btn-success btn-sm">Add New question</button></a>
                      </div>
                  </div>
              </div>
          </li>

          
              @foreach($questionnaire->questions as $key => $question)
              
              <li class="form-line">
              <div class="card">
              <div class="card-header" style="background-color: #3a0000; color: white">
                  <strong >{{ $key + 1 }}.</strong>
                  <span class="fw-bold">{{ $question->question }}</span>
              </div>
              <div class="card-body">

              <ul class="list-group">
                  @foreach($question->answers as $answer)
                  <label for="answer{{ $answer->id }}">

                  @if($question->questionType == 'radio')
                  <li class="list-form-line">
                      <div class="form-check mb-3 ">
                          <input style="margin-left: 1px;" class="form-check-input" type="radio" name="responses[{{ $key }}][answer_id]" id="answer{{ $answer->id }}"  value="{{ $answer->id }}">{{ $answer->answer }}
                      </div>
                  </li>
                  @endif

                  @if($question->questionType == 'check')
                  <li class="list-form-line">
                      <div class="form-check mb-2">
                      <input type="checkbox" class="form-check-input" name="responses[{{ $key }}][answer_id]" id="answer{{ $answer->id }}" value="{{ $answer->id }}" class="mr-2">{{ $answer->answer }}
                  </div>
                  </li>
                  @endif
                  @if($question->questionType == 'textBox')
                  <li class="list-form-line">
                      <div class="form-check mb-2">
                      <textarea class="form-control" rows="4" name="responses[{{ $key }}][answer_id]" rows="2" cols="80" id="answer{{ $answer->id }}" value="{{ $answer->id }}" placeholder="{{ $answer->answer }}"></textarea>
                  </div>
                  </li>
                  @endif
                  @if($question->questionType == 'simple')
                  <li class="list-form-line">
                      <div class="form-check mb-2">
                          <input type="text" class="form-control">
                          <input type="hidden" class="form-control" name="responses[{{ $key }}][answer_id]" rows="2" cols="80" id="answer{{ $answer->id }}" value="{{ $answer->id }}" placeholder="{{ $answer->answer }}">
                      </div>
                  </li>
                  @endif
                  @if($question->questionType == 'date')
                  <li class="list-form-line">
                      <div class="form-check mb-2">
                          <input type="date" class="form-control form-icon-trailing" name="responses[{{ $key }}][answer_id]" rows="2" cols="80" id="answer{{ $answer->id }}" value="{{ $answer->id }}">
                      </div>
                  </li>
                  @endif
                  @endforeach
                   
                              
                          
              </label>
             
                </ul>
                <div class="text-end">
                  <button type="button" class="btn btn-danger">Delete</button>
                  <button type="button" class="btn btn-warning">Edit</button>
              </div>
              </div>
          </div>
          
              
              
              
          @endforeach
         
</ul>

</div>