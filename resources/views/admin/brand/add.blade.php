@extends('master.admin.master')

@section('body')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Brand</h4>
                <a href=""  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fa-regular fa-square-plus"></i>
                    Add New Brand
                </a>
            </div>
            <div class="card-body">
                <table id="brand_table" class="table table-borderd dt-responsive nowrap w-100 DataTable">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Brand Name</th>
                            <th>Brand Description</th>
                            <th>Bradn Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    {{-- <form action="" id="addBrandForm" method="post" enctype="multipart/form-data"  >
        @csrf --}}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Add Brand</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- <input type="hidden" id="brand_id"> --}}
          <div class="form-group my-3">
            <label for="name">Brand Name</label>
            <input type="text" name="name" id="name" class="form-control">
            <span class="text-danger name-Error"></span>
          </div>
          <div class="form-group my-3">
            <label for="description">Brand Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
            <span class="text-danger description_Error"></span>
          </div>
          <div class="form-group my-3">
            <label for="image">Brand Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <span class="text-danger image_Error"></span>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary  add_brand" id="btn_save">Save changes</button>
        </div>
      </div>
    </div>
    {{-- </form> --}}
  </div>
  @include('admin.brand.update_modal')
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
    var base_url = "{{route('brand.add')}}";
    var brandTable = $('#brand_table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
       lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, 'All']
        ],
        PageLength:5,
        ajax: {
          url: base_url,
        },

        columns: [
            {data: 'Sl', name: 'Sl'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {
            data: 'image',
            name: 'image',
            render: function(data, type, full, meta) {
                return '<img src="{{ asset('uploads/brands/') }}/' + data + '" alt="Category Image" height="100px" width="100px">';
            }
        },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
        });

    $(document).ready(function() {
        $(document).on('click', '.add_brand', function(e) {
            e.preventDefault();
            let name = $('#name').val();
            let description = $('#description').val();
            let image = $('#image')[0].files[0];
            var formData = new FormData();
            formData.append('name', name);
            formData.append('description', description);
            formData.append('image', image);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: "{{ route('brand.new') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    if(res.status == 'success'){

                        toastr.success("Brand added successfully", "Success");
                        $('#addModal').modal('hide');
                        // $('#addBrandForm')[0].reset();


                        $('#name').val('');
                        $('#description').val('');
                        $('#image').val('');

                        $('.DataTable').DataTable().ajax.reload();


                    }
                },
            })
        });
    });

    //Show Brand
    //With using update_modal.blade.php
    $(document).on('click', '.update_brand_form', function () {
            let id = $(this).data('id');
            var main_url = "{{url('/')}}";
            var ajax_url = "{{url('/edit-brand')}}/"+id;
            $.ajax({
                url: ajax_url,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    console.log(data);
                    $('#up_id').val(data.id);
                    $('#up_name').val(data.name);
                    $('#up_description').val(data.description);
                    $('#current_image').attr('src', main_url+"/uploads/brands/"+data.image);
                    $('#updateModal').modal('show');
                },
            });
        });

//without using update_modal.blade.php
    // $(document).on('click', '.update_brand_form', function () {
    //     $('#addModal').modal('show');
    //     let id = $(this).data('id');
    //     var main_url = "{{url('/')}}";
    //     var ajax_url = "{{url('/edit-brand')}}/"+id;
    //     $.ajax({
    //         url: ajax_url,
    //         type:"GET",
    //         dataType:"json",
    //         success:function(data) {
    //             console.log(data);
    //             $('#brand_id').val(data.id);
    //             $('#name').val(data.name);
    //             $('#description').val(data.description);
    //             $('#image').val('');
    //             $('#current_image').attr('src', main_url+"/uploads/brands/"+data.image);
    //             // Change modal title and button text
    //             $('#addModalLabel').text('Update Brand');
    //             $('#btn_save').text('Update changes');
    //         },
    //     });
    // });

    //    Update Category
    $(document).on('click', '.update_brand', function(e) {
    e.preventDefault();

    let id = $('#up_id').val();
    let url = "{{ url('/update-brand') }}/"+id;

    let name = $('#up_name').val();
    let description = $('#up_description').val();
    let image = $('#up_image')[0].files[0];

    let formData = new FormData();
    formData.append('_method', 'POST');
    formData.append('name', name);
    formData.append('description', description);
    formData.append('image', image);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        method: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (res) {
            if (res.status == 'success') {
                toastr.success("Brand updated successfully", "Success");
                $('#updateModal').modal('hide');
                $('#up_name').val('');
                $('#up_description').val('');
                $('#up_image').val('');
                $('#current_image').attr('src', '');

                $('.DataTable').DataTable().ajax.reload();
            }
        },
    });
});

//Delete Brand
$(document).on('click','.delete_brand', function (e) {
            e.preventDefault();
            let brand_id = $(this).data('id');
            if(confirm('Are you sure to delete this ?')){
                $.ajax({
                    url:"{{route('brand.delete')}}",
                    method:'post',
                    data:{brand_id:brand_id},
                    success:function (res) {
                        if (res.status == 'success') {
                        toastr.success("Category Deleted successfully", "success");
                        $('.DataTable').DataTable().ajax.reload();
                        }


                    }
                });
            }

        });

</script>

@endpush


