<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Salles</h3>
      </div>
      <hr>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Liste des salles
          </div>
          <table class="table">
            <thead>
              <th>nom</th>
              <th>Lock</th>
              <th>Key</th>
              <th>Users</th>
            </thead>
            <?php
            foreach ($controller->rooms as $index => $room) {
              echo '<tr>';
              echo '<td>'.$room->getId().'</td>';
              if ($controller->locks[$index] != null) {
                echo '<td>'.$controller->locks[$index]->getId().'</td>';
              } else {
                echo '<td></td>';
              }
              if ($controller->keys[$index] != null) {
                echo '<td>'.$controller->keys[$index]->getId().'</td>';
              } else {
                echo '<td></td>';
              }
              echo '<td><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#room'.$room->getId().'""><i class="fa fa-key"></i></button></td>';

              echo '</tr>';
            }
            ?>
          </table>
        </div>
        <div class="x_panel">
          <div class="x_title">
            Ajout d'une salle
          </div>
          <div class="form-group">
            <form action="?/rooms" method="post" data-parsley-validate class="form-horizontal form-label-left">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nom de la salle :</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="roomName" placeholder="Numéro complet, exemple : 001H">
              </div>
              <input type="submit" value="Ajouter" class="btn btn-warning" >
            </form>
          </div>
        </div>
        <div class="x_panel">
          <div class="x_title">
            Ajout de salles par CSV
          </div>
          <div class="form-group">
            <form action="?/uploadRoomCSV" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fichier CSV :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" name="roomCSV">
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
foreach ($controller->rooms as $room) {
  echo '<div class="modal fade" id="room'.$room->getId().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">'.$room->getId().'</h4>
      </div>
      <div class="modal-body">
        <strong>Utilisateurs ayant accédés à la salle :</strong>
        <br>
        ';

          echo "<em>Personne n'a eu accès à cette salle.</em>";

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
$(document).ready(function(){
  $('.modalRoom').on('shown.bs.modal', function () {
    $('#myInput').focus();
  });
});
</script>
