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
			try {
				Event::findOrFail($request->id)->update([
					'title'		=>	$request->title,
					'admin_id'	=>	$request->user,
					'start'		=>	$request->start,
					'end'		=>	$request->end
				]);
				session()->flash('update_calendar', 'Calendar was update successfully!');
			} catch ( \Exception $e ) {
				session()->flash('update_error_calendar', 'calendar update unsuccessful');
				return redirect('/admin/calendar');
			}
		} else {
			try {
				Event::create([
					'title'		=>	$request->title,
					'admin_id'	=>	$request->user,
					'start'		=>	$request->start,
					'end'		=>	$request->end
				]);
				session()->flash('create_calendar', 'Calendar create successfully!');
			} catch ( \Exception $e ) {
				session()->flash('create_error_calendar', 'Calendar create unsuccessful!');
				return redirect('/admin/calendar');
			}
		}
		return redirect('/admin/calendar');
    }

	public function edit(Request $request) {
		$data = Event::findOrFail($request->id);
        return response()->json($data);
    }

	public function delete(Request $request) {
		try {
			Event::destroy($request->delete_id);
			session()->flash('delete_calendar', 'Calendar was delete successfully!');
			return redirect('/admin/calendar');
		} catch ( \Exception $e ) {
			session()->flash('delete_error_calendar', 'Calendar delete unsuccessful!');
			return redirect('/admin/calendar');
		}
    }
}
