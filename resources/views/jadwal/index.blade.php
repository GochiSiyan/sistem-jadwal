<x-layout>
    <h2 class="flex justify-center text-xl font-bold p-5">Jadwal Mengajar</h2>

    <form action="/jadwal" method="get" class="p-3 rounded bg-yellow-100 text-center">
        <table class="mx-auto pb-2">
            <tr>
                <th>
                    Hari/tgl
                </th>
                <th>
                    Pengajar
                </th>
            </tr>
            <tr>
                <td>
                    <input type="date" class="rounded bg-gray-300" name="haritgl" id="haritgl" value="{{$_GET['haritgl'] ?? null}}">
                </td>
                <td>
                    <select name="pengajar" id="pengajar" class="rounded bg-gray-300">
                        <option value="">Select Teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}" {{(($_GET['pengajar'] ?? null) == $teacher->id) ? "selected" : ''}}>{{$teacher->name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" value="Filter" class="p-1 bg-blue-200 rounded">
        <a href="/jadwal" class="p-1 bg-red-200 rounded">Reset</a>
    </form>

    @if ($jadwals->total())
    <table class="mx-auto my-2 p-3 bg-green-100 rounded text-center">
        <tr>
            <th>Student</th>
            <th>Teacher</th>
            <th>From</th>
            <th>Lenght</th>
            <th>Room</th>
            <th>Cancel</th>
        </tr>
        @foreach ($jadwals as $jadwal)
            <tr>
                <td>
                    {{$jadwal->student}}
                </td>
                <td>
                    {{$jadwal->teacher}}
                </td>
                <td>
                    {{$jadwal->from}}
                </td>
                <td>
                    {{$jadwal->length}}
                </td>
                <td>
                    {{$jadwal->room}}
                </td>
                <td>
                    <form action="/jadwal/{{$jadwal->id}}" method="post" class="bg-red-100 rounded p-1">
                        @csrf
                        @method('DELETE')

                        <input type="submit" value="X">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @else
        <div class="mx-auto my-2 p-3 bg-green-100 rounded text-center">
            <p>NO DATA. Please use another filter</p>
        </div>
    @endif

    <div class="pagination">
        {{$jadwals->links()}}
    </div>

    <form action="/jadwal" method="post" class="bg-blue-100 rounded p-3">
        @csrf
        @method('POST')

        <table>
            <tr>
                <th>
                    Student
                </th>
                <th>
                    Teacher
                </th>
                <th>
                    From
                </th>
                <th>
                    Length
                </th>
                <th>
                    Room
                </th>
            </tr>
            <tr>
                <td>
                    <select name="student" id="student">
                        @foreach ($students as $student)
                            <option value="{{$student->id}}">{{$student->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="teacher" id="teacher">
                        @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="date" name="from-date" id="from-date">
                    <input type="time" step="1800" name="from-time" id="from-time">
                </td>
                <td>
                    <select name="time" id="time">
                        <option value="00:30:00">30 Minutes</option>
                        <option value="01:00:00">1 Hour</option>
                        <option value="01:30:00">1.5 Hours</option>
                        <option value="02:00:00">2 Hours</option>
                    </select>
                </td>
                <td>
                    <select name="room" id="room">
                        <option value="0">No Room</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </td>
                <td>
                    <input type="submit" value="Add" class="rounded p-1 bg-green-200 border-green-800 border">
                </td>
            </tr>
        </table>
    </form>
</x-layout>