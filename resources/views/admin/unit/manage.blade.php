@extends('master.admin.master')

@section('body')
    <!--Data Table Start-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Unit Info</h4>
                    <p class="text-center text-success">{{Session::get('message')}}</p>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Unit Name</th>
                            <th>Unit Description</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($units as $unit)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$unit->name}}</td>
                                <td>{{Str::limit($unit->description,15)}}</td>
                                <td>{{$unit->status == 1 ? 'Published' : 'Unpublished'}}</td>
                                <td>
                                    <a href="{{route('unit.edit', ['id' => $unit->id])}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{route('unit.delete', ['id' => $unit->id])}}" onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger btn-sm">
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
    <!--Data Table End-->
@endsection

