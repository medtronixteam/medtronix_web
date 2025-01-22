@extends('layouts.dashboard')
@section('content')
<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Project Name</label>
                                <input type="text" class="form-control" value="{{ $project->name }}" id="name"
                                    name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Category -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select form-control" id="category" name="category" required>
                                    @foreach(['web', 'app', 'python', 'desktop','other'] as $category)
                                    <option value="{{ $category }}" {{ ($project->category == $category) ? 'selected' :
                                        '' }}>
                                        {{ ucfirst($category) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Link -->
                    <div class="mb-3">
                        <label for="link" class="form-label">Link (optional)</label>
                        <input type="text" class="form-control" value="{{ $project->link }}" id="link" name="link">
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (optional)</label>
                        <textarea class="form-control" id="description" name="description"
                            rows="3">{{ $project->description }}</textarea>
                    </div>

                    <!-- Main Picture -->
                    <div class="mb-3">
                        <img style="height: 200px; width:200px;" id="main_pic_change" class="img-fluid mb-3"
                            src="{{ asset('storage/'.$project->main_picture) }}" alt="">
                        <label for="main_picture" class="form-label">Update Main Picture? (optional)</label>
                        <input
                            onchange="document.querySelector('#main_pic_change').src = window.URL.createObjectURL(this.files[0])"
                            type="file" class="form-control" id="main_picture" name="main_picture"
                            accept=".png, .jpg, .jpeg, .gif">
                    </div>

                    <!-- Video Source -->
                    <div class="form-group">
                        <label>Choose Video Source:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="source" id="videoLink" value="link" {{
                                $project->source == 'link' ? 'checked' : '' }}>
                            <label class="form-check-label" for="videoLink">Video Link</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="source" id="videoFile" value="file" {{
                                $project->source == 'file' ? 'checked' : '' }}>
                            <label class="form-check-label" for="videoFile">Upload Video File</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="source" id="picFile" value="pictures" {{
                                $project->source == 'pictures' ? 'checked' : '' }}>
                            <label class="form-check-label" for="picFile">Pic</label>
                        </div>
                    </div>

                    <!-- Video Link Input -->
                    <div class="form-group" id="videoLinkInput"
                        style="{{ $project->source == 'link' ? '' : 'display: none;' }}">
                        <label for="video_link">Video Link:</label>
                        <input type="url" name="video_link" class="form-control" placeholder="Enter video link"
                            value="{{ $project->link }}">
                        <a href="{{ $project->video }}" target="_blank">{{ $project->video }}</a>
                        @error('video_link')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <!-- Video File Input -->
                    <div class="form-group" id="videoFileInput"
                        style="{{ $project->source == 'file' ? '' : 'display:none' }}">
                        <label for="video">Upload Video File:</label>
                        <input type="file" name="video" class="form-control-file" accept='.mp4,.mov,.avi'>
                        @if (Str::startsWith($project->video, 'project_videos/'))
                        {{-- Uncomment the following lines if you want to display the video --}}
                        {{-- <video controls width="640" height="360">
                            <source src="{{ Storage::url($project->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video> --}}
                        @endif
                        @error('video')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <!-- Project Pictures -->
                    <div class="mb-3" id="projectPicturesSection" style="{{ $project->source == 'pictures' ? '' : 'display:none' }}">
                        <img id="project_pic" style="width: 150px; height: 150px; display: none;" src="" alt="">
                        <label for="pictures" class="form-label">Project Pictures (optional)</label>
                        <input type="file"  value="{{ $project->pictures }}" class="form-control" id="pictures" name="pictures[]" accept=".png,.jpg,.jpeg,.gif" multiple>
                        {{-- <a href="{{ $project->pictures }}" target="_blank">{{ $project->pictures }}</a> --}}
                        @error('pictures')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    {{-- onchange="previewImage(this)" --}}
    @foreach ($project_pictures as $project_picture)
    <div class="card p-4 my-4">
        <!-- Update or delete the project picture -->
        <h3 class="text-capitalize">Update or delete the project picture</h3>
        <div class="py-2">
            <img style="max-height: 200px" src="{{ asset('storage/'.$project_picture->picture_path) }}" alt="">
            <form method="POST" action="{{ route('project_pictures.destroy', $project_picture->id) }}">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger px-4 my-3" type="Submit">Delete</button>
            </form>
        </div>

        <form method="POST" action="{{ route('project_pictures.update', $project_picture->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" class="form-control" name="project_id" value="{{ $project_picture->project_id }}">
            <!-- Project Pictures -->
            <div class="mb-3">
                <label for="pictures" class="form-label">Update Project Picture</label>
                <input type="file" class="form-control" id="pictures" name="project_picture"
                    accept=".png,.jpg,.jpeg,.gif" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Project</button>
        </form>
    </div>
    @endforeach

</main>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('input[type="radio"][name="source"]').change(function() {
            if ($(this).val() === 'link') {
                $('#videoLinkInput').show();
                $('#videoFileInput').hide();
                $('#projectPicturesSection').hide();
            } else if ($(this).val() === 'file') {
                $('#videoLinkInput').hide();
                $('#videoFileInput').show();
                $('#projectPicturesSection').hide();
            } else if ($(this).val() === 'pictures') {
                $('#videoLinkInput').hide();
                $('#videoFileInput').hide();
                $('#projectPicturesSection').show();
            }
        });

        // Initially check the value and set visibility accordingly
        var selectedSource = $('input[type="radio"][name="source"]:checked').val();
        if (selectedSource === 'link') {
            $('#videoLinkInput').show();
            $('#videoFileInput').hide();
            $('#projectPicturesSection').hide();
        } else if (selectedSource === 'file') {
            $('#videoLinkInput').hide();
            $('#videoFileInput').show();
            $('#projectPicturesSection').hide();
        } else if (selectedSource === 'pictures') {
            $('#videoLinkInput').hide();
            $('#videoFileInput').hide();
            $('#projectPicturesSection').show();
        }
    });

    // function previewImage(input) {
    //     var preview = document.getElementById('project_pic');
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             preview.src = e.target.result;
    //             preview.style.display = 'block';
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     } else {
    //         preview.src = '';
    //         preview.style.display = 'none';
    //     }
    // }

    // function previewThumbnail(input) {
    //     var preview = document.getElementById('main_picture_show');
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             preview.src = e.target.result;
    //             preview.style.display = 'block';
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     } else {
    //         preview.src = '';
    //         preview.style.display = 'none';
    //     }
    // }
</script>
@endpush
