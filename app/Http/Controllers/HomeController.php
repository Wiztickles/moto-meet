<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Meet;
use App\User;
use App\Comment;
use App\Attend;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::count();
        $meets = Meet::where('deleted',0)->count();
        $now = Carbon::now();
        $upcoming = Meet::where([['deleted', '=', 0],['meet_date', ">", $now ]])->orderBy('meet_date','asc')->paginate(3); 
        return view('home',compact('users', 'meets', 'upcoming'));
    }

    public function rules()
    {
        return view('rules');
    }

    public function profileEdit($id)
    {
        $user = User::find($id);

        if($user->id != Auth::user()->id) {
            return redirect()->route('home');
        }
        return view('profile/edit', compact('user'));
    }

    public function profile($id)
    {

        $user = User::find($id);

        $comments = Comment::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(5)->get();
        $attends = Attend::where('deleted',0)->where([['user_id', $id],['attending', '1']])->orderBy('id','desc')->take(5)->get();
        $meets = Meet::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(5)->get();

        return view('profile/profile', compact('user','comments','attends', 'meets'));
    }

        public function update($id,Request $request){
            $user = User::find($id);

            $this->validate($request, [
                'username' => 'required|max:255',
                'email' => 'required|max:255|unique:users,email,'.$user->id,
            ]);


            $user->username = $request->get('username');
            $user->email = $request->get('email');
            $user->city = $request->get('city');
            $user->motorcycle = $request->get('motorcycle');
            $user->bio = $request->get('bio');

            $user->save();
            return redirect('/profile/'.$user->id);
        }
}
