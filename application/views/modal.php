<div class="modal fade" id="dash-modal" role="dialog">
  <div class="modal-dialog modal-md">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="dash-modal-title"></h3>
      </div>
      <div class="modal-body" id="dash-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <a id="submit-logout" class="btn btn-success" href="<?php echo $this->config->item('ibid_auth').'/logout';?>">Ya</a>
      </div>
    </div>
    
  </div>
</div>
