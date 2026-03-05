<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
        <div
            class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
            <div>
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                 <a href="javascript:void(0)" target="_blank" class="fw-medium">{{ ucfirst($siteSettings->site_title) ?? 'QuizMaster' }}</a> | {!! $siteSettings->copyright !!}
            </div>
        </div>
    </div>
</footer>
<!-- / Footer -->
