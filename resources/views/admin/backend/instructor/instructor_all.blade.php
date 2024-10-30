@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .large-checkbox {
            transform: scale(1.5);
        }
    </style>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Instructors</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($instructors as $instructor => $item)
                            <tr>
                                <td>{{$instructor+1}}</td>
                                <td>
                                    {{$item->name}}
                                </td>
                                <td>
                                    {{$item->username}}
                                </td>
                                <td>
                                    {{$item->email}}
                                </td>
                                <td>
                                    {{$item->phone}}
                                </td>
                                <td>
                                    @if($item->status == "1")
                                        <span class="badge bg-gradient-quepal text-white shadow-sm w-100"
                                              style="font-size: small">Active</span>
                                    @else
                                        <span class="badge bg-gradient-bloody text-white shadow-sm w-100"
                                              style="font-size: small">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle large-checkbox" type="checkbox"
                                               id="flexSwitchCheckChecked"
                                               data-user-id="{{$item->id}}" {{$item->status? "checked": ""}}
                                        >
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.status-toggle').on('change', function () {
                var userId = $(this).data('user-id');
                var isChecked = $(this).is(':checked');

                // send an ajax request to update status
                $.ajax({
                    url: "{{route('instructor.status')}}",
                    method: "post",
                    data: {
                        user_id: userId,
                        is_checked: isChecked ? 1 : 0,
                        _token:"{{csrf_token()}}"
                    },
                    success: function (response) {
                        toastr.success(response.message)
                    },
                    error: function (response) {
                        toastr.error(response.message)
                    }
                })
            })
        })
    </script>
@endsection
