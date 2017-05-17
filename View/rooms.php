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
</div>
</div>
</div>
</div>
