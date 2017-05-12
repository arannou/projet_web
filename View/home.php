<h1><?php echo $controller->getPageName(); ?></h1>
<a href="?/users">Users</a>
<hr>
<ul>
    <?php
    foreach ($controller->keychains as $keychain) {
        echo '<li>'.$keychain->getCreationDate()->getTimestamp().'</li>';
    }

    ?>
</ul>
<table>
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
    ?>
</tbody>
</table>
