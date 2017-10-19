@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div>
            <div class=" green profile_border white flex-row flex-j-around flex-a-center">
                <h2>Motorcyclist: <b>{{$users}}</b></h2>
                <h2>MotoMeets: <b>{{$meets}}</b></h2>
            </div>
            <div class="home top_pad">
                <h1 class="">MotoMeet</h1>
                <p>MotoMeet is about a website for people that love to ride!  Our goal is to experience as much riding as possible on all the roads that California has to offer and possibly some rides outside of California as time and schedules allow. Though MotoMeet originated in Hollister, we begin our meetups and ride to all areas. </p>
                <p>We are located in such a beautiful area that offers the very best in roads and scenery. North to Marin, Mendocino, south down the coast or a winter trip to the desert. East to the foothills and on to the Sierra’s. So many options, so little time!</p>
                <p>There are not a lot of rules with the group, but we do ask that you be respectful of all members, safety is a priority, and be courteous to riders and cars alike. If you have group riding experience, you know the majority of the do’s and don'ts.</p>
            </div>
            <div class="top_pad">
                <div class="col-md-12 flex-row flex-a-center flex-j-between head_btn">
                    <h1 class="head_white">Upcoming Meets</h1>
                </div>
                @foreach($upcoming as $item)
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

    </div>
</div>
@endsection
