<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Application</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Manage Category</div>
            </a>
            <ul>
                <li><a href="{{route('category.all')}}"><i class='bx bx-radio-circle'></i>Category</a>
                </li>
                <li><a href="{{route('subcategory.all')}}"><i class='bx bx-radio-circle'></i>Sub Category</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('instructor.list')}}">
                <div class="parent-icon"><i class="bx bxs-user-account"></i>
                </div>
                <div class="menu-title">Manage Instructor</div>
            </a>
        </li>

        <li class="menu-label">Charts & Maps</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Charts</div>
            </a>
            <ul>
                <li><a href="charts-apex-chart.html"><i class='bx bx-radio-circle'></i>Apex</a>
                </li>
                <li><a href="charts-chartjs.html"><i class='bx bx-radio-circle'></i>Chartjs</a>
                </li>
                <li><a href="charts-highcharts.html"><i class='bx bx-radio-circle'></i>Highcharts</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-map-alt"></i>
                </div>
                <div class="menu-title">Maps</div>
            </a>
            <ul>
                <li><a href="map-google-maps.html"><i class='bx bx-radio-circle'></i>Google Maps</a>
                </li>
                <li><a href="map-vector-maps.html"><i class='bx bx-radio-circle'></i>Vector Maps</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
