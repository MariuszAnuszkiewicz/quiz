@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-10">
           <div class="card">
               <ul id="loadbar"></ul>
               @foreach($ids as $id)
                  <div id="page"><b>Pytanie</b> {{ $id->id - 1 }} z {{ isset($quantityResults) ? ($quantityResults - 1) : null }}</div>
               @endforeach
               <div class="card-header">Quiz Content</div>
               <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @auth
                    @foreach($ids as $id)
                    <div class="form-check">
                           {{ Form::open(['route' => ['quiz_run', 'id' => $id->id], 'method' => 'POST', 'id' => 'qForm']) }}
                    @endforeach
                        @csrf
                        @foreach($fields as $field)
                    <div class="col-md-22">
                       {!! Html::decode(Form::label("question", '<h5>Pytanie:</h5> ' . "<b>$field->question</b>", ['class' => 'control-label'])) !!}
                    </div>
                        @php
                          define('QUANTITY_FIELDS', 4);
                        @endphp
                        @for($i = 1; $i <= QUANTITY_FIELDS; $i++)
                            <div class="col-md-10">
                               {{ Form::checkbox('answer[]', $field->{'answer_'.$i}, false, ["class" => "checkbox-group"]) }}
                               @if(preg_match("/no/", $field->{'answer_'.$i}))
                                  {{ Form::label(substr($field->{'answer_'.$i}, 0, strlen($field->{'answer_'.$i}) - 4)) }}
                               @elseif(preg_match("/yes/", $field->{'answer_'.$i}))
                                  {{ Form::label(substr($field->{'answer_'.$i}, 0, strlen($field->{'answer_'.$i}) - 5)) }}
                               @endif
                            </div>
                        @endfor
                        @endforeach
                       {{ Form::submit('next', ['name' => 'next-btn', 'id' => 'next-quiz-btn', 'class' => 'btn btn-danger']) }}
                       {{ Form::close() }}
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endauth
@endsection
