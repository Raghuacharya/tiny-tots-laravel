@foreach ($teachers as $teacher)
    @php $attendance = $absentAttendance[$teacher->id] ?? null; @endphp
    <tr>
        <td>{{ $teacher->full_name }}</td>
        <td>
            <select name="attendance[{{ $teacher->id }}][status]" class="form-control form-control-sm">
                <option value="">Present</option>
                <option value="Absent" {{ $attendance && $attendance->status == 'Absent' ? 'selected' : '' }}>Absent
                </option>
                <option value="Leave" {{ $attendance && $attendance->status == 'Leave' ? 'selected' : '' }}>Leave
                </option>
            </select>
        </td>
        <td>
            <input type="text" name="attendance[{{ $teacher->id }}][remarks]" value="{{ $attendance->remarks ?? '' }}"
                placeholder="Remarks (optional)" class="form-control form-control-sm" />
        </td>
    </tr>
@endforeach
