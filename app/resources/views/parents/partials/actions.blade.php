<a href="{{ route('admin.parents.show', $parent->id) }}" class="btn btn-info btn-xs" title="Edit">
    <i class="fas fa-eye"></i>
</a>
<a href="{{ route('admin.parents.edit', $parent->id) }}" class="btn btn-primary btn-xs" title="Edit">
    <i class="fas fa-edit"></i>
</a>
<button type="button"
    class="btn btn-danger btn-xs open-confirm-modal"
    title="Delete"
    data-message="Are you sure you want to delete {{ $parent->name }}?"
    data-action="{{ route('admin.parents.destroy', $parent->id) }}"
    data-method="DELETE"
    data-toggle="modal"
    data-target="#confirmModal">
    <i class="fas fa-trash-alt"></i>
</button>
