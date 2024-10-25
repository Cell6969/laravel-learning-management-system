@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
    <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
        <div class="media media-card align-items-center">
            <div class="media-img media--img media-img-md rounded-full">
                <img class="rounded-full"
                     src="{{ (!empty($user->photo)) ? url('upload/user_images/'.$user->photo) : url('upload/no_image.jpg')}}"
                     alt="Student thumbnail image"
                     width="60">
            </div>
            <div class="media-body">
                <h2 class="section__title fs-30">Hello, {{ $user->name }}</h2>

            </div><!-- end media-body -->
        </div><!-- end media -->

    </div><!-- end breadcrumb-content -->


    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
        <div class="setting-body">
            <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>


            <form method="post" action="{{route('user.profile.store')}}" enctype="multipart/form-data"
                  class="row pt-40px">
                @csrf

                <div class="media media-card align-items-center">
                    <div class="media-img media-img-md mr-4 bg-gray">
                        <img class="mr-3"
                             src="{{ (!empty($user->photo)) ? url('upload/user_images/'.$user->photo) : url('upload/no_image.jpg')}}"
                             alt="avatar image"
                             width="60">
                    </div>
                    <div class="media-body">
                        <div class="file-upload-wrap file-upload-wrap-2">
                            <input type="file" name="photo" class="multi file-upload-input with-preview" multiple>
                            <span class="file-upload-text"><i class="la la-photo mr-2"></i>Upload a Photo</span>
                        </div><!-- file-upload-wrap -->
                        <p class="fs-14">Max file size is 5MB, Minimum dimension: 200x200 And Suitable files are .jpg &
                            .png</p>

                    </div>
                </div><!-- end media -->

                <div class="input-box col-lg-6">
                    <label class="label-text"> Name</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="name" value="{{ $user->name }}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">User Name</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="username"
                               value="{{ $user->username }}">
                        <span class="la la-user-alt input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Email</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="email" name="email" value="{{ $user->email }}">
                        <span class="la la-envelope input-icon"></span>
                    </div>
                </div><!-- end input-box -->


                <div class="input-box col-lg-6">
                    <label class="label-text">Phone</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="phone" value="{{ $user->phone }}">
                        <span class="la la-phone input-icon"></span>
                    </div>
                </div><!-- end input-box -->

                <div class="input-box col-lg-6">
                    <label class="label-text">Address</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="address"
                               value="{{ $user->address }}">
                        <span class="la la-map-marked input-icon"></span>
                    </div>
                </div><!-- end input-box -->

                <div class="input-box col-lg-12 py-2">
                    <button type="submit" class="btn theme-btn">Save Changes</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
@endsection