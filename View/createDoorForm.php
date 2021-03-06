<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Portes</h3>
      </div>
      <hr>
      <!-- Formulaire d'ajout de porte -->
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
                  //Récupération de l'identifiant des salles
                  foreach($controller->rooms as $room){ ?>
                    <option value = "<?php echo $room->getId(); ?>"><?php echo $room->getId(); ?>	</option>
                  <?php  } ?>
                </select>
              </div>
              <p><input type="submit" value="Envoyer" class="btn btn-warning" /></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
