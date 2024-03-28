<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    public function index(Request $request) {
    	if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
    	}
    	return view('Calendar.calendar');
    }

    public function action(Request $request) {
    	if($request->ajax()) {
    		// if($request->type == 'add') {
    		// 	$event = Event::create([
    		// 		'title'		=>	$request->title,
    		// 		'start'		=>	$request->start,
    		// 		'end'		=>	$request->end
    		// 	]);

    		// 	return response()->json($event);
    		// }

    		if($request->type == 'update')
    		{
    			$event = Event::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		// if($request->type == 'delete')
    		// {
    		// 	$event = Event::find($request->id)->delete();

    		// 	return response()->json($event);
    		// }
    	}
    }

	public function store(Request $request) {
		if ($request->id) {
			Event::findOrFail($request->id)->update([
				'title'		=>	$request->title,
				'start'		=>	$request->start,
				'end'		=>	$request->end
			]);
		} else {
			Event::create([
				'title'		=>	$request->title,
				'start'		=>	$request->start,
				'end'		=>	$request->end
			]);
		}
		return redirect('/admin/calendar');
    }

	public function edit(Request $request) {
		$data = Event::findOrFail($request->id);
        return response()->json($data);
    }

	public function delete(Request $request) {
		Event::destroy($request->delete_id);
		return redirect('/admin/calendar');
    }
}
