@extends('layouts.app')
@section('title', 'Add Fee')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Fee</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.fees.index') }}">Fees</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <x-alert />
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Enter fee details</h3>
                            </div>
                            <form action="{{ route('admin.fees.store') }}" method="POST">
                                @include('fees._form', ['row' => null])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
        $('#frequency').on('change', function () {
            var frequency = $(this).val();
            var term = $('#term');

            if (frequency != 'termly') {
                term.val('');
                term.prop('disabled', true);
            } else {
                term.prop('disabled', false);
            }
        });
    });
</script>
@endsection
