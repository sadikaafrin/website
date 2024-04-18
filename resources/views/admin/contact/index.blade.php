@extends('master.admin.master')

@push('costomcss')
<style>
    .card {
        overflow-x: auto;
    }
</style>
@endpush

@section('body')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <h4 class="card-title">All Contact Info</h4>
                <a href="" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fa-regular fa-square-plus"></i>
                    Update Contact
                </a>
            </div>
            <div class="card-body">
                {{-- <table class="table table-bordered nowrap w-100 DataTable"> --}}
                    <table class="table table-bordered nowrap w-100">
                    <thead>

                        <tr>
                            <th class="border-bottom-0">sl</th>
                            <th class="border-bottom-0">Contact Email</th>
                            <th class="border-bottom-0">Contact Number</th>
                            <th class="border-bottom-0">Contact Address</th>
                            <th class="border-bottom-0">Contact Map</th>
                            <th class="border-bottom-0">Facebook</th>
                            <th class="border-bottom-0">Instagram</th>
                            <th class="border-bottom-0">Twiter</th>
                            <th class="border-bottom-0">linkdin</th>
                            <th class="border-bottom-0">Youtube</th>
                            <th class="border-bottom-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contact as $info)
                        <tr>
                           <th>{{$loop->iteration}}</th>
                            <td>{{$info->email}}</td>
                            <td>{{$info->phone}}</td>
                            <td>{{$info->address}}</td>
                            <td>{{$info->google_map}}</td>
                            <td>{{$info->facebook}}</td>
                            <td>{{$info->instagram}}</td>
                            <td>{{$info->linkedin}}</td>
                            <td>{{$info->twitter}}</td>
                            <td>{{$info->youtube}}</td>

                            <td>
                                <a href="" class="btn btn-success
                                    update_contact_form"
                                   data-bs-toggle="modal"
                                   data-bs-target="#updatedModal"
                                   data-id="{{$info->id}}"
                                   data-email="{{$info->email}}"
                                   data-phone="{{$info->phone}}"
                                   data-address="{{$info->address}}"
                                   data-google_map="{{$info->google_map}}"
                                   data-facebook="{{$info->facebook}}"
                                   data-instagram="{{$info->instagram}}"
                                   data-linkedin="{{$info->linkedin}}"
                                   data-twitter="{{$info->twitter}}"
                                   data-youtube="{{$info->youtube}}"


                                >
                                    <i class="fa fa-edit"></i>

                                </a>
                                {{-- <a href=""
                                   class="btn btn-danger delete_product"
                                   data-id="{{$info->id}}"
                                >
                                    <i class="fa fa-trash"></i>
                                </a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade" id="updatedModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" id="updateContactForm" method="post" enctype="multipart/form-data"  >
        @csrf
        <input type="hidden" id="up_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Add a Contact</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="errMsgContainer" class="mb-3"></div>
                    <div class="form-group my-3">
                        <label for="name">Contact Email</label>
                        <input type="text" name="up_email" id="up_email" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Contact Number</label>
                        <input type="text" name="up_phone" id="up_phone" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="description">Contact Address</label>
                        <textarea type="text"  name="up_address" id="up_address" class="form-control" ></textarea>
                        <span class="text-danger description_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Facebook</label>
                        <input type="text" name="up_facebook" id="up_facebook" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Instagram</label>
                        <input type="text" name="up_instagram" id="up_instagram" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Linkdin</label>
                        <input type="text" name="up_linkedin" id="up_linkedin" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Twiter</label>
                        <input type="text" name="up_twitter" id="up_twitter" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Youtube</label>
                        <input type="text" name="up_youtube" id="up_youtube" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Google Map</label>
                        <input type="text" name="up_google_map" id="up_google_map" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_contact" >Update Contact</button>
                </div>
            </div>
        </div>
    </form>
</div>
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
$(document).ready(function () {
    $(document).on('click','.add_contact', function (e) {
        e.preventDefault();
        let email = $('#email').val();
        let phone = $('#phone').val();
        let address = $('#address').val();
        let google_map = $('#google_map').val();
        let facebook = $('#facebook').val();
        let instagram = $('#instagram').val();
        let linkedin = $('#linkedin').val();
        let twitter = $('#twitter').val();
        let youtube = $('#youtube').val();


        let formData  = new FormData();

        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('address', address);
        formData.append('google_map', google_map);
        formData.append('facebook', facebook);
        formData.append('instagram', instagram);
        formData.append('linkedin', linkedin);
        formData.append('twitter', twitter);
        formData.append('youtube', youtube);

        $.ajax({
            url: "{{ route('contact.create') }}",
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == 'success') {
                $('#addModal').modal('hide');
                $('#addContactForm')[0].reset();
                toastr.success("Category added successfully", "Success");
                // $('.DataTable').DataTable().ajax.reload();
                $('.table').load(location.href+' .table');
                }
            },


        });
    });
});

// Show Category
$(document).on('click', '.update_contact_form', function () {
     $('#updatedModal').modal('show');
     let id = $(this).data('id');
     var main_url = "{{url('/')}}";
     var ajax_url = "{{url('/edit-contact')}}/"+id;
    $.ajax({

   url: ajax_url,
   type:"GET",
   dataType:"json",

    success:function(data) {
        console.log(data);
        $('#up_id').val(data.id);
        $('#up_email').val(data.email);
        $('#up_phone').val(data.phone);
        $('#up_address').val(data.address);
        $('#up_google_map').val(data.google_map);
        $('#up_facebook').val(data.facebook);
        $('#up_instagram').val(data.instagram);
        $('#up_linkedin').val(data.linkedin);
        $('#up_twitter').val(data.twitter);
        $('#up_youtube').val(data.youtube);


    },

});
});

  //    Update Category
  $(document).on('click','.update_contact', function (e) {
    e.preventDefault();

    // Get the updated values from the modal fields
    let up_id = 1;
    let up_email = $('#up_email').val();
    let up_phone = $('#up_phone').val();
    let up_address = $('#up_address').val();
    let up_google_map = $('#up_google_map').val();
    let up_facebook = $('#up_facebook').val();
    let up_instagram = $('#up_instagram').val();
    let up_linkedin = $('#up_linkedin').val();
    let up_twitter = $('#up_twitter').val();
    let up_youtube = $('#up_youtube').val();

    // Construct the form data to be submitted
    let formData = new FormData();
    formData.append('id', up_id);
    formData.append('email', up_email);
    formData.append('phone', up_phone);
    formData.append('address', up_address);
    formData.append('google_map', up_google_map);
    formData.append('facebook', up_facebook);
    formData.append('instagram', up_instagram);
    formData.append('linkedin', up_linkedin);
    formData.append('twitter', up_twitter);
    formData.append('youtube', up_youtube);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    // Send an AJAX request to update the information
    $.ajax({
        method: 'POST',
        url: "{{ url('/update-contact') }}/" + up_id,
        data: formData,
        contentType: false,
        processData: false,
        success: function (res) {
            if (res.status == 'success') {
                $('#updatedModal').modal('hide');
                $('#updateContactForm')[0].reset();
                $('.table').load(location.href+' .table');
                toastr.success("Category updated successfully", "Success");
                // $('.DataTable2').DataTable().ajax.reload();
            }
        },
    });
});

</script>

@endpush


