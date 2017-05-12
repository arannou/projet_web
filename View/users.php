<h1><?php echo $controller->getPageName(); ?></h1>
<hr>
<table>
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
<table>
