<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\JadwalMusik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class JadwalMusikController extends Controller
{
    public function index(JadwalMusik $jadwals) {
        $data = $jadwals
            ->select(['jadwal_musiks.id', 'jadwal_musiks.teacher_id', 'jadwal_musiks.student_id', 'jadwal_musiks.from', 'jadwal_musiks.length', 'jadwal_musiks.room', 'teachers.name as teacher', 'students.name as student'])
            ->join('users as teachers', 'jadwal_musiks.teacher_id', '=', 'teachers.id')
            ->join('users as students', 'jadwal_musiks.student_id', '=', 'students.id');

        if ($_GET['pengajar'] ?? false) $data = $data->where('jadwal_musiks.teacher_id', '=', $_GET['pengajar']);
        if ($_GET['haritgl'] ?? false) $data = $data->whereDate('jadwal_musiks.from', '=', $_GET['haritgl']);

        // dd($data
        // ->latest('jadwal_musiks.from')
        // ->paginate(10));

        return view('jadwal.index', [
            'jadwals' => $data
                ->latest('jadwal_musiks.from')
                ->paginate(10),
            'students' => $users = DB::table('users')->select(['id', 'name'])->where('role', 'student')->get(),
            'teachers' => $users = DB::table('users')->select(['id', 'name'])->where('role', 'teacher')->get(),
        ]);
    }

    public function store() {
        $request = request()->validate([
            'student' => 'required',
            'teacher' => 'required',
            'from-date' => 'required',
            'from-time' => 'required',
            'time' => 'required',
            'room' => 'required',
        ]);

        // validation rule
        // select teacher on that date
        $jadwals = DB::table('jadwal_musiks')
            ->select(['from', 'length'])
            ->whereDate('from', '=', $request['from-date'])
            ->where('teacher_id', $request['teacher'])
            ->get();
        $start = $request['from-date'] . ' ' . $request['from-time'];
        $end = Carbon::parse($start);
        $time = explode(':', $request['time']);
        $end->add('hour', $time[0])->add('minute', $time[1]);
        $range = CarbonPeriod::create($start, $end);

        foreach($jadwals as $jadwal) {
            $cstart = $jadwal->from;
            $cend = Carbon::parse($cstart);
            $ctime = explode(':', $jadwal->length);
            $cend->add('hour', $ctime[0])->add('minute', $ctime[1]);
            $crange = CarbonPeriod::create($cstart, $cend);
            // make sure the time range do not overlap with other time of that teacher schedule
            if ($range->overlaps($crange)) throw ValidationException::withMessages(['timeRange' => 'Teacher time range overlap, please choose another schedule']);
        }


        // if not available, room is automatically set to 0 and add it directly
        if ($request['student'] == '1') {
            $request['room'] = '0';
        } else {
            // select all student on that day
            $jadwals = DB::table('jadwal_musiks')
                ->select(['from', 'length'])
                ->whereDate('from', '=', $request['from-date'])
                ->where('student_id', $request['student'])
                ->get();
            // make sure the time range do not overlap with other time of that student schedule
            foreach($jadwals as $jadwal) {
                $cstart = $jadwal->from;
                $cend = Carbon::parse($cstart);
                $ctime = explode(':', $jadwal->length);
                $cend->add('hour', $ctime[0])->add('minute', $ctime[1]);
                $crange = CarbonPeriod::create($cstart, $cend);
                // make sure the time range do not overlap with other time of that teacher schedule
                if ($range->overlaps($crange)) throw ValidationException::withMessages(['timeRange' => 'Student time range overlap, please choose another schedule']);
            }
        }

        // select all room of that day unless the room is 0
        if ($request['room'] != '0') {
            $jadwals = DB::table('jadwal_musiks')
                ->select(['from', 'length'])
                ->whereDate('from', '=', $request['from-date'])
                ->where('room', $request['room'])
                ->get();
                // make sure the time range do not overlap with other time of that room on that day
                foreach($jadwals as $jadwal) {
                    $cstart = $jadwal->from;
                    $cend = Carbon::parse($cstart);
                    $ctime = explode(':', $jadwal->length);
                    $cend->add('hour', $ctime[0])->add('minute', $ctime[1]);
                    $crange = CarbonPeriod::create($cstart, $cend);
                    // make sure the time range do not overlap with other time of that teacher schedule
                    if ($range->overlaps($crange)) throw ValidationException::withMessages(['timeRange' => 'Room time range overlap, please choose another schedule']);
                }
        }

        JadwalMusik::create([
            'student_id' => $request['student'],
            'teacher_id' => $request['teacher'],
            'from' => $request['from-date'] . ' ' . $request['from-time'],
            'length' => $request['time'],
            'room' => $request['room'],
        ]);

        return redirect('/jadwal');
    }

    public function delete(JadwalMusik $jadwal)
    {
        $jadwal->delete();

        return redirect('/jadwal');
    }
}