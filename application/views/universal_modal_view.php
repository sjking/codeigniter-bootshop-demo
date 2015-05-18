<div class="modal fade" id="universalModal" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" id="universalModalForm">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div class="alert alert-danger fade in" id="universalModal-alert" style="display: none;">
          <span class="alert-body"></span>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <input type="hidden" id='recordId' name='recordId' value="<?= isset($universalModalHiddenValue) && $universalModalHiddenValue ? $universalModalHiddenValue : '' ?>">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id='submitButton'>OK</button>
        </div>
      </form>
    </div>
  </div>
</div>