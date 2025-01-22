@extends('layouts.dashboard')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h2 class="card-title">Meta Tags</h2>
                            <form id="seoForm" action="{{ route('seo.create') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea class="w-100" name="seo" id="seo" cols="30" rows="15"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

