@extends('master.admin.master')

@section('body')
    <!--Data Table Start-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">All Sub Category Info</h4>
                    <p class="text-center text-success">{{Session::get('message')}}</p>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Sub Category Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($sub_categories as $sub_category)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$sub_category->category->name}}</td>
                            <td>{{$sub_category->name}}</td>

                            <td>{{Str::limit($sub_category->description,20)}}</td>
                            <td>
                                <img src="{{asset($sub_category->image)}}" alt="" height="50" width="80">
                            </td>
                            <td>{{$sub_category->status == 1 ? 'Publish' : 'Unpublished'}}</td>
                            <td>
                                <a href="{{route('sub-category.edit', ['id' => $sub_category->id])}}" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm" onclick="event.preventDefault();document.getElementById('subCategoryDeleteForm{{$sub_category->id}}').submit();">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <form action="{{route('sub-category.delete', ['id' => $sub_category->id])}}" method="POST" id="subCategoryDeleteForm{{$sub_category->id}}">
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!--Data Table End-->
@endsection





