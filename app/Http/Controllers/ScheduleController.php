<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedules; // モデル名を修正
use Illuminate\Support\Facades\DB;
use App\Models\Schedule; // Model追加忘れずに

class ScheduleController extends Controller
{
    public function show(){
        return view("calendars/calendar");
    }
    public function create(Request $request)
    {
        $request->validate([
            'schedule_title' => 'required', // フィールド名も修正
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $schedule = new Schedules(); // モデル名を修正
        $schedule->event_title = $request->input('schedule_title'); // フィールド名も修正
        $schedule->event_body = $request->input('schedule_body'); // フィールド名も修正
        $schedule->start_date = $request->input('start_date');
        $schedule->end_date = date("Y-m-d", strtotime("{$request->input('end_date')} +1 day"));
        $schedule->save();

        return redirect()->route("show", ['id' => $schedule->id]);
    }

    public function get(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date', // 日付のバリデーションを修正
            'end_date' => 'required|date', // 日付のバリデーションを修正
        ]);

        $schedules = Schedules::select(
            'id',
            'event_title as title',
            'event_body as description',
            'start_date as start',
            'end_date as end',
        )
            ->where('end_date', '>', $request->input('start_date'))
            ->where('start_date', '<', $request->input('end_date'))
            ->get();

        return response()->json($schedules);
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $schedule = Schedules::find($request->input('id'));
        if ($schedule) {
            $schedule->event_title = $input['event_title'];
            $schedule->event_body = $input['event_body'];
            $schedule->start_date = $input['start_date'];
            $schedule->end_date = date("Y-m-d", strtotime("{$input['end_date']} +1 day"));
            $schedule->save();
        }

        return redirect()->route("show", ['id' => $schedule->id]);
    }

    public function delete(Request $request)
    {
        $schedule = Schedules::find($request->input('id'));
        if ($schedule) {
            $schedule->delete();
        }

        return redirect()->route("show");
    }
    public function showCreateForm()
{
    return view('create_form'); // create_form ビューを表示
}
}
