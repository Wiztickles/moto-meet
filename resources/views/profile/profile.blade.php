@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center box profile">
            <h2>{{$user->username}}</h2>
            <p><b>Email:</b> {{ $user->email }}</p>
            <p><b>City:</b> {{ $user->city }}</p>
            <p><b>Motorcycle:</b> {{ $user->motorcycle }}</p>
            <p><b>Bio:</b> {!! nl2br($user->bio) !!}</p>
        </div>
        <div>
            <div class="col-md-8 col-md-offset-2 top_pad profile_border bot_pad">
                <h3 class="white">Upcoming MotoMeet Ups:</h3>
            
           @foreach($attends as $item)
               <div class="col-md-12 upcoming_meets">
                   <a href="{{ url('/meet')}}/{{$item->meet_id}}"><h3>{{$item->meet->title}}</h3></a>
                   <div class="meet_deets flex-row flex-j-between">
                       <p><b>Location:</b> {{ $item->meet->location }}</p>
                       <p><b>Date:</b> {{ \Carbon\Carbon::parse($item->meet_date)->format('d/m/Y')}}</p>
                       <p><b>Time:</b> {{ \Carbon\Carbon::parse($item->meet_date)->format('H:m A')}}</p>
                   </div>
               </div>
           @endforeach 
            </div>
        </div>
        <div>
            <div class="col-md-8 col-md-offset-2 top_pad profile_border bot_pad">
                <h3 class="white">MotoMeet Ups created by: {{$user->username}}</h3>
            
           @foreach($meets as $item)
               <div class="col-md-12 upcoming_meets">
                   <a href="{{ url('/meet')}}/{{$item->id}}"><h3>{{$item->title}}</h3></a>
                   <div class="meet_deets flex-row flex-j-between">
                       <p><b>Location:</b> {{ $item->location }}</p>
                       <p><b>Date:</b> {{ \Carbon\Carbon::parse($item->meet_date)->format('d/m/Y')}}</p>
                       <p><b>Time:</b> {{ \Carbon\Carbon::parse($item->meet_date)->format('H:m A')}}</p>
                   </div>
               </div>
           @endforeach 
            </div>
        </div>
        <div>
            <div class="col-md-8 col-md-offset-2 top_pad profile_border bot_pad">
                <h3 class="white">Comments by: {{$user->username}}</h3>
            
           @foreach($comments as $item)
               <div class="col-md-12 upcoming_meets">
                   <a href="{{ url('/meet')}}/{{$item->meet_id}}"><h3>{{$item->comment}}</h3></a>
                   <div class="meet_deets flex-row flex-j-between">
                       <p><b>Meet Up:</b> {{ $item->meet->title }}</p>
                       <p><b>Date:</b> {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</p>
                       <p><b>Time:</b> {{ \Carbon\Carbon::parse($item->created_at)->format('H:m A')}}</p>
                   </div>
               </div>
           @endforeach 
            </div>
        </div>
    </div>
</div>
@endsection
