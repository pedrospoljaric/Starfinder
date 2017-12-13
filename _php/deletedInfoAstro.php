<?php

if (isset($_POST['submit']))
{
	$data_missing = array();
	
	if (empty($_POST['codAst']))
	{
		$data_missing[] = 'codAst';
	}
	else
	{
		$codAst = trim($_POST['codAst']);
	}
	
	if (empty($data_missing))
	{
		require_once('mysqli_connect.php');
		
		$result1 = $magus->execute("DELETE FROM AstroOrbita WHERE codAst=?", array($codAst));
		$result2 = $magus->execute("DELETE FROM AstroSistema WHERE codAst=?", array($codAst));
		$result3 = $magus->execute("DELETE FROM PertenceEspecieAstro WHERE codAst=?", array($codAst));
		$result3 = $magus->execute("DELETE FROM Asteroide WHERE codAst=?", array($codAst));
		$result3 = $magus->execute("DELETE FROM Satelite WHERE codAst=?", array($codAst));
		$result3 = $magus->execute("DELETE FROM Planeta WHERE codAst=?", array($codAst));
		$result3 = $magus->execute("DELETE FROM Estrela WHERE codAst=?", array($codAst));
		$result3 = $magus->execute("DELETE FROM Lugar WHERE codLug=?", array($codAst));
		
		$query = "DELETE FROM Astro WHERE codAst=?";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "i", $codAst);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Astro excluído';
			
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