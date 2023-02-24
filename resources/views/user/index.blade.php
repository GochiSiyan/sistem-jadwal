<x-layout>
    <h2 class="flex justify-center text-xl font-bold p-5">User</h2>

    <form action="/user" method="post" class="p-3 rounded bg-yellow-100 text-center">
        @csrf
        @method('POST')
        
        <table class="mx-auto pb-2">
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
        <input class="p-1 bg-blue-200 rounded" type="submit" value="Create User">
    </form>

    <hr>

    <table class="mx-auto my-2 p-3 bg-green-100 rounded text-center">
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
                    <form action="/user/{{$user->id}}" method="post" class="bg-red-100 rounded p-1">
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