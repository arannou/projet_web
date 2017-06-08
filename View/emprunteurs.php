<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Accueil</h3>
      </div>
      <hr>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Liste des emprunts
          </div>
          <table class="table">
            <thead>
              <th>borrowingId</th>
              <th>userEnssatPrimaryKey</th>
              <th>keychainId</th>
              <th>borrowDate</th>
              <th>dueDate</th>
              <th>returnDate</th>
              <th>lostDate</th>
              <th>comment</th>
              <th>status</th>

              <th>nom emprunteurs </th>
            </thead>
            <tbody>


              <?php
              foreach ($controller->borrowings as $borrowing) {
                echo '<tr>';
                echo '<td>'.$borrowing['borrowingId'].'</td>';
                echo '<td>'.$borrowing['userEnssatPrimaryKey'].'</td>';
                echo '<td>'.$borrowing['keychainId'].'</td>';
                echo '<td>'.$borrowing['borrowDate']->getTimestamp().'</td>';
                echo '<td>'.$borrowing['dueDate']->getTimestamp().'</td>';
                echo '<td>'.$borrowing['returnDate'].'</td>';
                echo '<td>'.$borrowing['lostDate'].'</td>';
                echo '<td>'.$borrowing['comment'].'</td>';
                echo '<td>'.$borrowing['status'].'</td>';
                echo '<tr>';
              }



foreach ($controller->users as $user) {
          foreach ($controller->borrowings as $borrowing) {
  if ( $user->getEnssatPrimaryKey() == $borrowing['userEnssatPrimaryKey']) {
    echo '<td>'.$user->getUsername().'</td>';

  }
}
}
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
