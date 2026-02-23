@extends('admin.layouts.app')

@section('title', 'Categories')
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
                    <h5 class="mb-0">Categories</h5>
                    <div class="float-end">
                        <a href="{!! route('admin.categories.reports.all') !!}" class="btn btn-label-secondary me-2">View All Reports</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                            Add Category
                        </button>
                    </div>
                </div>
                <div class="card-datatable text-nowrap">
                  <table class="dt-scrollableTable table">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quiz Count</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td>
                                    @if($category->image)
                                        <img src="{!! asset($category->image) !!}" alt="{!! $category->name !!}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;" />
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{!! $category->name !!}</td>
                                <td>{!! Str::limit($category->description ?? 'N/A', 50, '...') !!}</td>
                                <td>{!! $category->quizzes_count !!}</td>
                                <td>
                                    @if ($category->status == 'active')
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-inline-block">
                                        <form action="{!! URL::route('admin.categories.destroy', $category->id) !!}" method="POST" id="deleteForm{!! $category->id !!}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="transfer_category_id" id="transfer_category_id_{!! $category->id !!}" value="">
                                        </form>

                                        <!-- More Actions -->
                                        <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            <a href="{!! route('admin.categories.reports', $category->id) !!}" class="dropdown-item">Reports</a>
                                            <button type="button" onclick="deleteCategoryConfirmation({!! $category->id !!}, {!! $category->quizzes_count !!})" class="dropdown-item text-danger delete-record">Delete</button>
                                        </div>

                                        <!-- Edit -->
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editCategoryModal{!! $category->id !!}" class="item-edit text-body"><i class="text-primary ti ti-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editCategoryModal{!! $category->id !!}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
                                    <div class="modal-content p-3 p-md-5">
                                        <div class="modal-body">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <div class="text-center mb-4">
                                                <h3 class="mb-2">Edit Category</h3>
                                            </div>

                                            <form class="row g-3" action="{!! route('admin.categories.update', $category->id) !!}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="col-12">
                                                    <label class="form-label w-100" for="edit_name_{!! $category->id !!}">Name *</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" name="name" id="edit_name_{!! $category->id !!}" class="form-control" placeholder="Category Name" value="{!! old('name', $category->name) !!}" required />
                                                    </div>
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="edit_description_{!! $category->id !!}">Description</label>
                                                    <textarea class="form-control" name="description" id="edit_description_{!! $category->id !!}" placeholder="Category Description" rows="3">{!! old('description', $category->description) !!}</textarea>
                                                    @error('description')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="edit_image_{!! $category->id !!}">Image</label>
                                                    <input type="file" name="image" id="edit_image_{!! $category->id !!}" class="form-control" accept="image/*" onchange="previewImage(this, 'edit_imagePreview_{!! $category->id !!}')" />
                                                    <div class="mt-2" id="edit_imagePreview_{!! $category->id !!}">
                                                        @if($category->image)
                                                            <img src="{!! asset($category->image) !!}" alt="Current Image" style="max-width: 200px; max-height: 200px; border-radius: 4px;" />
                                                            <p class="text-muted mt-1">Current image</p>
                                                        @endif
                                                    </div>
                                                    <div class="mt-2" id="edit_imagePreviewNew_{!! $category->id !!}" style="display: none;">
                                                        <img id="edit_imagePreviewNewImg_{!! $category->id !!}" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 4px;" />
                                                        <p class="text-muted mt-1">New image preview</p>
                                                    </div>
                                                    @error('image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="edit_status_{!! $category->id !!}">Status *</label>
                                                    <select class="form-select" name="status" id="edit_status_{!! $category->id !!}" required>
                                                        <option value="active" {!! $category->status == 'active' ? 'selected' : '' !!}>Active</option>
                                                        <option value="inactive" {!! $category->status == 'inactive' ? 'selected' : '' !!}>Inactive</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 text-center mt-3">
                                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                                                    <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Add Category</h3>
                </div>

                                            <form class="row g-3" action="{!! route('admin.categories.store') !!}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <label class="form-label w-100" for="name">Name *</label>
                        <div class="input-group input-group-merge">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Category Name" value="{!! old('name') !!}" required />
                        </div>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Category Description" rows="3">{!! old('description') !!}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this, 'imagePreview')" />
                        <div class="mt-2" id="imagePreview" style="display: none;">
                            <img id="imagePreviewImg" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 4px;" />
                        </div>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="status">Status *</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="active" {!! old('status') == 'active' ? 'selected' : '' !!}>Active</option>
                            <option value="inactive" {!! old('status') == 'inactive' ? 'selected' : '' !!}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Add Category</button>
                        <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
var categoriesData = {!! json_encode($categories->map(function($cat) { return ['id' => $cat->id, 'name' => $cat->name]; })) !!};

function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            // Check if this is an edit form (has edit_imagePreview_ prefix)
            if (previewId && previewId.indexOf('edit_imagePreview_') !== -1) {
                // For edit forms, show new preview and hide current image
                var categoryId = previewId.replace('edit_imagePreview_', '');
                var currentPreview = document.getElementById('edit_imagePreview_' + categoryId);
                var newPreview = document.getElementById('edit_imagePreviewNew_' + categoryId);
                
                if (currentPreview) {
                    currentPreview.style.display = 'none';
                }
                
                if (newPreview) {
                    var newImg = document.getElementById('edit_imagePreviewNewImg_' + categoryId);
                    if (newImg) {
                        newImg.src = e.target.result;
                        newPreview.style.display = 'block';
                    }
                }
            } else {
                // For create form
                var previewElement = document.getElementById(previewId);
                if (previewElement) {
                    var img = document.getElementById(previewId + 'Img');
                    if (!img) {
                        img = previewElement.querySelector('img');
                    }
                    if (img) {
                        img.src = e.target.result;
                        previewElement.style.display = 'block';
                    }
                }
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function deleteCategoryConfirmation(id, quizCount) {
    if (quizCount > 0) {
        // Build options HTML
        var optionsHtml = '<option value="">-- Select Category --</option>';
        categoriesData.forEach(function(cat) {
            if (cat.id != id) {
                optionsHtml += '<option value="' + cat.id + '">' + cat.name + '</option>';
            }
        });
        
        // Show modal to transfer quizzes
        Swal.fire({
            title: 'Category has quizzes!',
            html: `
                <p>This category has <strong>${quizCount}</strong> quiz(es).</p>
                <p>Please select a category to transfer these quizzes to:</p>
                <select id="transferCategorySelect" class="form-select mt-3">
                    ${optionsHtml}
                </select>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete & Transfer',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-primary me-3',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false,
            didOpen: () => {
                const select = document.getElementById('transferCategorySelect');
                select.style.width = '100%';
                select.style.marginTop = '10px';
            },
            preConfirm: () => {
                const transferId = document.getElementById('transferCategorySelect').value;
                if (!transferId) {
                    Swal.showValidationMessage('Please select a category to transfer quizzes to');
                    return false;
                }
                return transferId;
            }
        }).then(function (result) {
            if (result.value) {
                // Set the transfer category ID
                document.getElementById('transfer_category_id_' + id).value = result.value;
                
                // Confirm deletion
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then(function (confirmResult) {
                    if (confirmResult.value) {
                        document.getElementById("deleteForm" + id).submit();
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Category has been deleted and quizzes transferred.',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }
                });
            }
        });
    } else {
        // No quizzes, proceed with normal deletion
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                confirmButton: 'btn btn-primary me-3',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                document.getElementById("deleteForm" + id).submit();
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Category has been deleted.',
                    customClass: {
                        confirmButton: 'btn btn-success'
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'Your data is safe :)',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-success'
                    }
                });
            }
        });
    }
}
</script>

@endsection
