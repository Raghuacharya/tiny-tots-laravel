@extends('layouts.app')
@section('title', 'Version Log')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Application Version: <strong>V {{ $appVersion }}</strong></h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="changelog-content">
                    {!! $changelogHtml !!}
                </div>
            </div>
        </div>
    </div>
@endsection
