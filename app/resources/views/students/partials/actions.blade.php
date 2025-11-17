<a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-info btn-xs" title="View">
    <i class="fas fa-eye"></i>
</a>
<a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-primary btn-xs" title="Edit">
    <i class="fas fa-edit"></i>
</a>
<form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete {{ $student->full_name }}?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-xs" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </button>
</form>
