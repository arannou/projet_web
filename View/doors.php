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
            Liste des portes
          </div>
<table class="table">
    <thead>
        <th>id</th>
        <th>Salle</th>
    </thead>
<?php
    foreach ($controller->doors as $id=>$door) {
        echo '<tr>';
            echo '<td>'.$door->getId().'</td>';
            echo '<td>'.$door->getRoomId().'</td>';
        echo '</tr>';
    }
?>
</table>
</div>
</div>
</div>
</div>
</div>
