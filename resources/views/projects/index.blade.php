@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    table.dataTable tbody tr {
    background-color: transparent;
}
    .dataTables_length option{
        color: black;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#projectTable').DataTable();
    });
</script>
@endpush

@extends('layouts.dashboard')
@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <h3 class="py-4">List of Projects</h3>

        <div class="table-responsive">
            <table id="projectTable" class="table table-striped table-hover">
                <thead>
                    <tr class="text-dark">
                        <th>#</th>
                        <th>Main Image</th>
                        {{-- <th>Images</th> --}}
                        <th>Name</th>
                        <th>category</th>
                        <th>link</th>
                        <th>video</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Actions</th>
                        <!-- Add other table headers for the fields you need -->
                    </tr>
                </thead>
                <tbody>


                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>
                            @if ($project->main_picture)
                            <img class="img-fluid rounded" style="max-height: 70px; max-width:70px;" src="{{ asset('storage/' . $project->main_picture) }}" alt="project Pic">

                            @else
                                <span><i class="fas fa-smile"></i> No main Pic</span>
                            @endif
                        </td>
                        {{-- <td>
                            @if ($project->pictures)
                            @foreach ($project->pictures as $picture)
                            <img class="img-fluid rounded" style="max-height: 70px; max-width:70px;" src="{{ asset('storage/' . $picture->picture_path) }}" alt="project Pic">
                            <br>
                            @endforeach
                            @else
                                <!-- You can provide a default image or message here for when profile_picture is null -->
                                <span><i class="fas fa-smile"></i> No Pic</span>
                            @endif
                        </td> --}}

                        <td>{{ $project->name }}</td>
                        <td>{{ $project->category }}</td>
                        <td>{{ $project->link }}</td>
                        <td>
                        @if($project->video)
                            @if (Str::startsWith($project->video,'project_videos/'))
                                 {{-- display video if project->video has vas video  --}}
                                <video height="100px" width="200px">
                                    <source src="{{ Storage::url($project->video) }}" type="video/mp4">
                                 Your browser does not support the video tag.
                            </video>
                            @else
                                 <iframe width="200px" height="100px" src="{{ $project->video }}" frameborder="0" allowfullscreen></iframe>

                            @endif
                        @endif
                    </td>
                        <td>{{ Str::limit($project->description, 50, '...') }}</td>
                        <td>{{ $project->created_at }}</td>

                        <td class="text-center">
                            <div class="btn-group">
                                <a type="button" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu">

                                    <a class="dropdown-item" href="{{ route('projects.edit', $project->id) }}">Edit</a>
                                    <form method="POST" action="{{ route('projects.destroy', $project->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <!-- Add other table data cells for the fields you need -->
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
