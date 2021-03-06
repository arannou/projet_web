<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Clés</h3>
      </div>
      <hr>
      <!-- Liste des clés -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Liste des clés
          </div>
          <table class="table">
            <thead>
              <th>Identifiant</th>
              <th>type</th>
              <th>LockId</th>
              <th>Door</th>
            </thead>
            <?php
            foreach ($controller->keys as $index => $key) {
              echo '<tr>';
              echo '<td>'.$key->getId().'</td>';
              echo '<td>'.$key->getType().'</td>';
              echo '<td>'.$key->getLockId().'</td>';
              //Afficher ID de la porte + salle associée à la clé
              echo '<td>';
              if($controller->doors[$index] != null)
                echo $controller->doors[$index]->getRoomId();
              echo '</td>';
              echo '</tr>';
            }
            ?>
          </table>
        </div>
        <!-- Formulaire d'ajout de clé -->
        <div class="x_panel">
          <div class="x_title">
            Ajout d'une clé
          </div>
          <div class="form-group">
            <form action="?/addKeysForm" method="post" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Id de la clé :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="keyId" placeholder="Id, ex : 1">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type de la clé :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="keyType" class="form-control">
                    <?php
                    $keyType = KeyVO::$keyType;
                    foreach ($keyType as $key => $value) {
                      echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Id du lock :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="lockId" class="form-control">
                    <?php
                    //Récupération des canons
                    foreach ($controller->locks as $key => $lock) {
                      echo '<option value="'.$lock->getId().'">'.$lock->getId().'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="submit" value="Ajouter" class="btn btn-warning" >
              </div>
            </form>
          </div>
        </div>
        <!-- Formulaire d'ajout de clé à l'aide d'un CSV -->
        <div class="x_panel">
          <div class="x_title">
            Ajout de clés par CSV
          </div>
          <div class="form-group">
            <form action="?/uploadKeyCSV" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fichier CSV :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" name="keyCSV">
                </div>
              </div>
              <br>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="submit" value="Envoyer" class="btn btn-warning" >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
