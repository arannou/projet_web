<form action="?/borrowKeychain" method="post">
  <p>
    <label>Identifiant:
    <select name = "userEnssatPrimaryKey">
      <?php var_dump($users);
      foreach($controller->users as $user){ ?>
        <option value = "<?php echo $user->getEnssatPrimaryKey(); ?>"><?php echo $user->getName()." ".$user->getSurname(); ?></option>
    <?php  } ?>
    </select>
  </p>

  <p>ID trousseau : <input type="text" name = "keychainId"></p>
  <p>Date d'emprunt : <input type = "date" name = "borrowDate"></p>
  <p>Date de retour : <input type = "date" name = "dueDate"></p>
  <p>Commentaire : <input type="text" placeholder="Commentaire" name = "comment" /></p>

  <p><input type="submit" value="Envoyer" /></p>
</form>
