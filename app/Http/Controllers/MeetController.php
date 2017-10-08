<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Meet;
use App\User;
use App\Comment;
use App\Attend;
use Carbon\Carbon;
use Auth;
use Mapper;

class MeetController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth')->except('index','show','pastMeet');
	}

   public function index()
   {
      $now = Carbon::now();
       $meet = Meet::where([['deleted', '=', 0],['meet_date', ">", $now ]])->orderBy('meet_date','asc')->with('User')->paginate(10); 

       return view('meet/upcoming',compact('meet', 'date', 'time', 'attends'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

   public function pastMeet()
   {
       $now = Carbon::now();
        $meet = Meet::where([['deleted', '=', 0],['meet_date', "<", $now ]])->orderBy('meet_date','asc')->with('User')->paginate(10); 

        return view('meet/past_meet',compact('meet', 'date', 'time', 'attends'));
   }
   public function create()
   {
       return view('/meet/create');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       $this->validate($request, [
           'title' => 'required|max:255',
           'description' => 'required',
           'meet_date' => 'required|max:255',
           'location' => 'required',
           'lng' => 'required|max:255',
           'lat' => 'required',
       ]);


       $meet = new Meet;

       $meet->title = $request->get('title');
       $meet->description = $request->get('description');
       $meet->meet_date = $request->get('meet_date');
       $meet->location = $request->get('location');
       $meet->lng = $request->get('lng');
       $meet->lat = $request->get('lat');
       $meet->user_id = $request->get('user_id');
       $meet->save();

       return redirect('/meet/'.$meet->id);


   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       $meet = Meet::find($id);
       $attends = Attend::where([['meet_id', $meet->id],['attending', 1]])->count();
       $comments = Comment::where('meet_id', $id)->where('deleted', 0)->orderBy('id','desc')->paginate(10);
       $date = Carbon::parse($meet->meet_date)->format('d/m/Y');
       $time = Carbon::parse($meet->meet_date)->format('H:i A');

       if(Auth::check()) {
        $status = Attend::where([['meet_id', $meet->id],['user_id', Auth::user()->id]])->first();
       }

       Mapper::map($meet->lng, $meet->lat, ['zoom' => 13, 'markers' => ['animation' => 'DROP'],'cluster' =>false]);
       Mapper::informationWindow($meet->lng, $meet->lat, $meet->location,['open' => true]);


       return view('/meet/meet_single' ,compact('meet', 'comments', 'date','time', 'attends', 'status'));


   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       $meet = Meet::find($id);

       if($meet->user_id != Auth::user()->id || $meet->deleted === 1 ) {
           return redirect()->route('home');
       }

       return view('/meet/edit',compact('meet'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
       $meet = Meet::find($id);

       $this->validate($request, [
	       	'title' => 'required|max:255',
	       	'description' => 'required',
	       	'meet_date' => 'required|max:255',
	       	'location' => 'required',
	       	'lng' => 'required|max:255',
	       	'lat' => 'required',
       	]);

       $meet->title = $request->get('title');
       $meet->description = $request->get('description');
       $meet->meet_date = $request->get('meet_date');
       $meet->location = $request->get('location');
       $meet->lng = $request->get('lng');
       $meet->lat = $request->get('lat');
       $meet->save();

       return redirect('/meet/'.$meet->id);
   }

   public function delete(Request $request, $id)
   {
       $meet = Meet::find($id);

       $meet->deleted = $request->get('deleted');

       $meet->save();

       return redirect('/meet/'.$meet->id);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function deleteMeet($id)
   {
       $meet = meet::find($id);


       if(Auth::user()->admin != 1 && $meet->user_id != Auth::user()->id || $meet->deleted === 1 ) {
           return redirect()->route('home');
       }
       return view('/meet/delete',compact('meet'));
   }
}
