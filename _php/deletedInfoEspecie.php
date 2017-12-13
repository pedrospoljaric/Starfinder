<?php

if (isset($_POST['submit']))
{
	$data_missing = array();
	
	if (empty($_POST['codEsp']))
	{
		$data_missing[] = 'codEsp';
	}
	else
	{
		$codEsp = trim($_POST['codEsp']);
	}
	
	if (empty($data_missing))
	{
		require_once('mysqli_connect.php');
		
		$query = "DELETE FROM Especie WHERE codEsp=?";
		
		$result = $magus->execute("DELETE FROM PertenceEspecieAstro WHERE codEsp=?", array($codEsp));
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "i", $codEsp);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Espécie excluída';
			
			mysqli_stmt_close($stmt);
			
			mysqli_close($dbc);
		}
		else
		{
			echo 'Erro';
			echo mysqli_error();
			
			mysqli_stmt_close($stmt);
			
			mysqli_close($dbc);
		}
	}
	else
	{
		echo 'You need to enter the following data';
		
		foreach ($data_missing as $missing)
		{
			echo "$missing";
		}
	}
}

header('location: ../home.php');
?>