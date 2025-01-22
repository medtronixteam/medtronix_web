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

                <h3>Add Review</h3>

                <form method="POST" action="{{ route('client.reviewStore') }}" enctype="multipart/form-data">
                    @csrf



                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name')  is-invalid @enderror" id="name" required>
                                @error('name')
                                <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <input name="category" value="web" type="hidden" class="form-control @error('category') is-invalid  @enderror " id="category" >
                        <input name="client_message" value="web" type="hidden" class="form-control @error('category') is-invalid  @enderror " id="category" >


                        <div class="col-lg-6">
                            <!-- Picture -->
                            <div class="form-group">
                                <label for="picture">Client picture <span class="text-info">(Optional)</span></label>
                                <input type="file" class="form-control-file" id="picture" name="picture">
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <label for="status">status</label>

                            <select id="status" name="status" class="form-select form-control" aria-label="Default select example">
                                <option selected value="1">Active</option>
                                <option value="0">Inactive</option>


                            </select>
                        </div>
                        <div class="col-sm-5">
                            <br>
                            <button type="submit" class="btn btn-primary mt-2">Add Review</button>
                        </form>
                        </div>

                    </div>

            </div>





        </div>
    </div>
    </div>



</main>

@endsection
