<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Student Details</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $student->name }}</h2>
        </div>
        <div class="card-body">
            <h5>Subjects and Marks:</h5>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student->marks as $mark)
                        <tr>
                            <td>{{ $mark->subject }}</td>
                            <td>{{ $mark->marks }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('students.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
</body>
</html>