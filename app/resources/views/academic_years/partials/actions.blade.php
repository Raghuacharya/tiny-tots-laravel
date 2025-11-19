<a href="{{ route('admin.academic-years.show', $academicYear->id) }}" class="actions_link" title="View">
    <i class="fas fa-eye" style="font-size: 11px;"></i> View
</a>
<a href="{{ route('admin.academic-years.edit', $academicYear->id) }}" class="actions_link" title="Edit">
    <i class="fas fa-pencil-alt" style="font-size: 11px;"></i> Edit
</a>
<a href="javascript:void(0)" class="open-confirm-modal actions_link" title="Delete"
    data-message="Are you sure you want to delete {{ $academicYear->name }}?"
    data-action="{{ route('admin.academic-years.destroy', $academicYear->id) }}" data-method="DELETE" data-toggle="modal"
    data-target="#confirmModal">
    <i class="fas fa-trash-alt" style="font-size: 11px"></i> Delete
</a>
