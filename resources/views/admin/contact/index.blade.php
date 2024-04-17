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
                <h4 class="card-title">All Category Info</h4>
                <a href="" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fa-regular fa-square-plus"></i>
                    Add New Category
                </a>
            </div>
            <div class="card-body">
                <table id="contact_table"  class="table table-bordered dt-responsive nowrap w-100 DataTable">
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
                                   data-bs-target="#updateModal"
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
                                <a href=""
                                   class="btn btn-danger delete_product"
                                   data-id="{{$info->id}}"
                                >
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" id="updateContactForm" method="post" enctype="multipart/form-data"  >
        @csrf
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
                        <input type="text" name="email" id="email" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Contact Number</label>
                        <input type="text" name="phone" id="phone" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="description">Contact Address</label>
                        <textarea type="text"  name="address" id="address" class="form-control" ></textarea>
                        <span class="text-danger description_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Facebook</label>
                        <input type="text" name="facebook" id="facebook" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Instagram</label>
                        <input type="text" name="instagram" id="instagram" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Linkdin</label>
                        <input type="text" name="linkedin" id="linkedin" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Twiter</label>
                        <input type="text" name="twitter" id="twitter" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Youtube</label>
                        <input type="text" name="youtube" id="youtube" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="name">Google Map</label>
                        <input type="text" name="google_map" id="google_map" class="form-control" >
                        <span class="text-danger name_Error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary add_contact" >Save Category</button>
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
                $('.DataTable').DataTable().ajax.reload();
                }
            },


        });
    });
});
</script>

@endpush


