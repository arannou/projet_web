-------------------------------
------afficher detail emprunt d'un d'un troussseau
----@param idKeychain
--return all infos sur l'emprunteur
-----------------------------------
DELIMITER //
DROP procedure if exists detailEmprunt//
create procedure detailEmprunt(idK int)
	BEGIN
      select * from borrowing,user
      where (borrowing.userId=user.id and idK=borrowing.keychainid);
	END;
//
DELIMITER ;
-------------------------------------------
--call detailEmprunt(1)
-----------------------------------------------------


-----------------------------------------
----------infos ketchain & idUsers
-----------------------------------------------

DELIMITER //
DROP procedure if exists infoEmprunt//
create procedure infoEmprunt(idK int,idU int)
	BEGIN
      select * from borrowing,user
      where (borrowing.userId=user.id and idK=borrowing.keychainid and idU=borrowing.userId)
	END;
//
DELIMITER ;

-----------------------------------------
---------- quel(s) est/sont les clé()s qui ouvrent la salle (@param)
--@param nom de la salle
-- return l'identifiant de la clé
-----------------------------------------------

DELIMITER //
DROP procedure if exists laCleCorresp//
create procedure laCleCorresp(nameSalle varchar(45))
Begin
    select enssat_key.id from enssat_key,enssat_lock,door,room where room.name=nom and room.name=door.roomId and door.id=enssat_lock.doorId and enssat_lock.id=enssat_key.lockId ;
end
//
DELIMITER ;

------------------------------
--- call laCleCorresp('102H')
----------------


------------------------------------------------
---- cette cle ouvre quel salle?
----@param id de la clé
--return le nom de la salle qui peut etre ouvert
-------------------------------------------------
DELIMITER //
DROP procedure if exists lesSallesCorrpond//
create procedure lesSallesCorrpond(idKey integer)
Begin
    select room.name from enssat_key,enssat_lock,door,room where enssat_key.id=idKey and room.name=door.roomId and door.id=enssat_lock.doorId and enssat_lock.id=enssat_key.lockId ;
end
//
DELIMITER ;

------------------------------
--- call laCleCorresp(1)
----------------