<x-layout>
    <h2>Jadwal Mengajar</h2>

    <form action="/jadwal" method="get" class="p-3">
        <table>
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
                    <input type="date" name="haritgl" id="haritgl" value="{{$_GET['haritgl'] ?? null}}">
                </td>
                <td>
                    <select name="pengajar" id="pengajar">
                        <option value="">Select Teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}" {{(($_GET['pengajar'] ?? null) == $teacher->id) ? "selected" : ''}}>{{$teacher->name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" value="Filter">
        <a href="/jadwal">Reset</a>
    </form>

    @if ($jadwals->total())
    <table>
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
                    <form action="/jadwal/{{$jadwal->id}}" method="post">
                        @csrf
                        @method('DELETE')

                        <input type="submit" value="X">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @else
        <p>NO DATA. Please use another filter</p>
    @endif

    <div class="pagination">
        {{$jadwals->links()}}
    </div>

    <hr>

    <form action="/jadwal" method="post">
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
                        <option value="003000">30 Minutes</option>
                        <option value="010000">1 Hour</option>
                        <option value="013000">1.5 Hours</option>
                        <option value="020000">2 Hours</option>
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
                    <input type="submit" value="Add">
                </td>
            </tr>
        </table>
    </form>
</x-layout>