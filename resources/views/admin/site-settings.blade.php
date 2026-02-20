@extends('admin.layouts.app')
@section('title', 'Site Settings')

@section('css')
<style>
    #cke_notifications_area_basic-default-message {
        display: none !important;
    }
    .cke_notification_warning {
        display: none !important;
    }
</style>
@endsection

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
                            <h5 class="mb-0">Site Settings</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.site-settings.update', $records->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Site Title *</label>
                                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Site Title" name="site_title" maxlength="190" value="{{ old('site_title', $records->site_title) }}" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Contact Email *</label>
                                    <input type="text" class="form-control" id="basic-default-company" placeholder="Contact Email" name="contact_email" maxlength="190" value="{{ old('contact_email', $records->contact_email) }}" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-facebook">FaceBook URL</label>
                                    <input
                                        type="url"
                                        id="basic-default-facebook"
                                        class="form-control phone-mask"
                                        placeholder="FaceBook URL"
                                        name="facebook" maxlength="190" value="{{ old('facebook', $records->facebook) }}" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-youtube">Youtube URL</label>
                                    <input
                                        type="url"
                                        id="basic-default-youtube"
                                        class="form-control phone-mask"
                                        placeholder="Youtube URL"
                                        name="youtube" maxlength="190" value="{{ old('youtube', $records->youtube) }}" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-linkedin">Linkedin URL</label>
                                    <input
                                        type="url"
                                        id="basic-default-linkedin"
                                        class="form-control phone-mask"
                                        placeholder="Linkedin URL"
                                        name="linkedin" maxlength="190" value="{{ old('linkedin', $records->linkedin) }}" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-pinterest">Pinterest URL</label>
                                    <input
                                        type="url"
                                        id="basic-default-pinterest"
                                        class="form-control phone-mask"
                                        placeholder="Pinterest URL"
                                        name="pinterest" maxlength="190" value="{{ old('pinterest', $records->pinterest) }}" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-logo">Logo</label>
                                    <input type="hidden" name="previous_logo" value="{{ $records->logo }}" />
                                    <input type="file" name="logo" class="form-control">
                                    @if ($records->logo != '' && file_exists(uploadsDir('front') . $records->logo))
                                        <div class="avatar mr-1 avatar-xl">
                                            <img src="{!! asset(uploadsDir('front'). $records->logo) !!}" alt="" title="Logo" class="img-responsive" />
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-favicon">Favicon Logo</label>
                                    <input type="hidden" name="previous_favicon" value="{{ $records->favicon }}" />
                                    <input type="file" name="favicon" class="form-control">
                                    @if ($records->favicon != '' && file_exists(uploadsDir('front') . $records->favicon))
                                        <div class="avatar mr-1 avatar-xl">
                                            <img src="{!! asset(uploadsDir('front'). $records->favicon) !!}" alt="" title="Logo" class="img-responsive" />
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="selectpickerBasic" class="form-label">Show banner on website</label>
                                    <select id="selectpickerBasic" name="is_show_banner" class="selectpicker w-100" data-style="btn-default">
                                        <option value="1" {{ matchSelected(old('is_show_banner', $records->is_show_banner), '1') }}>Yes</option>
                                        <option value="0" {{ matchSelected(old('is_show_banner', $records->is_show_banner), '0') }}>No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-home_banner">Home Banner</label>
                                    <input type="hidden" name="previous_home_banner" value="{{ $records->home_banner }}" />
                                    <input type="file" name="home_banner" class="form-control">
                                    @if ($records->home_banner != '' && file_exists(uploadsDir('front') . $records->home_banner))
                                        <div class="mr-1">
                                            <img width="200px" src="{!! asset(uploadsDir('front'). $records->home_banner) !!}" alt="" title="Logo" class="img-responsive" />
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-footer_sentence">Footer Sentence *</label>
                                    <textarea
                                        id="basic-default-footer_sentence"
                                        class="form-control"
                                        name="footer_sentence" maxlength="65000" rows="5" required placeholder="Footer Sentence">{{ old('footer_sentence', $records->footer_sentence) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-copyright">Copyright Line *</label>
                                    <textarea
                                        id="basic-default-copyright"
                                        class="form-control"
                                        name="copyright" maxlength="65000" rows="5" required placeholder="Copyright Line">{{ old('copyright', $records->copyright) }}</textarea>
                                </div>
                                {{-- <!-- google adsence scripts -->
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-top_google_script">Top Google Adsense Script</label>
                                    <textarea
                                        id="basic-default-top_google_script"
                                        class="form-control"
                                        placeholder="Top Google Adsense Script"
                                        name="top_google_script" maxlength="65000" rows="5">{{ old('top_google_script', $records->top_google_script) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-mid_google_script">Mid Google Adsense Script</label>
                                    <textarea
                                        id="basic-default-mid_google_script"
                                        class="form-control"
                                        placeholder="Mid Google Adsense Script"
                                        name="mid_google_script" maxlength="65000" rows="5">{{ old('mid_google_script', $records->mid_google_script) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-bottom_google_script">Bottom Google Adsense Script</label>
                                    <textarea
                                        id="basic-default-bottom_google_script"
                                        class="form-control"
                                        placeholder="Bottom Google Adsense Script"
                                        name="bottom_google_script" maxlength="65000" rows="5">{{ old('bottom_google_script', $records->bottom_google_script) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-responsive_top_google_script">Top Google Adsense Script (Responsive)</label>
                                    <textarea
                                        id="basic-default-responsive_top_google_script"
                                        class="form-control"
                                        placeholder="Top Google Adsense Script (Responsive)"
                                        name="responsive_top_google_script" maxlength="65000" rows="5">{{ old('responsive_top_google_script', $records->responsive_top_google_script) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-responsive_mid_google_script">Mid Google Adsense Script (Responsive)</label>
                                    <textarea
                                        id="basic-default-responsive_mid_google_script"
                                        class="form-control"
                                        placeholder="Mid Google Adsense Script (Responsive)"
                                        name="responsive_mid_google_script" maxlength="65000" rows="5">{{ old('responsive_mid_google_script', $records->responsive_mid_google_script) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-responsive_bottom_google_script">Bottom Google Adsense Script (Responsive)</label>
                                    <textarea
                                        id="basic-default-responsive_bottom_google_script"
                                        class="form-control"
                                        placeholder="Bottom Google Adsense Script (Responsive)"
                                        name="responsive_bottom_google_script" maxlength="65000" rows="5">{{ old('responsive_bottom_google_script', $records->responsive_bottom_google_script) }}</textarea>
                                </div> --}}
                                <!-- end google adsence scripts -->
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-header_script">Header Script</label>
                                    <textarea
                                        id="basic-default-header_script"
                                        class="form-control"
                                        placeholder="Header Script"
                                        name="header_script" maxlength="65000" rows="5">{{ old('header_script', $records->header_script) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-body_script">Body Script</label>
                                    <textarea
                                        id="basic-default-body_script"
                                        class="form-control"
                                        placeholder="Body Script"
                                        name="body_script" maxlength="65000" rows="5">{{ old('body_script', $records->body_script) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-privacy_policy">Privacy Policy</label>
                                    <textarea
                                        id="basic-default-privacy_policy"
                                        class="form-control summernote"
                                        data-placeholder="Privacy Policy"
                                        name="privacy_policy" maxlength="65000" rows="5" required>{!! old('privacy_policy', $records->privacy_policy) !!}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-term_condition">Term Condition</label>
                                    <textarea
                                        id="basic-default-term_condition"
                                        class="form-control summernote"
                                        data-placeholder="Term Condition"
                                        name="term_condition" maxlength="65000" rows="5" required>{!! old('term_condition', $records->term_condition) !!}</textarea>
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

@section('footer-js')
<!-- include summernote css/js -->
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $(".summernote").each(function() {
            $(this).summernote({
                placeholder: $(this).data('placeholder'),
                height: 200
            });
        });
    });
</script> -->

<!-- CKEDITOR -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    $(document).ready(function() {
        // Loop through all elements with the class 'summernote'
        $('.summernote').each(function() {
            // Get the current element
            var $this = $(this);
            
            // Initialize CKEditor for each element
            CKEDITOR.replace($this[0], {
                // Set the placeholder dynamically using the data-placeholder attribute
                placeholder: $this.data('placeholder') || 'Type here...'
            });
        });
    });
</script>

@endsection
