@extends('layouts.app')
@section('title', 'Fee Details | ' . $fee->name)
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Fee Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.fees.index') }}">Fees</a></li>
                            <li class="breadcrumb-item active">Fee</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Fee details</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.fees.edit', $fee->id) }}"
                                        class="btn btn-default btn-sm">
                                        <i class="fas fa-edit" style="font-size: 12px"></i> Edit
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <table class="table table-sm table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Class</th>
                                                    <td>{{ $fee->class->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Fee name</th>
                                                    <td>{{ $fee->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Amount</th>
                                                    <td>{{ $fee->amount }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Frequency</th>
                                                    <td>{{ ucfirst($fee->frequency) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Term</th>
                                                    <td>{{ $fee->term ? $fee->term : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Description</th>
                                                    <td>{{ $fee->description }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
