-------------------------------------------------------------------------------
-- fonction pour entrer nouvel utilisateur dans la base
--elle retourne le id utilisateur autoincrement
--@param nom varchar(45)
--@param username varchar(45)
--@param surname varchar(45)
--@param statut varchar(45)
--@param numérotéléphone Integer
--@param email varchar(45)

--return id utilisateur(Integer)

--------------------------------------------------------------------------------
DELIMITER //
DROP Function if exists NewUser //
create Function NewUser (
  lenom varchar(45),
  leusername varchar(45),
  lesurname varchar(45),
   lestatut varchar(45),
  lephone Integer,
  lemail varchar(45)
)
Returns int
Begin
    Declare idU int;
    insert into user(name,username,surname,status,phone,email)
      values(lenom,leusername,lesurname,lestatut,lephone,lemail);
    select enssatPrimaryKey into idU from user where name=lenom and username=leusername and surname=lesurname and status=lestatut and phone=lephone and email=lemail ;
    Return idU;
end;
//

--select NewUser('ba','goal','gg','etudiant',0617074285,'ba.geal@enssat.fr');

----------------------------------------------------------------------------------------
---fonction qui return le nombre de trouveau emprunté par un user
----@param idUser
---- return int
---------------------------------------------------------------------------------


DELIMITER //
DROP Function if exists nombreEmpruntUsers //
create Function nombreEmpruntUsers ( idUser integer)
Returns integer
Begin
    Declare nombre integer;
    select count(*) into nombre from borrowing where userId=idUser ;
    Return nombre;
end;
//

DELIMITER ;
-----------------------------------------
----test
--select nombreEmpruntUsers (1)
-----------------------------------------

----------------------------------------------------------------------------------------
---fonction qui return le nom du users
----@param idUser
---- return string le nom
---------------------------------------------------------------------------------
DELIMITER //
DROP Function if exists cKi //
create Function cKi (idUsers integer)
Returns varchar(45)
Begin
    Declare lenom varchar(45);
    select name into lenom from user where (enssatPrimaryKey=idUsers);
    Return lenom;
end;
//

DELIMITER ;
-----------------------------------------
----test
--  select cKi(1)
------------------------------------------