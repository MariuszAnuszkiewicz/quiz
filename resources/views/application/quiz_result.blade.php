@extends('layouts.app')

@section('content')
    @auth
    @if ($countTrueResults <= 21)
     <div class="content-table">
       <table border='1' id='table-result' style='border-collapse: collapse;'>
         <thead class="thead-dark">
           <tr>
             <th>id</th>
             <th>user id</th>
             <th>result</th>
             <th>question number</th>
           </tr>
         </thead>
         <tbody>
         @foreach($results as $result)
           <tr>
             <td><p>{{ $result->id }}</p></td>
             <td><p>{{ $result->user_id }}</p></td>
             <td><p>{{ $result->result }}</p></td>
             <td><p>{{ $result->question_number }}</p></td>
           </tr>
         @endforeach
         </tbody>
       </table>
         <span class="btn-close"></span>
         <div id="grid" data-percentage="{{ $resultToPercent }}">
             <div class="col-8 pic-1">
                 <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                     <circle id="circle"
                             cx="-100"
                             cy="100"
                             r="68"
                             style="stroke-dashoffset:430px;"
                             stroke-dasharray="430"
                             stroke-width="15px"
                             stroke="#4b9a3a"
                             fill="#6da731"
                             stroke-dashoffset="60"
                             transform="translate(73,50) rotate(-90)" >

                     </circle>
                     <text id="text"
                           x="130"
                           y="160"
                           fill="#fff"
                           font-family="Verdana"
                           font-size="28">
                     </text>
                 </svg>
             </div>
         </div>
         <div class="results">
             Liczba poprawnych odpowiedzi to <br>
             <b>{{ $countTrueResults }}</b> z 21
         </div>
     </div>
    @endif
    @endauth
@endsection

