<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Utilisateurs</h3>
      </div>
      <hr>
      <!-- Listing des utilisateurs -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Liste des utilisateurs
          </div>
          <table class="table">
            <thead>
              <th>Username</th>
              <th>EnssatPrimaryKey</th>
              <th>Ur1Identifier</th>
              <th>Name</th>
              <th>Surname</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Email</th>
              <th>Keys</th>
            </thead>
            <?php
            foreach ($controller->users as $user) {
              echo '<tr>';
              echo '<td>'.$user->getUsername().'</td>';
              echo '<td>'.$user->getEnssatPrimaryKey().'</td>';
              echo '<td>'.$user->getUr1Identifier().'</td>';
              echo '<td>'.$user->getName().'</td>';
              echo '<td>'.$user->getSurname().'</td>';
              echo '<td>'.$user->getPhone().'</td>';
              echo '<td>'.$user->getStatus().'</td>';
              echo '<td>'.$user->getEmail().'</td>';
              echo '<td><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#user'.$user->getEnssatPrimaryKey().'""><i class="fa fa-key"></i></button></td>';
              echo '</tr>';
            }
            ?>
          </table>
        </div>
        <!-- Ajout d'utilisateurs à l'aide d'un CSV - Formulaire -->
        <div class="x_panel">
          <div class="x_title">
            Ajout d'utilisateurs par CSV
          </div>
          <div class="form-group">
            <form action="?/uploadUserCSV" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fichier CSV :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" name="userCSV">
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


<!-- Modal -->
<?php
//Récupération des utilisateurs
foreach ($controller->users as $user) {
  //On récupère les emprunts lié à l'utilisateur
  $borrowTab = $controller->borrowByUser[$user->getEnssatPrimaryKey()];
  echo '<div class="modal fade" id="user'.$user->getEnssatPrimaryKey().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">'.$user->getName().' '.$user->getSurname().'</h4>
      </div>
      <div class="modal-body">
        <strong>Trousseaux empruntés :</strong>
        <br>
        ';
        //On affiche les éventuels trousseaux empruntés
        if ($borrowTab != null) {
          foreach ($borrowTab as $key => $borrow) {
            echo $borrow['keychainId'].' ';
          }
        }
        else {
          echo "<em>Pas de trousseau emprunté.</em>";
        }
        echo '<br><strong>Accès :</strong><br>';
        //On cherche les salles auxquelles l'utilisateur a accès
        if ($borrowTab != null) {
          echo '<ul>';
          foreach ($borrowTab as $key => $borrow) {
            $keyTab = $controller->keysOfKeychains[$borrow['borrowingId']];
            foreach ($controller->doors[$key] as $index => $door) {
              if ($door != null) {
                echo '<li>'.$door->getRoomId().'</li>';
              }

            }
          }
          echo '</ul>';
        }
        else {
          echo "<em>Pas d'accès aux différentes salles.</em>";
        }
      echo '</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>';
}
?>

<script>
//Mise en place d'un écouteur sur le bouton
$(document).ready(function(){
  $('.modalUser').on('shown.bs.modal', function () {
    $('#myInput').focus();
  });
});
</script>
