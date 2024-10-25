@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('category.add')}}" class="btn btn-primary px-3 ">Add Category </a>
                </div>
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
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category => $item)
                            <tr>
                                <td>{{$category+1}}</td>
                                <td>
                                    {{$item->category_name}}
                                </td>
                                <td>
                                    <img src="{{asset($item->image)}}" alt="" style="width: 100px; height: 60px">
                                </td>
                                <td>
                                    <a href="{{route('category.edit', ["id" => $item->id])}}"
                                       class="btn btn-primary px-3 "><i
                                            class="bx bx-edit"></i>Edit</a>
                                    <a href="{{route('category.delete', ["id" => $item->id])}}"
                                       class="btn btn-danger px-3" id="delete"><i class="bx bx-eraser"></i>Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
