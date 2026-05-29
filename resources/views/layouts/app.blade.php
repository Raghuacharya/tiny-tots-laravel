<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getSchoolProfile()->name }} – @yield('title', 'Admin panel')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/material.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css?v=1.0.0') }}">
    @yield('page_styles')
</head>

<body class="hold-transition sidebar-mini text-sm">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            @if (getSchoolProfile()->logo)
                <img class="animation__shake" src="{{ asset('storage/' . getSchoolProfile()->logo) }}"
                    alt="{{ getSchoolProfile()->name }}" height="60" width="60">
            @else
                <img class="animation__shake" src="{{ asset('admin_logo.png') }}" alt="{{ getSchoolProfile()->name }}"
                    height="60" width="60">
            @endif
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-info navbar-light bg-white text-sm border-bottom-0">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="{{ route('admin.auth.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link p-0" style="color: #363636; text-decoration: none;">
                            <i class="fas fa-sign-out-alt" style="color: #363636"></i>&nbsp;Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                @if (getSchoolProfile()->logo)
                    <img src="{{ asset('storage/' . getSchoolProfile()->logo) }}" alt="{{ getSchoolProfile()->name }}"
                        class="brand-image img-circle elevation-3" style="opacity: .8; max-height: 40px;">
                @else
                    <img src="{{ asset('admin_logo.png') }}" alt="{{ getSchoolProfile()->name }}"
                        class="brand-image img-circle elevation-3" style="opacity: .8; max-height: 40px;">
                @endif
                <span class="brand-text">{{ getSchoolProfile()->name }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ isActive('admin.dashboard') }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Teachers Management -->
                        <li class="nav-item {{ isMenuOpen(['admin.teachers.*']) }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Teachers
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.teachers.index') }}"
                                        class="nav-link {{ isActive(['admin.teachers.index', 'admin.teachers.show', 'admin.teachers.edit']) }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Teachers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.teachers.create') }}"
                                        class="nav-link {{ isActive('admin.teachers.create') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Teacher</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Classes & Sections -->
                        <li class="nav-item {{ isMenuOpen(['admin.classes.*', 'admin.sections.*']) }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard"></i>
                                <p>
                                    Classes & Sections
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.classes.index') }}"
                                        class="nav-link {{ isActive('admin.classes.*') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Classes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.sections.index') }}"
                                        class="nav-link {{ isActive('admin.sections.*') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Sections</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Students Management -->
                        <li class="nav-item {{ isMenuOpen(['admin.students.*']) }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-child"></i>
                                <p>
                                    Students
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.students.index') }}"
                                        class="nav-link {{ isActive(['admin.students.index', 'admin.students.edit', 'admin.students.show']) }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Students</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.students.create') }}"
                                        class="nav-link {{ isActive('admin.students.create') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Student</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Parents Management -->
                        <li class="nav-item {{ isMenuOpen(['admin.parents.*']) }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Parents
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.parents.index') }}"
                                        class="nav-link {{ isActive(['admin.parents.index', 'admin.parents.edit', 'admin.parents.show']) }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Parents</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.parents.create') }}"
                                        class="nav-link {{ isActive('admin.parents.create') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Parent</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <!-- Attendance Management -->
                        <li class="nav-item {{ isMenuOpen(['admin.attendance.*']) }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>
                                    Attendance
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.attendance.teachers.index') }}"
                                        class="nav-link {{ isActive(['admin.attendance.teachers.index']) }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Teachers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.attendance.students.index') }}"
                                        class="nav-link {{ isActive('admin.attendance.students.index') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Students</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Fees Management -->
                        <li
                            class="nav-item {{ isMenuOpen(['admin.fees.*', 'admin.collect.fees.*', 'admin.collect-fees.*', 'admin.manual-receipts.*']) }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>
                                    Fees
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.fees.index') }}"
                                        class="nav-link {{ isActive('admin.fees.*') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Fees</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.collect.fees.index') }}"
                                        class="nav-link {{ isActive(['admin.collect.fees.index', 'admin.collect-fees.show']) }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Collect Fees</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.manual-receipts.index') }}"
                                        class="nav-link {{ isActive(['admin.manual-receipts.*']) }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manual Receipt</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Payments & Fees -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-rupee-sign"></i>
                                <p>
                                    Payments
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payment History</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Record Payment</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pending Fees</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <!-- Payment Links & QR Codes -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-qrcode"></i>
                                <p>
                                    Payment Links
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Generate Links</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>QR Codes</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <!-- Receipts -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>
                                    Receipts
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Receipts</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Generate Receipt</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <!-- Reports -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    Reports
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Monthly Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fee Collection</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Student Report</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <!-- Settings -->
                        <li
                            class="nav-item {{ isMenuOpen(['admin.school.*']) }} {{ isMenuOpen(['admin.academic-years.*']) }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Settings
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.school.edit') }}"
                                        class="nav-link {{ isActive('admin.school.edit') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>School Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.academic-years.index') }}"
                                        class="nav-link {{ isActive('admin.academic-years.*') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Academic Years</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payment Settings</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Email Settings</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                        <!-- Separator -->
                        {{-- <li class="nav-header">PARENT ACCESS</li> --}}

                        <!-- Parent Portal Preview -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-external-link-alt"></i>
                                <p>Parent Portal</p>
                            </a>
                        </li> --}}

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')


        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                <a href="{{ route('admin.version.log') }}" style="text-decoration: none;">
                    V {{ $appVersion }}
                </a>
            </div>
            <strong>Copyright &copy; {{ date('Y') }} <a
                    href="">{{ getSchoolProfile()->website }}</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('js/ajax-loader.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(document).on('click', '.open-confirm-modal', function() {
                let message = $(this).data('message');
                let action = $(this).data('action');
                let method = $(this).data('method');

                $('#confirmModalMessage').text(message);
                $('#confirmModalForm').attr('action', action);

                // Reset method input first
                $('#confirmModalForm').find('input[name="_method"]').remove();

                if (method && method !== 'POST') {
                    $('#confirmModalForm').append('<input type="hidden" name="_method" value="' + method +
                        '">');
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Listen for all form submissions
            document.querySelectorAll('form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    // Find the submit button inside the submitted form
                    const submitBtn = form.querySelector('[type="submit"]:not([disabled])');
                    if (submitBtn) {
                        // Disable button
                        submitBtn.disabled = true;

                        // Optional: Keep existing text, show spinner next to it
                        // Remove any previous spinner
                        const existingSpinner = submitBtn.querySelector('.btn-spinner');
                        if (existingSpinner) existingSpinner.remove();

                        // Add the spinner
                        const spinner = document.createElement('span');
                        spinner.className = 'btn-spinner spinner-border spinner-border-sm ml-2';
                        spinner.setAttribute('role', 'status');
                        spinner.setAttribute('aria-hidden', 'true');
                        submitBtn.appendChild(spinner);
                    }
                });
            });
        });
    </script>


    @yield('page_scripts')
    @stack('body_scripts')
</body>

</html>
