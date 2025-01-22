@extends('layouts.dashboard')

@section('content')
    <main role="main" class="main-content">
        <div class="card p-4 my-4">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Project Name</label>
                                    <input required value="{{ old('name') }}" type="text" class="form-control"
                                        id="name" name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Category -->
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select form-control" id="category" name="category" required>
                                        @foreach (['web', 'app', 'python', 'desktop', 'other'] as $category)
                                            <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Link -->
                        {{-- <div class="mb-3">
                            <label for="link" class="form-label">Link (optional)</label>
                            <input value="{{ old('link') }}" type="text" class="form-control" id="link"
                                name="link">
                            @error('link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description (optional)</label>
                            <textarea value="{{ old('description') }}" class="form-control" id="description" name="description" rows="3"></textarea>
                            @error('description')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <img id="main_picture_show" style="width: 150px; height: 150px; display: none;" src=""
                                alt="">
                            <label for="main_picture" class="form-label">Thumbnail Picture</label>
                            <input required value="{{ old('main_picture') }}" onchange="previewThumbnail(this)"
                                type="file" class="form-control" id="main_picture" name="main_picture"
                                accept=".png, .jpg, .jpeg">
                            @error('main_picture')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Video or Video Link or Pictures -->
                        <div class="form-group">
                            <label>Choose Source:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="source" id="videoLink" value="link" checked>
                                <label class="form-check-label" for="videoLink">Video Link</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="source" id="videoFile" value="file">
                                <label class="form-check-label" for="videoFile">Upload Video File</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="source" id="picFile" value="pictures">
                                <label class="form-check-label" for="picFile">Pictures</label>
                            </div>
                        </div>

                        <div class="form-group" id="videoLinkInput">
                            <label for="video_link">Video Link:</label>
                            <input type="url" name="link" class="form-control" placeholder="Enter video link">
                            @error('link')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group" id="videoFileInput" style="display: none;">
                            <label for="video">Video File:</label>
                            <input type="file" name="video" class="form-control-file" accept=".mp4,.mov,.avi">
                            @error('video')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3" id="projectPicturesSection" style="display: none;">
                            <img id="project_pic" style="width: 150px; height: 150px; display: none;" src="" alt="">
                            <label for="pictures" class="form-label">Project Pictures (optional)</label>
                            <input onchange="previewImage(this)" type="file" class="form-control" id="pictures" name="pictures[]" accept=".png,.jpg,.jpeg,.gif" multiple>
                            @error('pictures')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Project</button>
                    </form>
                </div>
            </div>
        </div>
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

    function previewImage(input) {
        var preview = document.getElementById('project_pic');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }

    function previewThumbnail(input) {
        var preview = document.getElementById('main_picture_show');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
@endpush
