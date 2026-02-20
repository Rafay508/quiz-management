@extends('admin.layouts.app')

@section('title', 'Edit Administrator')
@section('content')
<div class="layout-page">
    @include('admin.layouts.partials.navigation')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"> Edit Profile</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.administrators.update', $data->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">First Name *</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                            ><i class="ti ti-user"></i
                                            ></span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="basic-icon-default-fullname"
                                            name="first_name" value="{{ old('first_name', $data->first_name) }}"
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Last Name</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                            ><i class="ti ti-user"></i
                                            ></span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="basic-icon-default-fullname"
                                            name="last_name" value="{{ old('last_name', $data->last_name) }}"
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-phone">Contact Number</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="input-group-text"
                                            ><i class="ti ti-phone"></i
                                            ></span>
                                        <input
                                            type="text"
                                            id="basic-icon-default-phone"
                                            class="form-control phone-mask"
                                            name="phone" value="{{ old('phone', $data->phone) }}"
                                            aria-describedby="basic-icon-default-phone2" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-email">Email</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                        <input
                                            type="text"
                                            id="basic-icon-default-email"
                                            class="form-control"
                                            name="email" value="{{  $data->email }}"
                                            aria-describedby="basic-icon-default-email2" readonly />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-company">Profile Picture</label>
                                    <div class="input-group input-group-merge">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    @if ($data->image != '' && file_exists(uploadsDir('admin') . $data->image))
                                    <input type="hidden" name="previous_image" value="{!! $data->image !!}" class="form-control">
                                        <br>
                                        <img src="{!! asset(uploadsDir('admin') . $data->image) !!}" height="150" width="150" class="h-auto rounded-circle">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="selectpickerBasic" class="form-label">Status</label>
                                    <select id="selectpickerBasic" name="is_active" class="selectpicker w-100" data-style="btn-default" {!! auth()->id() == $data->id ? 'disabled' : '' !!}>
                                        <option value="1" {!! ($data->is_active = 1) ? 'selected' : '' !!}>Active</option>
                                        <option value="0" {!! ($data->is_active = 0) ? 'selected' : '' !!}>Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
    $( "#page_title" ).blur(function() {
        var value = $( this ).val();
        $('#slug').val(slugify(value));
    }).blur();

    function slugify(text)
    {
      return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
    }
</script>
@endsection