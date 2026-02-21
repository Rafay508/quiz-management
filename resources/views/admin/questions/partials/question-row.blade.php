<tr id="questionRow{{ $question->id }}">
    <td>{{ $question->id }}</td>
    <td class="question-text">{{ Str::limit(strip_tags($question->question_text), 50, '...') }}</td>
    <td>{{ $question->quiz->title ?? 'N/A' }}</td>
    <td class="question-marks">{{ $question->marks }}</td>
    <td>
        @if($question->difficulty_level)
            @if($question->difficulty_level == 'easy')
                <span class="badge bg-label-success">Easy</span>
            @elseif($question->difficulty_level == 'medium')
                <span class="badge bg-label-warning">Medium</span>
            @else
                <span class="badge bg-label-danger">Hard</span>
            @endif
        @else
            <span class="text-muted">—</span>
        @endif
    </td>
    <td>
        <div class="d-inline-block">
            <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" id="deleteForm{{ $question->id }}">
                @csrf
                @method('DELETE')
            </form>

            <!-- More Actions -->
            <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="text-primary ti ti-dots-vertical"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end m-0">
                <a href="{{ route('admin.questions.edit', $question->id) }}" class="dropdown-item">Edit</a>
                <button type="button" onclick="enableQuickEdit({{ $question->id }})" class="dropdown-item quick-edit-btn">Quick Edit</button>
                <button type="button" onclick="deleteConfirmation({{ $question->id }})" class="dropdown-item text-danger delete-record">Delete</button>
            </div>

            <!-- Edit -->
            <a href="{{ route('admin.questions.edit', $question->id) }}" class="item-edit text-body">
                <i class="text-primary ti ti-pencil"></i>
            </a>
        </div>
    </td>
</tr>
