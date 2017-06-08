<?php

class UploadKeyCSVController {

  public $CSVName;
  public $service;

  public function __construct(){
    $DAO = implementationKeyDAO_Dummy::getInstance();
    $this->service = implementationKeyService_Dummy::getInstance();
    $this->saveCSV();
    $this->readCSV();
  }

  public function saveCSV(){
    $dossier = 'Upload/';
    $fichier = basename($_FILES['keyCSV']['name']);
    $taille = filesize($_FILES['keyCSV']['tmp_name']);
    $extension = strrchr($_FILES['keyCSV']['name'], '.');
    //Début des vérifications de sécurité...
    if($extension != '.csv')
    {
      $erreur = 'Vous devez uploader un fichier de type csv...';
    }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
      //On formate le nom du fichier ici...
      $fichier = strtr($fichier,
      'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
      'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
      $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
      if(move_uploaded_file($_FILES['keyCSV']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
      {
        echo 'Upload effectué avec succès !';
        $this->CSVName = $fichier;
      }
      else //Sinon (la fonction renvoie FALSE).
      {
        echo 'Echec de l\'upload !';
      }
    }
    else
    {
      echo $erreur;
    }
  }

  public function readCSV(){

    $dir = 'Upload/'.$this->CSVName;
    if (($handle = fopen($dir, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
        $this->service->createKeyFromCSV($data[0], $data[1], $data[2], $data[3]);
      }
      fclose($handle);
     // unlink($dir);
    }

  }
}
