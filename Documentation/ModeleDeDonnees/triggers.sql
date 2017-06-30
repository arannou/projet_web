DELIMITER //
DROP TRIGGER if exists test_user_exist_insert //
create trigger test_user_exist_insert Before insert on user
for each row
Begin
    if (new.email IN (select email from user) and new.name IN (select name from user) and new.username in (select username from user))  Then
      SIGNAL SQLSTATE '45000'
        SET message_TEXT = 'Utilisateur deja present dans la base'
              ,MYSQL_ERRNO = 2;
    end if;

    if (character_length(new.phone) < 9 ) Then
      SIGNAL SQLSTATE '45000'
      SET message_TEXT = 'Le numero de telephone saisi est incorrect : 10 chiffres minimum'
            ,MYSQL_ERRNO = 1;
  end if;
end; //

DELIMITER ;

DELIMITER //
DROP TRIGGER if exists test_user_exist_update //
create trigger test_user_exist_update Before UPDATE on user
for each row
Begin
  if (character_length(new.phone) < 9 ) Then
      SIGNAL SQLSTATE '45000'
      SET message_TEXT = 'Le numero de telephone saisi est incorrect : 10 chiffres minimum'
            ,MYSQL_ERRNO = 1;
  end if;
end; //

DELIMITER ;

DELIMITER //
DROP TRIGGER if exists check_borrow_date_insert //
create trigger check_borrow_date_insert BEFORE INSERT ON borrowing
for each row
BEGIN
  if(new.borrowDate > new.dueDate OR new.borrowDate > new.returnDate OR new.borrowDate > new.lostDate) Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "La date d'emprunt ne peut pas être supérieure à la date de retour ou de perte"
    ,MYSQL_ERRNO = 3;
  end if;
end; //

DELIMITER ;

DELIMITER //
DROP TRIGGER if exists check_borrow_date_update //
CREATE TRIGGER check_borrow_date_update BEFORE UPDATE ON borrowing
for each row
BEGIN
  if(new.borrowDate > new.dueDate OR new.borrowDate > new.returnDate OR new.borrowDate > new.lostDate) Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "La date d'emprunt ne peut pas être supérieure à la date de retour ou de perte"
    ,MYSQL_ERRNO = 3;
  end if;
end; //

DELIMITER ;

DELIMITER //
DROP TRIGGER IF EXISTS check_key_type_insert //
CREATE TRIGGER check_key_type_insert BEFORE INSERT ON enssat_key
for each row
BEGIN
  if(new.type != 'Simple' AND new.type != 'Partiel' AND new.type != 'Total') Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "Le type de clé ne doit pas être autre que : Simple, Partiel ou Total"
    ,MYSQL_ERRNO = 4;
  end if;
end; //

DELIMITER ;

DELIMITER //
DROP TRIGGER IF EXISTS check_key_type_update //
CREATE TRIGGER check_key_type_update BEFORE UPDATE ON enssat_key
for each row
BEGIN
  if(new.type != 'Simple' AND new.type != 'Partiel' AND new.type != 'Total') Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "Le type de clé ne doit pas être autre que : Simple, Partiel ou Total"
    ,MYSQL_ERRNO = 4;
  end if;
end;
//

DELIMITER ;

DELIMITER //
DROP TRIGGER IF EXISTS check_keychain_dates_insert //
CREATE TRIGGER check_keychain_dates_insert BEFORE INSERT ON keychain
for each row
BEGIN
  if(new.destructionDate < new.creationDate) Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "La date de destruction ne peut pas être inférieure à la date de création"
    ,MYSQL_ERRNO = 5;
  end if;
end;
//

DELIMITER ;

DELIMITER //
DROP TRIGGER IF EXISTS check_keychain_dates_update //
CREATE TRIGGER check_keychain_dates_update BEFORE UPDATE ON keychain
for each row
BEGIN
  if(new.destructionDate < new.creationDate) Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "La date de destruction ne peut pas être inférieure à la date de création"
    ,MYSQL_ERRNO = 5;
  end if;
end;
//

DELIMITER ;

DELIMITER //
DROP TRIGGER IF EXISTS check_lock_length_insert //
CREATE TRIGGER check_lock_length BEFORE INSERT ON enssat_lock
for each row
BEGIN
  if(new.length <= 0 OR new.length > 100) Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "La taille d'un canon doit être comprise entre 1 et 100"
    ,MYSQL_ERRNO = 6;
  end if;
end;
//

DELIMITER ;

DELIMITER //
DROP TRIGGER IF EXISTS check_lock_length_update //
CREATE TRIGGER check_lock_length_update BEFORE UPDATE ON enssat_lock
for each row
BEGIN
  if(new.length <= 0 OR new.length > 100) Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "La taille d'un canon doit être comprise entre 1 et 100"
    ,MYSQL_ERRNO = 6;
  end if;
end;
//

DELIMITER ;

DELIMITER //
DROP TRIGGER if exists test_provider_exist_insert //
create trigger test_provider_exist_insert Before INSERT on provider
for each row
Begin
    if (new.phone IN (select phone from provider) and new.name IN (select name from provider) and new.username in (select username from provider))  Then
      SIGNAL SQLSTATE '45000'
        SET message_TEXT = 'Ce fournisseur existe deja'
              ,MYSQL_ERRNO = 2;
    end if;

    if (character_length(new.phone) < 9 ) Then
      SIGNAL SQLSTATE '45000'
      SET message_TEXT = 'Le numero de telephone saisi est incorrect : 10 chiffres minimum'
            ,MYSQL_ERRNO = 1;
  end if;
end; //

DELIMITER ;

DELIMITER //
DROP TRIGGER if exists test_provider_exist_update //
create trigger test_provider_exist_update Before UPDATE on provider
for each row
Begin
  if (character_length(new.phone) < 9 ) Then
      SIGNAL SQLSTATE '45000'
      SET message_TEXT = 'Le numero de telephone saisi est incorrect : 10 chiffres minimum'
            ,MYSQL_ERRNO = 1;
  end if;
end; //

DELIMITER ;

DELIMITER //
DROP TRIGGER IF EXISTS check_user_status_insert //
CREATE TRIGGER check_user_status_insert BEFORE INSERT ON user
for each row
BEGIN
  if(new.status != 'Etudiant' AND new.status != 'Enseignant' AND new.status != 'Personnel') Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "Le status d'un utilisateur ne peut être autre que : Etudiant, Enseignant ou Personnel"
    ,MYSQL_ERRNO = 7;
  end if;
end; //

DELIMITER ;

DELIMITER //
DROP TRIGGER IF EXISTS check_user_status_update //
CREATE TRIGGER check_user_status_update BEFORE UPDATE ON user
for each row
BEGIN
  if(new.status != 'Etudiant' AND new.status != 'Enseignant' AND new.status != 'Personnel') Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "Le status d'un utilisateur ne peut être autre que : Etudiant, Enseignant ou Personnel"
    ,MYSQL_ERRNO = 7;
  end if;
end;
//

DELIMITER ;
