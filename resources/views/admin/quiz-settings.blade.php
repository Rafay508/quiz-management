@extends('admin.layouts.app')
@section('title', 'Quiz Settings')

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
                            <h5 class="mb-0">Quiz Settings</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.quiz-settings.update', $records->id) }}" class="number-tab-steps wizard-circle">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label" for="max_attempts_allowed">Maximum Attempts Allowed *</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-repeat"></i></span>
                                        <input
                                            type="number"
                                            class="form-control @error('max_attempts_allowed') is-invalid @enderror"
                                            id="max_attempts_allowed"
                                            name="max_attempts_allowed"
                                            value="{{ old('max_attempts_allowed', $records->max_attempts_allowed ?? 1) }}"
                                            min="1"
                                            required />
                                    </div>
                                    @error('max_attempts_allowed')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Minimum value is 1</small>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input
                                            class="form-check-input @error('shuffle_questions') is-invalid @enderror"
                                            type="checkbox"
                                            id="shuffle_questions"
                                            name="shuffle_questions"
                                            value="1"
                                            {{ old('shuffle_questions', $records->shuffle_questions ?? false) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="shuffle_questions">
                                            Shuffle Questions
                                        </label>
                                    </div>
                                    @error('shuffle_questions')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input
                                            class="form-check-input @error('shuffle_options') is-invalid @enderror"
                                            type="checkbox"
                                            id="shuffle_options"
                                            name="shuffle_options"
                                            value="1"
                                            {{ old('shuffle_options', $records->shuffle_options ?? false) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="shuffle_options">
                                            Shuffle Options
                                        </label>
                                    </div>
                                    @error('shuffle_options')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input
                                            class="form-check-input @error('show_result_immediately') is-invalid @enderror"
                                            type="checkbox"
                                            id="show_result_immediately"
                                            name="show_result_immediately"
                                            value="1"
                                            {{ old('show_result_immediately', $records->show_result_immediately ?? false) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="show_result_immediately">
                                            Show Result Immediately
                                        </label>
                                    </div>
                                    @error('show_result_immediately')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Save Changes</button>
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
