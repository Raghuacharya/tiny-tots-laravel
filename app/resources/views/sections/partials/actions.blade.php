<a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-primary btn-xs" title="Edit">
    <i class="fas fa-edit"></i>
</a>
<button type="button"
    class="btn btn-danger btn-xs open-confirm-modal"
    title="Delete"
    data-message="Are you sure you want to delete {{ $section->name }}?"
    data-action="{{ route('admin.sections.destroy', $section->id) }}"
    data-method="DELETE"
    data-toggle="modal"
    data-target="#confirmModal">
    <i class="fas fa-trash-alt"></i>
</button>
