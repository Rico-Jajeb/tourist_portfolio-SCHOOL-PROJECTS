<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

 <script src="<?php echo base_url('assets/custom.js') ?>"></script>
 <script src="<?php echo base_url('assets/custom_css_js/custom.js') ?>"></script>

   <!-- Github buttons -->
   <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url('assets/assets/js/soft-ui-dashboard.min.js?v=1.0.7')?>"></script>

</body>
</html>