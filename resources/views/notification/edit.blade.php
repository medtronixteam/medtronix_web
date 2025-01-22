@extends('layouts.dashboard')

@section('content')

<main role="main" class="main-content">
    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <h1>Edit Notification</h1>
                <form action="{{ route('notifications.update', $notification->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="heading">Heading</label>
                        <input type="text" class="form-control" id="heading" name="heading" value="{{ $notification->heading }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $notification->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $notification->date }}" required>
                    </div>
                   
                    <div class="form-group mt-4">
                        <label for="all-employees">All Employees</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="all-employees" name="all_employee" value="1" {{ $selectAllUsers ? 'checked' : '' }}>
                            <label class="custom-control-label" for="all-employees">All Employees</label>
                        </div>
                    </div>

                    <div class="form-group" id="selected-users" style="display: {{ $selectAllUsers ? 'none' : 'block' }}">
                        <label for="users">Select Users</label>
                        <div class="checkbox-list">
                            @foreach($users as $user)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="user_{{ $user->id }}" name="users[]" value="{{ $user->id }}" {{ in_array($user->id, $selectedUsers) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="user_{{ $user->id }}">{{ $user->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Notification</button>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var allEmployeesCheckbox = document.getElementById('all-employees');
        var selectedUsersDiv = document.getElementById('selected-users');
        var checkboxes = document.querySelectorAll('[name="users[]"]');

        // Function to update checkbox states based on "All Employees" checkbox
        function updateCheckboxStates() {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = allEmployeesCheckbox.checked;
            });

            selectedUsersDiv.style.display = allEmployeesCheckbox.checked ? 'none' : 'block';
        }

        // Update checkbox states when "All Employees" checkbox changes
        allEmployeesCheckbox.addEventListener('change', function () {
            updateCheckboxStates();
        });

        // Check if any user checkbox is checked initially
        var anyUserChecked = Array.from(checkboxes).some(function (checkbox) {
            return checkbox.checked;
        });

        // If no user checkbox is checked initially, update checkbox states based on "All Employees" checkbox
        if (!anyUserChecked) {
            updateCheckboxStates();
        }
    });
</script>
@endpush
