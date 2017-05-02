<?php
  //DECLARACIÓN DE FUNCIONES

  function check($name)
  {
    $connection=mysqli_connect("localhost","root","","african_plantae");
    $query='SELECT species FROM PLANT WHERE species LIKE "'.$name.'"';
    $res=mysqli_query($connection,$query);
    $fila=mysqli_fetch_assoc($res);
    return $fila['species'];
  }

  $connection=mysqli_connect("localhost","root","","african_plantae");
  echo"<!DOCTYPE html>
      <html lang='es'>
      <head>
        <meta charset='UTF-8'/>
        <link rel='stylesheet' type='text/css' href='../styles/search.css'/>
        <title>Register</title>
      </head>
      <body>
        <h1>Register your spices</h1>
        <form method='GET'>
          <label>Specie: </label>
          <input type='text' name='specie'/>
          <label>Subspecies (if any): </label>
          <input type='text' name='subspecies'/>
          <label>Scientific name: </label>
          <input type='text' name='scientific_name'/>
          <label>Genus: </label>
          <select name='genus'>";
  $query='SELECT genus FROM GENUS';
  $res=mysqli_query($connection,$query);
  $fila=mysqli_fetch_assoc($res);
  while($fila)
  {
    echo "  <option value='".$fila['id_genus']."'>".$fila['genus']."</option>";
    $fila=mysqli_fetch_assoc($res);
  }
  echo "  </select>
          <input class='imagen' type='image' src='../images/plant.png'/>
        </form>";
  if(isset($_GET['specie']))
  {
    $name=$_GET['specie'];
    $scientific=$_GET['scientific_name'];
    $genus=$_GET['genus'];
    if(check($name)==FALSE)
    {
      $query='INSERT INTO plant VALUES ("","'.$name.'","","'.$scientific.'","'.$genus.'")';
      $res=mysqli_query($connection,$query);
      if($res==TRUE)
        echo "Species registered satisfactorily";
      else
        echo"<p>Sorry we are having problems with the database. We are working on it</p><br/>
              <img src='../images/mario.png'/>";
    }
    else
      echo "The species you introduced already exists";
  }
  echo"   <div class='bottomright'><a href='welcome.html'><img class='imagen' src='../images/home.png' alt='Home'>Home</a></div>
        </body>
			</html>";
?>
