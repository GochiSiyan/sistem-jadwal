<x-layout>
    <h2>User</h2>

    <form action="/user" method="post">
        @csrf
        @method('POST')
        
        <table>
            <tr>
                <th>Name</th>
                <th>Role</th>
            </tr>
            <tr>
                <td><input type="text" name="name" id="name"></td>
                <td>
                    <select name="role" id="role">
                        <option value="admin">Admin</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" value="Create User">
    </form>

    <hr>

    <table>
        <tr>
            <th>
                Name
            </th>
            <th>
                Role
            </th>
            <th>
                Remove
            </th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->role}}
                </td>
                <td>
                    <form action="/user/{{$user->id}}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="submit" value="X">
                </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$users->links()}}
</x-layout>