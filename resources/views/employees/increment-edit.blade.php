@extends('layouts.dashboard')

@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">

        <form action="{{ route('update.increment',$increment->id) }}" method=" post ">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h4 class="py-4">Edit Increment</h4>
                </div>
                <div class="col-lg-6">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Amount</label>
                        <input value="{{ $increment->increment }}" type="number" name="increment" class="form-control" placeholder="Add Increment" required>
                    </div>

                </div>

               <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>

               </div>
        </form>
    </div>

</main>

@endsection
