<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

<script src="{{asset('assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    /**
   * UI Toasts
   */

  'use strict';

  (function () {
    // Bootstrap toasts example
    // --------------------------------------------------------------------
    const toastPlacementExample = document.querySelector('.toast-placement-ex'),
      toastPlacementBtn = document.querySelector('#showToastPlacement');
    let selectedType, selectedPlacement, toastPlacement;

    // Dispose toast when open another
    function toastDispose(toast) {
      if (toast && toast._element !== null) {
        if (toastPlacementExample) {
          toastPlacementExample.classList.remove(selectedType);
          DOMTokenList.prototype.remove.apply(toastPlacementExample.classList, selectedPlacement);
        }
        toast.dispose();
      }
    }
    // Placement Button click
    if (toastPlacementBtn) {
      toastPlacementBtn.onclick = function () {
        if (toastPlacement) {
          toastDispose(toastPlacement);
        }
        selectedType = "bg-primary";
        selectedPlacement = ["top-0", "start-0"];

        toastPlacementExample.classList.add(selectedType);
        DOMTokenList.prototype.add.apply(toastPlacementExample.classList, selectedPlacement);
        toastPlacement = new bootstrap.Toast(toastPlacementExample);
        toastPlacement.show();
      };
    }
  })();
</script>

<script>
  function convertTextToPrice(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  function convertPriceToText(number) {
      return number.split(".").join("");
  }

  firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      $("#admin_name_login").html(user.email);
    } else {
      window.location.href="{{route('admin-pages-login')}}"
    }
  });
  
  $("#logout").click(() => {
    firebase.auth().signOut();
  })

  var resultsRef = firebase.database().ref('results');
  resultsRef.on('child_added', (snapshot) => {
    const data = snapshot.val();

    $("#notif_from").html(data["created_by"] ?? "");
    $("#notif_body").html(`New data with type : ${data["type"] ?? ""}`);
    $("#showToastPlacement").trigger( "click" );
  });
</script>