<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Providers</h3>
      </div>
      <hr>
      <!-- Liste des fournisseurs -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Liste des fournisseurs
          </div>
          <table class="table">
              <thead>
                  <th>Identifiant</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Surname</th>
                  <th>Phone</th>
                  <th>Office</th>
                  <th>Email</th>
              </thead>
          <?php
              foreach ($controller->providers as $provider) {
                  echo '<tr>';
                      echo '<td>'.$provider->getId().'</td>';
                      echo '<td>'.$provider->getUsername().'</td>';
                      echo '<td>'.$provider->getName().'</td>';
                      echo '<td>'.$provider->getSurname().'</td>';
                      echo '<td>'.$provider->getPhone().'</td>';
                      echo '<td>'.$provider->getOffice().'</td>';
                      echo '<td>'.$provider->getEmail().'</td>';
                  echo '</tr>';
              }

          ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
