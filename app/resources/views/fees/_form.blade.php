@csrf
@if (isset($row))
    @method('PUT')
@endif

<div class="card-body">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="class_id">Class <span class="text-danger">*</span></label>
            <select name="class_id" id="class_id"
                class="form-control form-control-sm @error('class_id') is-invalid @enderror">
                <option value="" selected disabled>Select class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}"
                        {{ old('class_id', isset($row) ? $row->class_id : '') == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                id="name" name="name" value="{{ old('name', isset($row) ? $row->name : '') }}" required
                placeholder="Nursery fees">
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="amount">Amount <span class="text-danger">*</span></label>
            <input type="number" class="form-control form-control-sm @error('amount') is-invalid @enderror"
                id="amount" name="amount" value="{{ old('amount', isset($row) ? $row->amount : '') }}" required
                placeholder="1000">
            @error('amount')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="frequency">Frequency <span class="text-danger">*</span></label>
            <select name="frequency" id="frequency"
                class="form-control form-control-sm @error('frequency') is-invalid @enderror">
                <option value="" selected disabled>--Select frequency--</option>
                <option value="one-time"
                    {{ old('frequency', isset($row) ? $row->frequency : '') == 'one-time' ? 'selected' : '' }}>One time
                </option>
                <option value="monthly"
                    {{ old('frequency', isset($row) ? $row->frequency : '') == 'monthly' ? 'selected' : '' }}>Monthly
                </option>
                <option value="termly"
                    {{ old('frequency', isset($row) ? $row->frequency : '') == 'termly' ? 'selected' : '' }}>Termly
                </option>
                <option value="yearly"
                    {{ old('frequency', isset($row) ? $row->frequency : '') == 'yearly' ? 'selected' : '' }}>Yearly
                </option>

            </select>
            @error('frequency')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="term">Term</label>
            <input type="number" class="form-control form-control-sm @error('term') is-invalid @enderror"
                id="term" name="term" value="{{ old('term', isset($row) ? $row->term : '') }}"
                {{ old('frequency', isset($row) ? $row->frequency : '') == 'termly' ? '' : 'disabled' }}>
            @error('term')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror

            @error('term')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="description">Description</label>
            <textarea rows="5"class="form-control form-control-sm" id="description" name="description">{{ old('description', isset($row) ? $row->description : '') }}</textarea>
            @error('description')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="card-footer">
    <a href="{{ route('admin.fees.index') }}" class="btn btn-default btn-sm">Cancel</a>
    <button type="submit" class="btn btn-success btn-sm">Save</button>
</div>
