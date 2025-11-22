<a href="{{ route('admin.classes.show', $class->id) }}" class="actions_link" title="View">
    <i class="fas fa-eye" style="font-size: 11px;"></i> View
</a>
<a href="{{ route('admin.classes.edit', $class->id) }}" class="actions_link" title="Edit">
    <i class="fas fa-pencil-alt" style="font-size: 11px;"></i> Edit
</a>
<a href="javascript:void(0)" class="open-confirm-modal actions_link" title="Delete"
    data-message="Are you sure you want to delete {{ $class->name }}?"
    data-action="{{ route('admin.classes.destroy', $class->id) }}" data-method="DELETE" data-toggle="modal"
    data-target="#confirmModal">
    <i class="fas fa-trash-alt" style="font-size: 11px"></i> Delete
</a>
