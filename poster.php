
<?php $pageTitle = 'bike information'; include './header.php'; ?>
<?php $pageTitle = 'bike information'; include './barre.php'; ?>
<?php
// pour garder la session (doit etre au debut de  la'pplication)
session_start();
// etablir la conn avec la bdd
try{
// $bdd est accessible par tous les fichier appelé par index.php
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=pfe','root', '');
}
catch (Exception $e) { die('Erreur : '.$e->getMessage()); } // stopper l'application si la bdd echoue

function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring.= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

if(isset($_POST['forminscription']))
{  
   

    if(empty($_POST['marque']) OR empty($_POST['taille']) OR empty($_POST['couleur']) OR empty($_POST['typee']) OR empty($_POST['adresse']) OR empty($_FILES['avatar']) )
    {
      //  header('Location: erreur_connexion.php');
      
    }
    else {
        $marque = htmlspecialchars($_POST['marque']);
        $taille = htmlspecialchars($_POST['taille']);
        $couleur = htmlspecialchars($_POST['couleur']);
        $typee =htmlspecialchars($_POST['typee']);
        
        $adresse =htmlspecialchars($_POST['adresse']);
        $photo =$_FILES['avatar'];
       
        $marquelength = strlen ($marque); 
        $taillelength = strlen ($taille); 
        if (($marquelength <= 255) AND ($taillelength <= 255)){  
           
            if (isset($_FILES['avatar']) )
            {
                
                $taillemax =2097152;
                $extensionvalides = array ('jpg', 'jpeg','gif','png');
                if( $_FILES['avatar']['size']<= $taillemax)
                {
                       $extensionupload =strtolower(substr(strrchr($_FILES['avatar']['name'],'.'),1)) ;
                       if (in_array($extensionupload,$extensionvalides))
                       {
                         $newname=RandomString().".".$extensionupload;
                         $chemin = "membre/avatar/";
                        $real=realpath($chemin);
                       
                         $resultat = move_uploaded_file($photo['tmp_name'],$chemin.$newname);
                         if ($resultat)
                         {
                            $photo = implode(',' , $photo);
                                                           $updateavatar = $bdd->prepare('INSERT INTO velo (marque,taille,couleur,typee,adresse,avatar) VALUES(?,?,?,?,?,?)');
                               $updateavatar -> execute(array($marque,$taille,$couleur,$typee,$adresse,$photo));
                              // $updateavatar -> execute(array(
                                // 'avatar'=>$_SESSION['marque'].".".$extensionupload,
                                // 'marque'=> $_SESSION['marque']
                               
                                   header('Location:  themenu.php'); 
                         }
                         else { echo ' erreur importation ';}
                       }
                       else 
                       {echo ' format jpg...';}
                }
                else 
                {
                    echo 'depassement de taille';
                }
            }
            
            
         
        
        }   

    
      else 
      {
       // header('Location: erreur_connexion.php'); 
      }
    }
}
?>
<?php $pageTitle = 'Poster'; include './header.php'; ?>

<div  id="poster" align="center">
<form method="POST" action="poster.php" enctype="multipart/form-data">
<table >
   <tr>
    <td colspan="3">
      <input type="file" class="my-input" name="avatar"/>
    </td>
  </tr>

  <tr>
    <td>
      <input type="text"  class="my-input" placeholder="Trademark" id="marque" name="marque"/>
    </td>
    <td>
      <input type="text"  class="my-input" placeholder="size" id="taille" name="taille" />
    </td>
  </tr>
  <tr>
    <td>
      <input type="text"  class="my-input" placeholder="color" id="couleur" name="couleur"  />
    </td>
    <td>
      <input type="text" class="my-input" placeholder="Type" id="typee" name="typee" />
    </td>
  </tr>
  <tr>
    <td colspan="3">
      <input type="text"  class="my-input" placeholder="Location" id="adresse" name="adresse"  />
    </td>
  </tr>
  <tr>
    <td colspan="3">
    <input type="text" class="my-input" placeholder="Prise" id="prix" name="prix"  />
    </td>
  </tr>   
 </table>
  <input type="submit" class="button-success" name="forminscription" value=" Enregistrer" />
</form>
</div>
<?php  include './footer.php'; ?>


