<!-- Sticky Footer -->
<div id="stickyFooter" class="border-top position-fixed bottom-0 shadow-sm d-flex justify-content-center align-items-center p-0 m-0 d-md-none" style="background: white; height: 50px; width: 100%; z-index: 9999;">
  
  <!-- Advertisement Label (Left Top) -->
  <span class="position-absolute text-light p-1 advertisement_text"
      style="top: -20px; left: 0px; font-size: 8px; border-radius: 0px 0px 0px 0px; 
      background: #4958EF !important; padding-right: 8px !important;">
      Advertisement
  </span>

  <!-- Close Button (Right Top) -->
  {{-- <span id="closeFooter" class="position-absolute bg-dark text-light d-flex align-items-center justify-content-center" style="top: -25px; right: 0px; width: 24px; height: 24px; border-radius: 50%; cursor: pointer;">
      &times;
  </span> --}}

  <!-- AdSense Ad Container -->
  <div class="position-relative ad-container" id="adContainer" style="width: 100%; max-width: 700px; height: 100%; padding: 0; margin: 0; display: flex; justify-content: center; align-items: center;">
      <!-- AdSense Ad Code for Mobile -->
      <ins id="mobileAd"
           style="display:none;width:300px;height:50px;"
           data-ad-client="ca-pub-2933454440337038"
           data-ad-slot="6493556933"></ins>

      <!-- AdSense Ad Code for Desktop -->
      <ins id="desktopAd"
           style="display:none;width:728px;height:90px;"
           data-ad-client="ca-pub-2933454440337038"
           data-ad-slot="6702463586"></ins>
  </div>
</div>

<script>
  function adjustAdVisibility() {
      const adContainer = document.getElementById('adContainer');
      const isMobile = window.innerWidth <= 768;

      // Clear existing ads
      adContainer.innerHTML = '';

      // Create and append the appropriate ad based on viewport size
      const ad = document.createElement('ins');
      ad.className = 'adsbygoogle';
      ad.setAttribute('data-ad-client', 'ca-pub-2933454440337038');

      if (isMobile) {
          ad.setAttribute('data-ad-slot', '6493556933');
          ad.style.width = '300px';
          ad.style.height = '50px';
          // $('#stickyFooter').css('height', '50px');
          // $("body").css("padding-bottom", "50px");  // Adjust body padding for mobile
      } else {
          ad.setAttribute('data-ad-slot', '6702463586');
          ad.style.width = '728px';
          ad.style.height = '90px';
          // $("body").css("padding-bottom", "90px");  // Adjust body padding for desktop
      }

      ad.style.display = 'inline-block';
      adContainer.appendChild(ad);

      // Load the ad
      (adsbygoogle = window.adsbygoogle || []).push({});
  }

  // Run on initial page load
  adjustAdVisibility();

  // Run on window resize
  window.addEventListener('resize', adjustAdVisibility);
</script>

<script>
  $(document).ready(function() {
      $('#closeFooter').click(function() {
          setTimeout(function() {
              // Reset body padding and hide the sticky footer
              $("body").attr('style', 'padding-bottom: 0px !important;');
              $('#stickyFooter').slideUp('slow', function() {
                  $(this).attr('style', 'display: none !important;');
              });
          }, 1000);
      });
  });
</script>


{{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
.sticky-ad-container {
  position: fixed;
  bottom: 0;
  width: 100%;
  background: rgba(0, 0, 0, 0.05);
  box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.2);
  z-index: 1050;
  padding: 10px 0;
  text-align: center;
}

.close-btn {
  position: absolute;
  right: 15px;
  top: 00px;
  font-size: 16px;
  color: #6c757d;
  background: black
  cursor: pointer;
}
</style>

<div class="sticky-ad-container">
  <div class="container position-relative">

    <div class="text-muted mb-1">Advertisement</div>

    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-2933454440337038"
         data-ad-slot="3508854456"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    <span class="close-btn" onclick="closeAd()">×</span>
  </div>
</div>

<script>

  function closeAd() {
    document.querySelector(".sticky-ad-container").style.display = "none";
  }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}