@extends('layouts.form_layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Meet</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/meet/edit/'.$meet->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title',$meet->title) }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group{{ $errors->has('meet_date') ? ' has-error' : '' }}">
                           <label for="meet_date" class="col-md-4 control-label">Meet Date and Time</label>

                           <div class="col-md-6">
                               <div class='input-group date' id='datetimepicker4'>
                                   <input id="meet_date" type="date_time" class="form-control" name="meet_date" placeholder="Please use the date picker to the right"value="{{ old('meet_date',$meet->meet_date) }}">
                                   <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                   </span>
                               </div>

                               @if ($errors->has('meet_date'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('meet_date') }}</strong>
                                   </span>
                               @endif
                           </div>
                       </div>
                        
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Location</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" value="{{ old('location', $meet->location) }}">

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                            <label for="lng" class="col-md-4 control-label">Longitude</label>

                            <div class="col-md-6">
                                <input id="lng" type="text" class="form-control" name="lng" placeholder="This can be found on Google Maps" value="{{ old('lng',$meet->lng) }}">

                                @if ($errors->has('lng'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lng') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lat',$meet->lat) ? ' has-error' : '' }}">
                            <label for="lat" class="col-md-4 control-label">Latitude</label>

                            <div class="col-md-6">
                                <input id="lat" type="text" class="form-control" name="lat" placeholder="This can be found on Google Maps" value="{{ old('lat',$meet->lat) }}">

                                @if ($errors->has('lat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" name="description" class="form-control" rows="5">
                                    {{ old('description', $meet->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Edit Meet
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
