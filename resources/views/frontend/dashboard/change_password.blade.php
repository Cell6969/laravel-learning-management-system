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
            <h3 class="fs-17 font-weight-semi-bold pb-4">Change Password</h3>
            <form method="post" action="{{route('user.change_password.store')}}" class="row pt-40px">
                @csrf
                <div class="input-box col-lg-12">
                    <label class="label-text">Old Password</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('old_password') is-invalid @enderror"
                               type="password" name="old_password" id="old_password">
                        <span class="la la-lock input-icon"></span>
                        @error('old_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->

                <div class="input-box col-lg-12">
                    <label class="label-text">New Password</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('password') is-invalid @enderror"
                               type="password" name="password" id="password">
                        <span class="la la-lock input-icon"></span>
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->

                <div class="input-box col-lg-12">
                    <label class="label-text">Password Confirmation</label>
                    <div class="form-group">
                        <input class="form-control form--control"
                               type="password" name="password_confirmation" id="password_confirmation">
                        <span class="la la-lock input-icon"></span>
                    </div>
                </div><!-- end input-box -->

                <div class="input-box col-lg-12 py-2">
                    <button type="submit" class="btn theme-btn">Update Password</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
@endsection
