
@extends('layouts.dashboard')
@section('content')
    <main role="main" class="main-content">

        <div class="card p-4 my-4">
            <h3 class="py-4">List of Notifications</h3>

            <div class="table-responsive">
                <table class="table table-striped text-dark table-hover dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>

                            <th>Visible to</th>
                            <th>Notification Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $notification->heading }}</td>

                                <td>
                                    @if ($notification->users)
                                        @foreach (json_decode($notification->users) as $userId)
                                        @if ( \App\Models\User::find($userId))


                                            {{ \App\Models\User::find($userId)->name }},
                                            @endif
                                        @endforeach
                                    @endif
                                </td>

                                <td>{{ $notification->date }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a type="button" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </a>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href=" {{ route('notifications.show', $notification->id) }}">View</a>
                                            <a class="dropdown-item"
                                                href="{{ route('notifications.edit', $notification->id) }} ">Edit</a>

                                            <form method="POST"
                                                action="{{ route('notifications.destroy', $notification->id) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Are you sure you want to delete this notification?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </main>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
