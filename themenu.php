<?php $pageTitle = 'city-bike'; include './header.php'; ?>
<?php $pageTitle = 'city-bike'; include './barre.php'; ?>

<?php
if (isset($_POST['inform']))
{
	header('Location:  login.php');
}






?>
	<table class="fonction" >
        <tr> 
        	<td>
	      		<img src="./Groupe 109.png" class= "image"> </img>
	      	</td>
	      	<td>
          		<img src="./2.png" class= "image"> </img>
          	</td>
        </tr>
        <tr> 
	      	<td>
	  	  		<input class="button-success1" type="submit" name="stat"  value="Ecot stat" id="statistique" />
        	</td>
       
          	<td>
	  	 		<a href="google.php"><input class="button-success1" type="submit" name="inform"  value="Book a bike" id="informer "  /></a>
	  	    </td>
              
        </tr>
        <tr> 
        	<td>
          		<img src="./1.png" class= "image"> </img>
          	</td>
          	<td>
          		<img src="./Groupe 89.png" class= "image"> </img>
          	</td>
        </tr>
        <tr>
          	<td>
	  	  		<a href="poster.php"><input class="button-success1" type="submit" name="alloc"  value="Allocate a bike" id="allouer" /></a>
	  	  	</td>
          	<td>
	  	  		<input class="button-success1" type="submit" name="chemin"  value="Best path" id="tour" />
	  	  	</td>
    	</tr>
    </table >
 <?php include './footer.php' ?>