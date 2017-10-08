<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Attend;
use Auth;

class AttendController extends Controller
{
	public function attending(Request $request)
	{	
		$meet_id = $request->get('meet_id');

		$attend = Attend::where([
			['user_id', '=', $request->get('user_id')],
			['meet_id', '=', $request->get('meet_id')],
			])->first();

		if ($attend === null) {
			$attend1 = New Attend;
			$attend1->user_id = $request->get('user_id');
			$attend1->meet_id = $request->get('meet_id');
			$attend1->attending = 1;
			$attend1->save();

			return redirect('/meet/'.$attend1->meet_id);
		} else {
			$attend->attending = 1;
			$attend->save();
			return redirect('/meet/'.$attend->meet_id);
		}
	}

	public function notAttending(Request $request)
	{	
		$attend = Attend::where([
			['user_id', '=', $request->get('user_id')],
			['meet_id', '=', $request->get('meet_id')],
			])->first();

		if ($attend === null) {
			$attend1 = New Attend;
			$attend1->user_id = $request->get('user_id');
			$attend1->meet_id = $request->get('meet_id');
			$attend1->attending = 0;
			$attend1->save();
			return redirect('/meet/'.$attend1->meet_id);
		} else {
			$attend->attending = 0;
			$attend->save();
			return redirect('/meet/'.$attend->meet_id);
		}
	}
}
