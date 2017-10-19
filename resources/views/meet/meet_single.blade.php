@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row box">
        <div class="col-md-8 col-md-offset-2">
            @if($meet->deleted === 1)
                <h2>This Meet was deleted</h2>
            @else
                <div class="info">
                    <div class="meet_tile flex-row flex-j-between flex-a-center bot_mar">
                        <h1 class="title_max">{{$meet->title}}</h1>
                        @if(Auth::check())
                            @if($status === null)
                                <form class="" role="form" method="POST" action="{{ url('attend') }}">
                                    {{ csrf_field() }}
                                    <input id="meet_id" type="hidden" class="" name="meet_id" value="{{$meet->id}}">
                                    <input id="user_id" type="hidden" class="" name="user_id" value={{Auth::user()->id}}>
                                    <div class="">
                                        <button type="submit" formmethod="post" formaction="/not_attending" class="btn btn-default">
                                            <i class="fa fa-btn fa-times"></i> Not Attending
                                        </button>
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-btn fa-check"></i> Attending
                                        </button>
                                    </div>
                                </form>
                            @elseif($status->attending === 0)
                                <form class="" role="form" method="POST" action="{{ url('attend') }}">
                                    {{ csrf_field() }}
                                    <input id="meet_id" type="hidden" class="" name="meet_id" value="{{$meet->id}}">
                                    <input id="user_id" type="hidden" class="" name="user_id" value={{Auth::user()->id}}>
                                    <div class="">
                                        <button type="submit" formmethod="post" formaction="/not_attending" class="btn btn-success">
                                            <i class="fa fa-btn fa-times"></i> Not Attending
                                        </button>
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-btn fa-check"></i> Attending
                                        </button>
                                    </div>
                                </form>
                            @elseif($status->attending === 1)
                                <form class="" role="form" method="POST" action="{{ url('attend') }}">
                                    {{ csrf_field() }}
                                    <input id="meet_id" type="hidden" class="" name="meet_id" value="{{$meet->id}}">
                                    <input id="user_id" type="hidden" class="" name="user_id" value={{Auth::user()->id}}>
                                    <div class="">
                                        <button type="submit" formmethod="post" formaction="/not_attending" class="btn btn-default">
                                            <i class="fa fa-btn fa-times"></i> Not Attending
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-btn fa-check"></i> Attending
                                        </button>
                                    </div>
                                </form>
                            @endif
                        @endif
                    </div>
                    <div class="meet_deets flex-row flex-j-between">
                        <p><b>Location:</b> {{ $meet->location }}</p>
                        <p><b>Date:</b> {{ $date }}</p>
                        <p><b>Time:</b> {{ $time }}</p>
                        <p><b>Riders attending:</b> {{ $attends }}</p>
                    </div>
                    <p>{!! nl2br($meet->description) !!}</p>
                </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="bot_pad_1" style="width: 100%; height: 400px;">
                {!! Mapper::render() !!}
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2 bot_pad_1">
            <b>Created by: </b><a href="{{url('profile')}}/{{$meet->user->id}}">{{$meet->user->username}}</a>

            @if (Auth::check())
                @if(Auth::user()->id === $meet->user_id)
                    <a href="{{ url('/meet/edit/')}}/{{$meet->id}}" class="pull-right edit_padding"><i class="fa fa-btn fa-gear"></i> Edit Meet</a>
                @endif
                @if(Auth::user()->id === $meet->user_id || Auth::user()->admin === 1)
                    <a href="{{ url('/meet/delete')}}/{{$meet->id}}" class=" pull-right"><i class="fa fa-btn fa-times"></i> Delete Meet</a>
                @endif
            @endif
        </div>
    </div>
    <div class="row box top_pad">
        <div class="col-md-8 col-md-offset-2">
            <h3>Comments</h3>
            @if(Auth::check())
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div id="pad_bot_remove" class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/meet/'.$meet->id).'/comment' }}">
                                    {{ csrf_field() }}
                                    <input id="meet_id" type="hidden" class="" name="meet_id" value="{{$meet->id}}">
                                    <input id="user_id" type="hidden" class="" name="user_id" value={{Auth::user()->id}}>

                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                                        <div class="col-lg-12">
                                        <textarea id="comment" name="comment" class="form-control" rows="2" placeholder="Comment on this Meet"></textarea>

                                            @if ($errors->has('comment'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('comment') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <i class="fa fa-btn fa-comment"></i> Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($comments->isEmpty())
                <div class="row gutter-20">
                    <div class="col-md-8 col-md-offset-2">
                        <div>
                            <div class='col-lg-12 comments'>
                                <div class="comment_content bot_pad_1">
                                    <p>There are no comments on this meet up</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @foreach($comments as $comment)
                    <div class="col-md-12 col-md-offset-0">
                        <div class="comment">
                            <div>
                                <a href="{{ url('profile/')}}/{{$comment->user->id}}">
                                    <b>{{$comment->user->username}}</b>
                                </a>
                            </div>
                            <p id="comment_date">{{$comment->created_at->format('d/m/Y')}}</p>

                            <div class="comment_content">
                                <p>{!! nl2br($comment->comment) !!}</p>
                            </div>
                            <div class="flex-row flex-j-end">
                                @if (Auth::check())
                                    @if(Auth::user()->id === $comment->user_id || Auth::user()->admin === 1)
                                        <a href="{{ url('/comment/delete')}}/{{$comment->id}}" class=""><i class="fa fa-btn fa-times"></i> Delete Comment</a>
                                    @endif
                                    @if(Auth::user()->id === $comment->user_id) 
                                        <a href="{{ url('/comment/edit')}}/{{$comment->id}}" class="edit_padding"><i class="fa fa-btn fa-gear"></i> Edit Comment</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    <div class="flex-row flex-j-center">
                        {{ $comments->links() }}    
                    </div>
                </div>
            @endif
        </div>
        
    </div>
        @endif
</div>

@endsection
