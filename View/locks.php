<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Canons</h3>
      </div>
      <hr>
      <!-- Formulaire d'ajout de canon -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Créer un canon
          </div>
          <div class="x_content">
            <form action="?/locksForm" method="post" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fournisseur:</label>
                <select name = "providerCanon">
                  <?php
                  //Récupération des fournisseurs
                  foreach($controller->providers as $provider){
                    echo '<option value = "'.$provider->getId().'">'.$provider->getName()." ".$provider->getSurname().'</option>';
                  } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Longueur canon :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name = "lengthCanon">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Id de la porte :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name = "doorId">
                </div>
              </div>
              <p><input type="submit" value="Envoyer" class="btn btn-warning" /></p>
            </form>
          </div>
        </div>
        <!-- Liste des canons -->
        <div class="x_panel">
          <div class="x_title">
            Liste des canons
          </div>
          <table class="table">
            <thead>
              <th>Id</th>
              <th>Length</th>
              <th>Provider</th>
              <th>DoorId</th>
              <th>Suppression</th>
            </thead>
            <?php
            foreach ($controller->locks as $lock) {
              echo '<tr>';
              echo '<td>'.$lock->getId().'</td>';
              echo '<td>'.$lock->getLength().'</td>';
              echo '<td>'.$lock->getProvider().'</td>';
              echo '<td>'.$lock->getDoorId().'</td>';
              ?>
              <!-- Ajout d'un bouton suppression pour supprimer un canon -->
              <form action="?/locksSuppr" method="post" data-parsley-validate class="form-horizontal form-label-left"><?php
              echo '<td><input type="hidden" name="idCanon" value="'.$lock->getId().'"><input type="submit" value="Supprimer" class="btn btn-warning" /></td>';
              ?></form><?php
              echo '</tr>';
            }
            ?>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
