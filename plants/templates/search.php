<?php
		$head=array("Kingdom","Order","Family","Genus","Species","Subspecies","Scientific Name");
		$connection=mysqli_connect("localhost","root","","african_plantae");
		echo"<!DOCTYPE html>
				<html lang='es'>
				<head>
					<meta charset='UTF-8'/>
					<link rel='stylesheet' type='text/css' href='../styles/search.css'/>
					<title>Search</title>
				</head>
				<body>";
		echo"	<h1>Search by species</h1>
					<form method='GET'>
						<label>Please enter the name of the species:</label>
						<input type='text' name='species'/>
						<input class='imagen' type='image' src='../images/lupa.png' value='search'/>
					</form>";
		if(isset($_GET['species']))
		{
			$species=$_GET['species'];
			$query='SELECT * FROM PLANT JOIN GENUS ON PLANT.id_genus=GENUS.id_genus JOIN FAMILY ON GENUS.id_family=FAMILY.id_family JOIN ORD3R ON FAMILY.id_order=ORD3R.id_order WHERE species LIKE "'.$species.'"';
			$res=mysqli_query($connection,$query);
			$fila=mysqli_fetch_assoc($res);
			if(isset($fila))
			{
				echo"	<table>";
				echo "	<tr class='header'>";
					foreach($head as $header)
						echo"	<td>".$header."</td>";
				echo "	</tr>";
				echo "	<tr>";
				echo "		<td>Plantae</td>";
				echo "		<td>".$fila['ord3r']."</td>";
				echo "		<td>".$fila['family']."</td>";
				echo "		<td>".$fila['genus']."</td>";
				echo "		<td>".$fila['species']."</td>";
				echo "		<td>".$fila['subspecies']."</td>";
				echo "		<td>".$fila['scientific_name']."</td>";
				echo "	</tr>";
				echo"</table>
							<p>Remember that the Plantae kingdom does not have phylum and class</p>";
			}
			else
				echo "<p>There is no such species yet. Do you want to register it?</p>
							<a href='register.php'><img src='../images/sign.png' alt='Register'>Register</a>";
		}
		echo"		<div class='bottomright'><a href='welcome.html'><img class='imagen' src='../images/home.png' alt='Home'>Home</a></div>
					</body>
				</html>";
?>
