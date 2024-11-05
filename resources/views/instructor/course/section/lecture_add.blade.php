@extends('instructor.instructor_dashboard')
@section('instructor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border" width="90"
                                 height="90" alt="...">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mt-0">{{ $course->course_name }}</h5>
                                <p class="mb-0">{{$course->course_title}}</p>
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Add Section
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Lecture--}}
    @foreach($course->course_section as $key => $item)
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body p-4 d-flex justify-content-between">
                                <h6>{{$item->section_title}}</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <form
                                        action="{{route('instructor.course.section.delete', ["course_id" => $course->id, "section_id" => $item->id])}}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger px-2 ms-auto" type="submit">Delete Section
                                        </button>
                                    </form>
                                    &nbsp;
                                    <a class="btn btn-success"
                                       onclick="addLectureDiv( {{$course->id}} ,{{$item->id}}, 'lectureContainer{{$key}}')"
                                       id="addLectureBtn($key)">Add
                                        Lecture</a>
                                </div>
                            </div>
                            <div class="courseHide" id="lectureContainer{{$key}}">
                                <div class="container">
                                    @foreach($item->course_lecture as $lecture)
                                        <div class="lectureDiv mb-3 d-flex align-items-center justify-content-between">
                                            <div>
                                                <strong>{{$loop->iteration}}. {{$lecture->lecture_title}}</strong>
                                            </div>
                                            <div class="btn-group">
                                                <a href="{{route('instructor.course.lecture.edit', ["course_id" => $course->id, "section_id" => $item->id, "lecture_id" => $lecture->id])}}"
                                                   class="btn btn-primary">Edit</a> &nbsp;
                                                <a href="{{route('instructor.course.lecture.delete',["course_id" => $course->id, "section_id" => $item->id, "lecture_id" => $lecture->id])}}"
                                                   class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Add Section--}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Section </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $course->id }}">

                        <div class="form-group mb-3">
                            <label for="input1" class="form-label">Course Section</label>
                            <input type="text" name="section_title" class="form-control" id="input1">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--Script--}}
    <script>
        function addLectureDiv(course_id, section_id, container_id) {
            const lectureContainer = document.getElementById(container_id);
            const newLectureDiv = document.createElement('div');
            newLectureDiv.classList.add('lectureDiv', 'mb-3');
            newLectureDiv.innerHTML = `
             <div class="container">
                <h6>Lecture Title</h6>
                <input type="text" class="form-control" name="lecture_title" placeholder="Please input lecture title">
                <textarea class="form-control mt-2" placeholder="Please input lecture content"></textarea>

                <h6 class="mt-3">Add Video URL</h6>
                <input type="text" name="url" class="form-control" placeholder="Add URL">

                <button class="btn btn-primary mt-3" onclick="saveLecture('${course_id}', '${section_id}', '${container_id}')">Save Lecture</button>
                <button class="btn btn-secondary mt-3" onclick="hideLectureContainer('${container_id}')">Cancel</button>
            </div>
            `
            lectureContainer.appendChild(newLectureDiv)
        }

        function hideLectureContainer(container_id) {
            const lectureContainer = document.getElementById(container_id);
            lectureContainer.style.display = 'none';
            location.reload();
        }
    </script>
    <script>
        function saveLecture(course_id, section_id, container_id) {
            const lectureContainer = document.getElementById(container_id);
            const lectureTitle = lectureContainer.querySelector('input[type="text"]').value;
            const lectureContent = lectureContainer.querySelector('textarea').value;
            const lecture_url = lectureContainer.querySelector('input[name="url"]').value;

            fetch(`/instructor/course/${course_id}/section/${section_id}/lecture`, {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                body: JSON.stringify({
                    lecture_title: lectureTitle,
                    lecture_content: lectureContent,
                    lecture_url: lecture_url
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    lectureContainer.style.display = 'none';

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 6000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })
                        location.reload();
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })
                    }
                })
                .catch(error => {
                    console.error(error)
                })
        }
    </script>
@endsection
