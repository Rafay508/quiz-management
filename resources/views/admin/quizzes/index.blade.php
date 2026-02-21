@extends('admin.layouts.app')

@section('title', 'Quiz Management')
@section('content')
<div class="layout-page">
    @include('admin.layouts.partials.navigation')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Scrollable -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Quiz Management</h5>
                    <small class="text-muted float-end">
                        <a href="{{ route('admin.quizzes.create') }}" class="btn btn-primary">Create Quiz</a>
                    </small>
                </div>
                
                <!-- Filters and Search -->
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('admin.quizzes.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>All</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-label-secondary">Reset</a>
                        </div>
                    </form>
                </div>

                <!-- Bulk Actions -->
                <div class="card-body border-bottom">
                    <form id="bulkActionForm" method="POST" action="{{ route('admin.quizzes.bulk-action') }}">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                    <label class="form-check-label" for="selectAll">Select All</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="action" id="bulkAction" class="form-select" required>
                                    <option value="">Choose Action</option>
                                    <option value="publish">Publish</option>
                                    <option value="archive">Archive</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" id="applyBulkAction" disabled>Apply</button>
                            </div>
                        </div>
                        <input type="hidden" name="selected_ids" id="selectedIds" value="">
                    </form>
                </div>

                <div class="card-datatable text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="50">
                                    <input type="checkbox" class="form-check-input" id="selectAllTable">
                                </th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Total Marks</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quizzes as $quiz)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input quiz-checkbox" value="{{ $quiz->id }}">
                                    </td>
                                    <td>{{ $quiz->id }}</td>
                                    <td>{{ $quiz->title }}</td>
                                    <td>{{ $quiz->category->name ?? 'N/A' }}</td>
                                    <td>{{ $quiz->duration_minutes }} min</td>
                                    <td>{{ $quiz->total_marks }}</td>
                                    <td>
                                        @if($quiz->status == 'published')
                                            <span class="badge bg-label-success">Published</span>
                                        @elseif($quiz->status == 'draft')
                                            <span class="badge bg-label-warning">Draft</span>
                                        @else
                                            <span class="badge bg-label-secondary">Archived</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-inline-block">
                                            <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" id="deleteForm{{ $quiz->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <!-- More Actions -->
                                            <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="text-primary ti ti-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end m-0">
                                                <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="dropdown-item">Edit</a>
                                                @if($quiz->status == 'draft')
                                                    <form action="{{ route('admin.quizzes.publish', $quiz->id) }}" method="POST" style="display: inline;" id="publishForm{{ $quiz->id }}">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to publish this quiz?')">Publish</button>
                                                    </form>
                                                @endif
                                                @if($quiz->status != 'archived')
                                                    <form action="{{ route('admin.quizzes.archive', $quiz->id) }}" method="POST" style="display: inline;" id="archiveForm{{ $quiz->id }}">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to archive this quiz?')">Archive</button>
                                                    </form>
                                                @endif
                                                <button type="button" onclick="deleteConfirmation({{ $quiz->id }})" class="dropdown-item text-danger delete-record">Delete</button>
                                            </div>

                                            <!-- Edit -->
                                            <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="item-edit text-body">
                                                <i class="text-primary ti ti-pencil"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No quizzes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Scrollable -->
        </div>
        <!-- / Content -->
        @include('admin.layouts.partials.footer')
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
</div>

@endsection

@section('footer-js')
<script>
    // Select All functionality
    $('#selectAll, #selectAllTable').on('change', function() {
        $('.quiz-checkbox').prop('checked', $(this).prop('checked'));
        updateBulkActionButton();
    });

    $('.quiz-checkbox').on('change', function() {
        updateBulkActionButton();
        // Update select all checkbox
        var totalCheckboxes = $('.quiz-checkbox').length;
        var checkedCheckboxes = $('.quiz-checkbox:checked').length;
        $('#selectAll, #selectAllTable').prop('checked', totalCheckboxes === checkedCheckboxes);
    });

    function updateBulkActionButton() {
        var selectedIds = [];
        $('.quiz-checkbox:checked').each(function() {
            selectedIds.push($(this).val());
        });
        
        $('#selectedIds').val(selectedIds.join(','));
        
        if (selectedIds.length > 0 && $('#bulkAction').val()) {
            $('#applyBulkAction').prop('disabled', false);
        } else {
            $('#applyBulkAction').prop('disabled', true);
        }
    }

    $('#bulkAction').on('change', function() {
        updateBulkActionButton();
    });

    // Bulk action form submission
    $('#bulkActionForm').on('submit', function(e) {
        e.preventDefault();
        
        var action = $('#bulkAction').val();
        var selectedIds = $('#selectedIds').val();
        
        if (!selectedIds || !action) {
            alert('Please select quizzes and an action.');
            return;
        }

        var actionText = action.charAt(0).toUpperCase() + action.slice(1);
        if (confirm('Are you sure you want to ' + action + ' the selected quiz(es)?')) {
            // Convert comma-separated string to array for the form
            var idsArray = selectedIds.split(',');
            idsArray.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'selected_ids[]',
                    value: id
                }).appendTo('#bulkActionForm');
            });
            
            this.submit();
        }
    });
</script>
@endsection
