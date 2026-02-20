@extends('admin.layouts.app')

@section('title', 'Administrators')
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
                    <h5 class="mb-0">Administrators</h5>
                    <small class="text-muted float-end"><a href="{{ route('admin.administrators.create') }}" class="btn btn-primary">Create</a></small>
                </div>
                <div class="card-datatable text-nowrap">
                  <table class="dt-scrollableTable table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $admin)
                            <tr>
                                <td>{!! $admin->first_name !!} {!! $admin->last_name !!}</td>
                                <td>{!! $admin->phone !!}</td>
                                <td>{!! $admin->email !!}</td>
                                <td>
                                    @if ($admin->is_active > 0)
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                    <span class="badge bg-label-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-inline-block">
                                        <form action="{!! URL::route('admin.administrators.destroy', $admin->id) !!}" method="POST" id="deleteForm{!! $admin->id !!}">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- More Actions -->
                                        <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            <a href="{!! route('admin.administrators.show', $admin->id) !!}" class="dropdown-item">Details</a>

                                            @if(auth()->user()->is_system_admin != 1)
                                                <button type="button" class="dropdown-item text-danger delete-record disabled">Delete</button>
                                            @elseif (auth()->user()->is_system_admin == 1 && auth()->id() != $admin->id)
                                                <button type="button" onclick="deleteConfirmation({!! $admin->id !!})" class="dropdown-item text-danger delete-record">Delete</button>
                                            @endif
                                        </div>

                                        <!-- Edit -->
                                        @if(auth()->user()->is_system_admin == 1 || auth()->user()->id == $admin->id)
                                            <a href="{!! route('admin.administrators.edit', $admin->id) !!}" class="item-edit text-body"><i class="text-primary ti ti-pencil"></i></a>
                                        @else
                                            <a href="{!! route('admin.administrators.edit', $admin->id) !!}" class="item-edit text-body  disabled"><i class="text-primary ti ti-pencil"></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
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

@endsection
