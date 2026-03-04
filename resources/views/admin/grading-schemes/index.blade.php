@extends('admin.layouts.app')

@section('title', 'Grading Schemes')
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
                    <h5 class="mb-0">Grading Schemes</h5>
                    <div class="float-end">
                        <small class="text-muted">Note: You can only edit existing grading slabs.</small>
                    </div>
                </div>
                <div class="card-datatable text-nowrap">
                    <table class="dt-scrollableTable table">
                        <thead>
                            <tr>
                                <th>Grade Name</th>
                                <th>Min Percentage</th>
                                <th>Max Percentage</th>
                                <th>Reward Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gradingSchemes as $scheme)
                                <tr>
                                    <td><strong>{!! $scheme->grade_name !!}</strong></td>
                                    <td>{!! number_format($scheme->min_percentage, 2) !!}%</td>
                                    <td>{!! number_format($scheme->max_percentage, 2) !!}%</td>
                                    <td>PKR {!! number_format($scheme->reward_amount, 2) !!}</td>
                                    <td>
                                        @if ($scheme->is_active)
                                            <span class="badge bg-label-success">Active</span>
                                        @else
                                            <span class="badge bg-label-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-inline-block">
                                            <!-- Edit -->
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editGradingSchemeModal{!! $scheme->id !!}" class="item-edit text-body"><i class="text-primary ti ti-pencil"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editGradingSchemeModal{!! $scheme->id !!}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
                                        <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h3 class="mb-2">Edit Grading Scheme - {!! $scheme->grade_name !!}</h3>
                                                    <p class="text-muted">Update the percentage range and reward amount for this grade.</p>
                                                </div>

                                                <form class="row g-3" action="{!! route('admin.grading-schemes.update', $scheme->id) !!}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    
                                                    <div class="col-12">
                                                        <label class="form-label w-100" for="edit_min_percentage_{!! $scheme->id !!}">Minimum Percentage *</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="number" 
                                                                   name="min_percentage" 
                                                                   id="edit_min_percentage_{!! $scheme->id !!}" 
                                                                   class="form-control @error('min_percentage') is-invalid @enderror" 
                                                                   placeholder="0.00" 
                                                                   step="0.01" 
                                                                   min="0" 
                                                                   max="100"
                                                                   value="{!! old('min_percentage', $scheme->min_percentage) !!}" 
                                                                   required />
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                        @error('min_percentage')
                                                            <div class="text-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label w-100" for="edit_max_percentage_{!! $scheme->id !!}">Maximum Percentage *</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="number" 
                                                                   name="max_percentage" 
                                                                   id="edit_max_percentage_{!! $scheme->id !!}" 
                                                                   class="form-control @error('max_percentage') is-invalid @enderror" 
                                                                   placeholder="100.00" 
                                                                   step="0.01" 
                                                                   min="0" 
                                                                   max="100"
                                                                   value="{!! old('max_percentage', $scheme->max_percentage) !!}" 
                                                                   required />
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                        @error('max_percentage')
                                                            <div class="text-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label w-100" for="edit_reward_amount_{!! $scheme->id !!}">Reward Amount *</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text">PKR</span>
                                                            <input type="number" 
                                                                   name="reward_amount" 
                                                                   id="edit_reward_amount_{!! $scheme->id !!}" 
                                                                   class="form-control @error('reward_amount') is-invalid @enderror" 
                                                                   placeholder="0.00" 
                                                                   step="0.01" 
                                                                   min="0"
                                                                   value="{!! old('reward_amount', $scheme->reward_amount) !!}" 
                                                                   required />
                                                        </div>
                                                        @error('reward_amount')
                                                            <div class="text-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label w-100" for="edit_is_active_{!! $scheme->id !!}">Status *</label>
                                                        <select class="form-select @error('is_active') is-invalid @enderror" 
                                                                name="is_active" 
                                                                id="edit_is_active_{!! $scheme->id !!}" 
                                                                required>
                                                            <option value="1" {!! $scheme->is_active ? 'selected' : '' !!}>Active</option>
                                                            <option value="0" {!! !$scheme->is_active ? 'selected' : '' !!}>Inactive</option>
                                                        </select>
                                                        @error('is_active')
                                                            <div class="text-danger mt-1">{{ $message }}</div>
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

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{!! session('success') !!}',
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            });
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{!! session('error') !!}',
                customClass: {
                    confirmButton: 'btn btn-danger'
                }
            });
        });
    </script>
@endif

@endsection
