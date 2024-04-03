@extends('master.admin.master')

@section('body')
<!--Data Table Start-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title">All Category Info</h4>
                    <a href="" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fa-regular fa-square-plus"></i>
                        Add New Category
                    </a>
                </div>
                <div class="card-body">
                    <table  class="table table-bordered dt-responsive yajra-datatable nowrap w-100">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl NO.</th>
                                <th class="border-bottom-0">Category Name</th>
                                <th class="border-bottom-0">Category Description</th>
                                <th class="border-bottom-0">Category Image</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach($categories as $category)
                            <tr>
                               <th>{{$loop->iteration}}</th>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>
                                    <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="" height="100px" width="100px">

                                </td>
                                <td>
                                    <a href="" class="btn btn-success
                                        update_category_form"
                                       data-bs-toggle="modal"
                                       data-bs-target="#updateModal"
                                       data-id="{{$category->id}}"
                                       data-name="{{$category->name}}"
                                       data-description="{{$category->description}}"
                                       data-image="{{$category->image}}"
                                    >
                                        <i class="fa fa-edit"></i>

                                    </a>
                                    <a href=""
                                       class="btn btn-danger delete_product"
                                       data-id="{{$category->id}}"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody> --}}
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <form action="" id="addCategoryForm" method="post" enctype="multipart/form-data"  >
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addModalLabel">Add a Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="errMsgContainer" class="mb-3"></div>
                        <div class="form-group my-3">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control" >
                            <span class="text-danger name_Error"></span>
                        </div>
                        <div class="form-group my-3">
                            <label for="description">Category Description</label>
                            <textarea type="text"  name="description" id="description" class="form-control" ></textarea>
                            <span class="text-danger description_Error"></span>
                        </div>
                        <div class="form-group my-3">
                            <label for="image">Category Image</label>
                            <input type="file" onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])"  name="image" id="image" class="form-control"  >
                            <span class="text-danger image_Error"></span>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary add_category" >Save Category</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--Data Table End-->
    @include('admin.category.update_modal')
    {{-- @include('admin.category.js') --}}
    {!! Toastr::message() !!}
@endsection

@push('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>

$(document).ready(function(){
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                url: "{{ url()->current() }}",
                    data: function(d) {
                    },
                columns: [
                    {
                        data: 'sl',
                        name: 'sl',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'text-left',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'description',
                        name: 'description',
                        className: 'text-left',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'image',
                        name: 'image',
                        className: 'text-center',
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false
                    }
                ]
            });
        });

    $(document).ready(function () {
    $(document).on('click','.add_category', function (e) {
        e.preventDefault();
        let name = $('#name').val();
        let description = $('#description').val();
        let image = $('#image')[0].files[0];

        // let formData  = new FormData(this);
        let formData  = new FormData();

        formData.append('name', name);
        formData.append('description', description);
        formData.append('image', image);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));


        $.ajax({
            url: "{{ route('category.new') }}",
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == 'success') {
                    $('#addModal').modal('hide');
                    $('#addCategoryForm')[0].reset();
                    $('.table').load(location.href + ' .table');
                    toastr.success("Category added successfully", "Success");
                }
            },

            error: function(error) {
                    if (error.responseJSON) {
                        var errors = error.responseJSON.errors;
                        if (errors.name) {
                            $('.name_Error').text(errors.name[0]);
                            $('#name').addClass('border-danger is-invalid').focus();
                        }
                        if (errors.description) {
                            $('.description_Error').text(errors.description[0]);
                            $('#description').addClass('border-danger is-invalid').focus();
                        }
                        if(errors.image) {
                            $('.image_Error').text(errors.image[0]);
                            $('#image').addClass('border-danger is-invalid').focus();
                        }
                    }
                }
        });
    });
// Show Category
    $(document).on('click', '.update_category_form', function () {
    let id = $(this).data('id');
    let name = $(this).data('name');
    let description = $(this).data('description');
    let image = $(this).data('image');
    // console.log(image);

    $('#up_id').val(id);
    $('#up_name').val(name);
    $('#up_description').val(description);



    $('#current_image').attr("src", "{{ asset('uploads/categories/') }}/" + image);
    $('#updatedModal').modal('show');

});

    //    Update Category
    $(document).on('click','.update_category', function (e) {
    e.preventDefault();
    let up_id = $('#up_id').val();
    let up_name = $('#up_name').val();
    let up_description = $('#up_description').val();
    let up_image = $('#up_image')[0].files[0];

    let formData = new FormData();
    formData.append('id', up_id);
    formData.append('name', up_name);
    formData.append('description', up_description);
    formData.append('image', up_image);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        url:"{{route('category.update')}}",
        method:'post',
        data:formData,
        contentType: false,
        processData: false,
        success:function (res) {
            if(res.status=='success'){
                $('#updatedModal').modal('hide');
                $('#updateCategoryForm')[0].reset();
                $('.table').load(location.href+' .table');
                Command: toastr["success"]("Category update", "success")

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },

    });
});


  //    Delete Category
  $(document).on('click','.delete_product', function (e) {
            e.preventDefault();
            let category_id = $(this).data('id');
            if(confirm('Are you sure to delete this ?')){
                $.ajax({
                    url:"{{route('category.delete')}}",
                    method:'post',
                    data:{category_id:category_id},
                    success:function (res) {
                        if(res.status=='success'){
                            $('.table').load(location.href+' .table');
                            Command: toastr["success"]("Category Deleted successfully", "success")

                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                        }
                    }
                });
            }

        })
    });
</script>

@endpush







