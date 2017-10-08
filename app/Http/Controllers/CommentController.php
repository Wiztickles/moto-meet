<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($id, Request $request)
    {
    	$this->validate($request, [
    	    'comment' => 'required',
    	]);
    	

    	$comment = new Comment;
    	$meet_id = $request->get('news_id');

    	$comment->user_id = $request->get('user_id');
    	$comment->meet_id = $request->get('meet_id');
    	$comment->comment = $request->get('comment');

    	
    	$comment->save();

    	return redirect('/meet/'.$comment->meet_id);


    }

    public function edit($id)
    {
    	$comment = Comment::find($id);

    	if($comment->user_id != Auth::user()->id || $comment->deleted === 1 ) {
    	    return redirect()->route('home');
    	}
    	
    	return view('/comment/edit',compact('comment'));
    }

    public function update($id, Request $request)
    {	
    	$this->validate($request, [
    	    'comment' => 'required',
    	]);

    	$comment = Comment::find($id);

    	$comment->comment = $request->get('comment');
    	$comment->save();
    		
    	return redirect('/meet/'.$comment->meet_id);
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);

        if(Auth::user()->admin != 1 && $comment->user_id != Auth::user()->id || $comment->deleted === 1 ) {
            return redirect()->route('home');
        }
        return view('/comment/delete',compact('comment'));
    }

    public function delete($id, Request $request)
    {
        $comment = Comment::find($id);

        $comment->deleted = $request->get('deleted');

        $comment->save();
        return redirect('/meet/'.$comment->meet_id);
    }
}
