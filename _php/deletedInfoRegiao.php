<?php

if (isset($_POST['submit']))
{
	$data_missing = array();
	
	if (empty($_POST['codReg']))
	{
		$data_missing[] = 'codReg';
	}
	else
	{
		$codReg = trim($_POST['codReg']);
	}
	
	if (empty($data_missing))
	{
		require_once('mysqli_connect.php');
		
		$result1 = $magus->execute("DELETE FROM SistemaRegiao WHERE codReg=?", array($codReg));
		$result2 = $magus->execute("DELETE FROM AsteroideRegiao WHERE codReg=?", array($codReg));
		$result2 = $magus->execute("DELETE FROM NomeRegiao WHERE codReg=?", array($codReg));
		
		$query = "DELETE FROM Regiao WHERE codReg=?)";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "i", $codReg);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Região excluída';
			
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