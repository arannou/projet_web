<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Clés</h3>
      </div>
      <hr>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Liste des clés
          </div>
<table class="table">
    <thead>
        <th>Identifiant</th>
        <th>type</th>

    </thead>
<?php
    foreach ($controller->keys as $key) {
        echo '<tr>';
            echo '<td>'.$key->getId().'</td>';
            echo '<td>'.$key->getType().'</td>';

        echo '</tr>';
    }
?>
</table>
</div>
</div>
</div>
</div>
</div>
