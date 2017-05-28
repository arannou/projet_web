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
            </thead>
            <?php
            foreach ($controller->rooms as $room) {
              echo '<tr>';
              echo '<td>'.$room->getId().'</td>';
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
      </div>
    </div>
  </div>
</div>
