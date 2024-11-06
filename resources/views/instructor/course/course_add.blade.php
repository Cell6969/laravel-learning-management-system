@extends('instructor.instructor_dashboard')
@section('instructor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Form Course</h5>
                <form class="row g-3" id="myForm" action="{{route('instructor.course.store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="input1" name="course_name">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Title</label>
                        <input type="text" class="form-control" id="input1" name="course_title">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input2" class="form-label">Course Image</label>
                        <input type="file" class="form-control" id="image" name="course_image">
                    </div>
                    <div class="col-md-6">
                        <img id="showImage" src="{{url('upload/no_image.png')}}" alt="Admin" class="p-1"
                             width="100"/>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Intro Video</label>
                        <input type="file" class="form-control" name="video" accept="video/mp4,video/webm">
                    </div>
                    <div class="col-md-6">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Category</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="category_id">
                            <option selected="" disabled>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Subcategory</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="subcategory_id">
                            <option selected="" disabled>Select Subcategory</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Certificate Available</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="certificate">
                            <option selected="" disabled>Choose certificate</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Label</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="label">
                            <option selected="" disabled>Select Course Label</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advance">Advanced</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Price</label>
                        <input type="text" class="form-control" id="input1" name="selling_price">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Discount Price</label>
                        <input type="text" class="form-control" id="input1" name="discount_price">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Duration</label>
                        <input type="text" class="form-control" id="input1" name="duration">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Resources</label>
                        <input type="text" class="form-control" id="input1" name="resources">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Prerequisites</label>
                        <textarea name="prerequisites" class="form-control" id="input11" placeholder="Basic HTML..."
                                  rows="3"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="input11" placeholder="Description..."
                                  rows="3"></textarea>
                    </div>

                    <p>Goals </p>
                    <div class="row add_item">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="text" name="course_goals[]" id="goals" class="form-control"
                                       placeholder="Goals ">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <a class="btn btn-success btn-sm addeventmore"><i class="bx bx-plus"></i>Add More</a>
                        </div>
                    </div> <!---end row-->

                    <p></p>

                    <hr>
                    <label for="input1" class="form-label">Additional</label>
                    <div class="row">
                        <div class="col-md-4">

                            <div class="form-check">
                                <input class="form-check-input" name="bestseller" type="checkbox" value="1"
                                       id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Bestseller</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" name="featured" type="checkbox" value="1"
                                       id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Featured</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" name="highestrated" type="checkbox" value="1"
                                       id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Highestrated</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Course</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="course_goals[]" id="goals" class="form-control"
                                   placeholder="Goals  ">
                        </div>
                        <div class="form-group col-md-6">
                            <span class="btn btn-danger btn-sm removeeventmore"
                                  style="font-family: Roboto, sans-serif;"><i class="bx bx-minus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--Add & Remove Dynamic Goal--}}
    <script type="text/javascript">
        $(document).ready(function () {
            var counter = 0;
            $(document).on("click", ".addeventmore", function () {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function (event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    {{--    Validate Form --}}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
                rules: {
                    course_name: {
                        required: true,
                    },
                    course_title: {
                        required: true
                    }

                },
                messages: {
                    course_name: {
                        required: 'Course Name cannot be empty',
                    },
                    course_title: {
                        required: 'Course Title cannot be empty'
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
    {{--    Change image when input filled--}}
    <script type="text/javascript">
        $(document).ready(function () {
            $(`#image`).change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        })
    </script>
    {{--    Get subcategory based category --}}
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="category_id"]').on('change', function () {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "/category/" + category_id + "/subcategory",
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });

    </script>

@endsection
