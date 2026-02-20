@extends('admin.layouts.app')

@section('title', 'Meta Details')
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
                    <h5 class="mb-0">Meta Details</h5>
                </div>
                <div class="card-datatable text-nowrap">
                  <table class="dt-scrollableTable table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Meta Title</th>
                        <th>Meta keywords</th>
                        {{-- <th>Meta Description</th> --}}
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (@$data as $key => $record)
                            <tr>
                                <td>{!! ucfirst($record->name) !!}</td>
                                <td>{!! ucfirst(Str::limit($record->meta_title, '50', '...')) !!}</td>
                                <td>{!! ucfirst(Str::limit($record->meta_keywords, '50', '...')) !!}</td>
                                {{-- <td>{!! ucfirst(Str::limit($record->meta_description, '50', '...')) !!}</td> --}}
                                <td>
                                    <div class="d-inline-block">
                                        <!-- Edit -->
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#edit_{!! $record->id !!}"><i class="ti ti-pencil"></i></a>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit_{!! $record->id !!}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                                <div class="modal-content p-3 p-md-5">
                                                    <div class="modal-body">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        <div class="text-center mb-4">
                                                            <h3 class="mb-2">Edit Filter</h3>
                                                        </div>

                                                        <form class="row g-3" action="{!! route('admin.meta-details.update', $record->id) !!}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-12">
                                                                <label class="form-label w-100" for="modalAddCard">Name *</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" name="name" class="form-control" type="text" placeholder="Name" value="{!! old('name', $record->name) !!}" disabled readonly />
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label w-100" for="modalAddCard">Meta Title</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" name="meta_title" class="form-control" type="text" placeholder="Meta Title" value="{!! old('meta_title', $record->meta_title) !!}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label w-100" for="modalAddCard">H1</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" name="h1" class="form-control" type="text" placeholder="H1" value="{!! old('h1', $record->h1) !!}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label" for="currencyAbbreviation">Meta Keywords</label>
                                                                <textarea class="form-control" name="meta_keywords" placeholder="Meta Keywords">{{ old('meta_keywords', $record->meta_keywords) }}</textarea>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label" for="currencyAbbreviation">Meta Description</label>
                                                                <textarea class="form-control" name="meta_description" placeholder="Meta Description">{{ old('meta_description', $record->meta_description) }}</textarea>
                                                            </div>
                                                            <div class="col-12 text-center">
                                                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                                                                <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
