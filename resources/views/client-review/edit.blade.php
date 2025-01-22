@extends('layouts.dashboard')
<style>
    .form-control:focus {
        box-shadow: none !important;
        border: 1px solid black !important;
    }

</style>

@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">

                <h3>Edit Review</h3>

                <form method="POST" action="{{ route('review.update',$edit->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')



                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" value="{{ $edit->name }}" type="text" class="form-control" id="name" required>

                            </div>

                        </div>

                        <div class=" col-lg-6">
                            <!-- category -->
                            <div class="form-group">
                                <label for="category">category</label>
                                <input name="category" value="{{ $edit->category }}" type="text" class="form-control" id="category" required>


                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- message -->
                            <div class="form-group">
                                <label for="message">Client message</label>

                                <textarea name="client_message" value="" class="form-control" id="message" rows="3" required>{{ $edit->client_message }}</textarea>
                            </div>
                        </div>





                        <div class=" col-lg-6">
                            <!-- Picture -->
                            <div class="form-group">

                                <label for="picture">Client picture <span class="text-info">(Optional)</span></label>
                                <input type="file" class="form-control-file" id="picture" name="picture">
                            </div>
                            <p>Previous Image</p>
                            @if($edit->picture)
                            <img width="70" src="{{ asset('storage/' . $edit->picture) }}" alt="Review Picture">
                            @else
                            No Picture
                            @endif
                        </div>
                        <div class="col-lg-6">

                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-select form-control">
                                <option value="1" {{ $edit->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $edit->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                    </div>

            </div>


            <button type="submit" class="btn btn-primary">Update</button>
            </form>


        </div>
    </div>
    </div>



</main>

@endsection
