<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Portes</h3>
      </div>
      <hr>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Ajouter une porte
          </div>
          <div class="x_content">
            <form action="?/createDoor" method="post" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Salle:</label>
                <select name = "room">
                  <?php
                  foreach($controller->rooms as $room){ ?>
                    <option value = "<?php echo $room->getId(); ?>"><?php echo $room->getId(); ?>	</option>
                  <?php  } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ID canon :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name = "lock">
                  <!-- @todo : pas traité en back end -->
                </div>
              </div>
              <p><input type="submit" value="Envoyer" class="btn btn-warning" /></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
