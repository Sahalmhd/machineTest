<!-- filepath: /C:/Users/sahal/Desktop/machinetest/student_manager/resources/views/students/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Students List</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Subjects</th>
                <th>Marks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>
                        <ul class="list-unstyled mb-0">
                            @foreach($student->marks as $mark)
                                <li>{{ $mark->subject }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class="list-unstyled mb-0">
                            @foreach($student->marks as $mark)
                                <li>{{ $mark->marks }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm mb-1">View</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>