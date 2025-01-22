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
            @foreach($students as $studentId => $studentGroup)
                <tr>
                    <td>{{ $studentGroup->first()->name }}</td>
                    <td>
                        <ul class="list-unstyled mb-0">
                            @foreach($studentGroup as $student)
                                <li>{{ $student->subject }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class="list-unstyled mb-0">
                            @foreach($studentGroup as $student)
                                <li>{{ $student->marks }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('students.show', $studentId) }}" class="btn btn-info btn-sm mb-1">View</a>
                        <a href="{{ route('students.edit', $studentId) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                        <form action="{{ route('students.destroy', $studentId) }}" method="POST" style="display:inline;">
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