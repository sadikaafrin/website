@extends('master.admin.master')

@section('body')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Add Brand Form</h4>
                    <p class="text-center text-success">{{Session::get('message')}}</p>
                    <form action="{{route('brand.new')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Brand Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="horizontal-firstname-input" placeholder="Enter Brand Name">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Brand Description</label>
                            <div class="col-sm-9">
                                <textarea type="email" class="form-control" name="description" id="horizontal-email-input" placeholder="Brand Description"></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-password-input" class="col-sm-3 col-form-label">Brand Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="image" id="horizontal-password-input">
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-success w-md">Create New Brand</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection


