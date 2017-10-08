@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 flex-row flex-a-center flex-j-between head_btn">
            <h1 class="head_white">Past Meets</h1>
            @if(Auth::check())
                <a href="{{ url('/meet/create')}}" class="btn btn-default bot_mar">Create a new meet</a>
            @endif
        </div>
        @foreach($meet as $item)
            <div class="col-md-8 col-md-offset-2 upcoming_meets">
                <a href="{{ url('/meet')}}/{{$item->id}}"><h3>{{$item->title}}</h3></a>
                <div class="meet_deets flex-row flex-j-between">
                    <p><b>Location:</b> {{ $item->location }}</p>
                    <p><b>Date:</b> {{ \Carbon\Carbon::parse($item->meet_date)->format('d/m/Y')}}</p>
                    <p><b>Time:</b> {{ \Carbon\Carbon::parse($item->meet_date)->format('H:m A')}}</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>{!! nl2br ($item->description) !!}</p>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                
            </div>
        @endforeach
        <div class="col-md-8 col-md-offset-2 text-center paginate">
            {{ $meet->links() }}
        </div>
    </div>

</div>
@endsection
