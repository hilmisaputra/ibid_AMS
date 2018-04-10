<!-- <script src="<?php echo base_url('assets/js/menu.js')?>"></script> -->
<script>
  $('a#logout').click(function(){
    $('#dash-modal-title').text('Konfirmasi Logout');
    $('#dash-modal-body').text('Apakah anda yakin ingin keluar ?');
    $('#dash-modal').modal('show');
  });
  var date = new Date();
  var year = date.getFullYear();
  $('.site-footer').find('p').prepend('Copyright © '+year);
</script>