<!-- filepath: /C:/Users/sahal/Desktop/machinetest/student_manager/resources/views/students/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST" class="student-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $student->name }}" required class="form-control">
        </div>
        <div id="subjects-container">
            @foreach($student->marks as $mark)
                <div class="subject form-group">
                    <label for="subjects[]">Subject:</label>
                    <input type="text" name="subjects[]" value="{{ $mark->subject }}" required class="form-control">
                    <label for="marks[]">Marks:</label>
                    <input type="number" name="marks[]" value="{{ $mark->marks }}" required min="0" max="100" class="form-control">
                    <button type="button" class="btn btn-danger btn-sm remove-subject" onclick="removeSubject(this)">Remove</button>
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addSubject()" class="btn btn-secondary">Add Subject</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
function addSubject() {
    const container = document.getElementById('subjects-container');
    const subjectDiv = document.createElement('div');
    subjectDiv.classList.add('subject', 'form-group');
    subjectDiv.innerHTML = `
        <label for="subjects[]">Subject:</label>
        <input type="text" name="subjects[]" required class="form-control">
        <label for="marks[]">Marks:</label>
        <input type="number" name="marks[]" required min="0" max="100" class="form-control">
        <button type="button" class="btn btn-danger btn-sm remove-subject" onclick="removeSubject(this)">Remove</button>
    `;
    container.appendChild(subjectDiv);
}

function removeSubject(button) {
    const subjectDiv = button.parentElement;
    subjectDiv.remove();
}
</script>

<style>
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}

.btn {
    margin-top: 10px;
}

.remove-subject {
    margin-top: 10px;
}
</style>

</body>
</html>