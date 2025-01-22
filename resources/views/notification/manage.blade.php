@extends('layouts.dashboard')

@section('content')

<main role="main" class="main-content">
    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <h3>Add Notification</h3>
                <form action="{{ route('notifications.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="heading">Heading</label>
                        <input type="text" class="form-control" id="heading" name="heading" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" ></textarea>
                    </div>
                   <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ now()->format('Y-m-d') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Notification Type </label>
                            <select name="type_of" class="form-control" id="">
                                <option value="admin">Admin</option>
                                <option value="system">System</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Notification Label </label>
                            <select name="label" class="form-control" id="">
                                <option value="info">info</option>
                                <option value="warning">warning</option>
                                <option value="danger">Last Warning</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label for="all-employees">All Employees</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="all-employees" name="all_employee" value="1">
                            <label class="custom-control-label" for="all-employees">All Employees</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="users">Send to Specific Employee</label>
                        <div class="checkbox-list" id="specific-employees">
                            @foreach($users as $user)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="user_{{ $user->id }}" name="users[]" value="{{ $user->id }}">
                                    <label class="custom-control-label" for="user_{{ $user->id }}">{{ $user->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Post Notification</button>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection

@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

<script>
     let editorInstance;
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(description => {
                editorInstance = description;
            })
            .catch(error => {
                console.error(error);
            });
    document.addEventListener('DOMContentLoaded', function() {
        var allEmployeesCheckbox = document.getElementById('all-employees');
        var employeeCheckboxes = document.querySelectorAll('#specific-employees .custom-control-input');

        allEmployeesCheckbox.addEventListener('change', function() {
            employeeCheckboxes.forEach(function(checkbox) {
                checkbox.checked = allEmployeesCheckbox.checked;
            });
        });
    });
    </script>

@endpush
