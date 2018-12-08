
<?php $pageTitle = 'Signup'; include './bike-city/header.php'; ?>
<?php

// pour garder la session (doit etre au debut de  la'pplication)
session_start();
// etablir la conn avec la bdd
try{
// $bdd est accessible par tous les fichier appelé par index.php
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=pfe','root', '');
}
catch (Exception $e) { die('Erreur : '.$e->getMessage()); } // stopper l'application si la bdd echoue
if(isset($_POST['forminscription']))
{  $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = htmlspecialchars($_POST['mail']);
    $mdp =($_POST['mdp']);
    $mdp2 =($_POST['mdp2']);
    $num = htmlspecialchars($_POST['num']);
    if(empty($_POST['nom']) OR empty($_POST['prenom']) OR empty($_POST['mail']) OR empty($_POST['mdp']) OR empty($_POST['mdp2']) OR empty($_POST['num']))
    {
        header('Location: firsterreur.php');
    }
    else {
    
      $nomlength = strlen ($nom); 
      $prenomlength = strlen ($prenom); 
      if (($nomlength <= 255) AND ($prenomlength <= 255))
      {   if (filter_var($mail,FILTER_VALIDATE_EMAIL))
        {
         if ( $mdp == $mdp2)
         {
            $insertmbr =  $bdd->prepare("INSERT INTO  membres ( nom,prenom,mail,mdp,num)VALUES (?,?,?,?,?)");
            $insertmbr -> execute(array($nom,$prenom,$mail,$mdp,$num));
            echo ' votre compte a ete bien creer';
         }
         else {//  header('Location: erreur_connexion.php'); 
        }   
      }
      else { //  header('Location: erreur_connexion.php');
    }
    }
      else 
      {
       // header('Location: erreur_connexion.php'); 
      }
    }
}
?>
 
    

  
  <div  id="barr" >
    <h2> Sign up </h2>
   <img src="./Groupe 26.png"> </img>
  </div>
  <div id="naccount" >
        <p>
         Votre connexion a echoue 
        </p>
    </div>
 <div  id="registorbox" align="center">
    <form method="POST" action="">
   
      <table class="full-width" >
      <tr >
        <td>
          <input type="text" class="my-input" placeholder="Firstname" name="nom" />
        </td>
        <td>
          <input type="text" class="my-input" placeholder="Lastname" name="prenom" />
        </td>
      </tr> 
      <tr >
        <td>
          <input type="email" class="my-input" placeholder="Email" name="mail" />
        </td>
        <td >
          <input type="text" class="my-input" placeholder="Number" name="num" />
        </td>
      </tr >
      <tr >
        <td colspan="2">
          <input type="password" class="my-input" placeholder="Password"  name="mdp" />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="password" class="my-input"  placeholder="confirm Password" name="mdp2" />
        </td>
      </tr>
      <tr>
      <td colspan="2">
        <input type="submit" class="button-success" name="forminscription" value="Sign up" />
      </td>
      </tr>
    </table>
</form>
  

  </div>

  <?php include './bike-city/footer.php' ?>