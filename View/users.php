<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Utilisateurs</h3>
      </div>
      <hr>
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
        echo '</tr>';
    }
?>
</table>
</div>
</div>
</div>
</div>
</div>
