@extends('admin.layouts.app')

@section('title', 'Users')
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
                    <h5 class="mb-0">Users</h5>
                </div>
                <div class="card-datatable text-nowrap">
                  <table class="dt-scrollableTable table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        @if(auth()->user()->is_system_admin == 1)
                        <th>Actions</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{!! ucfirst($user->name) !!}</td>
                                <td>{!! $user->email !!}</td>

                                @if(auth()->user()->is_system_admin == 1)
                                <td>
                                    <div class="d-inline-block">
                                        <form action="{!! URL::route('admin.users.destroy', $user->id) !!}" method="POST" id="deleteForm{!! $user->id !!}">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- More Actions -->
                                        <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            <button type="button" onclick="deleteConfirmation({!! $user->id !!})" class="dropdown-item text-danger delete-record">Delete</button>
                                        </div>
                                    </div>
                                </td>
                                @endif
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
