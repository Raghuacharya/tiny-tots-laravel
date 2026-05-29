@csrf
@if (isset($row))
    @method('PUT')
@endif

<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-general-tab" data-toggle="pill"
                    href="#custom-tabs-four-general" role="tab" aria-controls="custom-tabs-four-general"
                    aria-selected="true">General Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-academic-tab" data-toggle="pill"
                    href="#custom-tabs-four-academic" role="tab" aria-controls="custom-tabs-four-academic"
                    aria-selected="false">Academic Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-medical-tab" data-toggle="pill"
                    href="#custom-tabs-four-medical" role="tab" aria-controls="custom-tabs-four-medical"
                    aria-selected="false">Medical Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-history-documents-tab" data-toggle="pill"
                    href="#custom-tabs-four-history-documents" role="tab"
                    aria-controls="custom-tabs-four-history-documents" aria-selected="false">History & Documents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-parents-tab" data-toggle="pill"
                    href="#custom-tabs-four-parents" role="tab" aria-controls="custom-tabs-four-parents"
                    aria-selected="false">Parents & Siblings</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-four-general" role="tabpanel"
                aria-labelledby="custom-tabs-four-general-tab">
                <!-- General Information Form Fields -->
                @include('students.partials.general_information_form', ['row' => $student ?? null])
                <div class="row mt-4">
                    <div class="col-12 text-right">
                        <button type="button" class="btn btn-primary btn-sm px-4 btn-next">
                            Next: Academic Details →
                        </button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-academic" role="tabpanel"
                aria-labelledby="custom-tabs-four-academic-tab">
                <!-- Academic Details Form Fields -->
                @include('students.partials.academic_details_form', ['row' => $student ?? null])
                <div class="row mt-4">
                    <div class="col-6">
                        <button type="button" class="btn btn-default btn-sm px-4 btn-prev">
                            ← Previous
                        </button>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-primary btn-sm px-4 btn-next">
                            Next: Medical Details →
                        </button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-medical" role="tabpanel"
                aria-labelledby="custom-tabs-four-medical-tab">
                <!-- Medical Details Form Fields -->
                @include('students.partials.medical_details_form', ['row' => $student ?? null])
                <div class="row mt-4">
                    <div class="col-6">
                        <button type="button" class="btn btn-default btn-sm px-4 btn-prev">
                            ← Previous
                        </button>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-primary btn-sm px-4 btn-next">
                            Next: History & Documents →
                        </button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-history-documents" role="tabpanel"
                aria-labelledby="custom-tabs-four-history-documents-tab">
                <!-- Documents Upload Form Fields -->
                @include('students.partials.history_documents_upload_form', ['row' => $student ?? null])
                <div class="row mt-4">
                    <div class="col-6">
                        <button type="button" class="btn btn-default btn-sm px-4 btn-prev">
                            ← Previous
                        </button>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-primary btn-sm px-4 btn-next">
                            Next: Parents & Siblings →
                        </button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-parents" role="tabpanel"
                aria-labelledby="custom-tabs-four-parents-tab">
                <!-- Parents & Siblings Form Fields -->
                @include('students.partials.parents_siblings_form', ['row' => $student ?? null])
                <div class="row mt-4">
                    <div class="col-6">
                        <button type="button" class="btn btn-default btn-sm px-4 btn-prev">
                            ← Previous
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.students.index') }}" class="btn btn-default btn-sm px-4">Cancel</a>
        <button type="submit" class="btn btn-success btn-sm px-4">Save</button>
    </div>
</div>
