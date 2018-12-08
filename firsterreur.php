


<?php
// pour garder la session (doit etre au debut de  la'pplication)
session_start();
// etablir la conn avec la bdd
try{
// $bdd est accessible par tous les fichier appelé par index.php
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=pfe','root', '');
}
catch (Exception $e) { die('Erreur : '.$e->getMessage()); } // stopper l'application si la bdd echoue
if (isset($_POST['formconnexion']))
{ 
$Login = htmlspecialchars($_POST['mail']);
$Password = ($_POST['mdp']);

 if((empty($Login)) AND empty($Password) ) 
{ 
    header('Location: firsterreur.php');
}
else
{   
 $requser1= $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND mdp = ?  ");
 $requser1->execute(array($Login, $Password ));

 $userexist1 = $requser1->rowCount();


     if ($userexist1 == 1  )
     {
       $userinfo1 = $requser1->fetch();
      $_SESSION['mail']=$userinfo1['mail'];
      $_SESSION['num']=$userinfo1['num'];
      $_SESSION['prenom']=$userinfo1['prenom'];
      $_SESSION['nom']=$userinfo1['nom'];
     // $profil_type =  $bdd->prepare('SELECT `Type` FROM `membres` WHERE `mail`=?');
      //$profil_type-> execute(array($Login));
     // while($type = $profil_type->fetch())
     // {
      
     // }
     
     header('Location: themenu.php');
    }

     
     else
     { 
      header('Location: firsterreur.php');
      
     }
    }
  
  }   
?>

<?php $pageTitle = 'Login'; include './header.php'; ?>
	<div class="loginbox">
    <!--div id="titre"-->
      <!--h1>  Connectez vous ici </h1-->
    <!--/div-->
  <form method="POST" action="">
  <div id="naccount" >
        <p>
         Votre connexion a echoue 
        </p>
    </div>
		
      <div class="formcontrol">
        <!--label for="email">  Email </label-->
		    <input type="email" class="my-input" name="mail" placeholder="Email adress" id="email"/>
      </div>
	 
      <div class="formcontrol">
        <!--label for="password">  Mot de passe </label-->
	  	  <input type="password" class="my-input" name="mdp" placeholder="Password" id="password"/>
	  	</div>
      <div class="formcontrol">
	  	  <input class="button-success" type="submit" name="formconnexion"  value="Sign in" id="Connectez" />
      </div>
      <div id="naccount">
        <p>
         Not a member? <a href="signup.php">Sign in </a>
        </p>
    </div>
    </form>
  </div>
<?php include './footer.php' ?>


