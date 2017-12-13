<?php

if (isset($_POST['submit']))
{
	$data_missing = array();
	
	if (empty($_POST['codOrg']))
	{
		$data_missing[] = 'codOrg';
	}
	else
	{
		$codOrg = trim($_POST['codOrg']);
	}
	
	if (empty($data_missing))
	{
		require_once('mysqli_connect.php');
		
		$result1 = $magus->execute("DELETE FROM ConflitoOrganizacao WHERE codOrg=?", array($codOrg));
		$result2 = $magus->execute("DELETE FROM EstaOrganLugar WHERE codOrg=?", array($codOrg));
		$result4 = $magus->execute("DELETE FROM EstruturaLugar WHERE codEst IN (SELECT codEst FROM Estrutura WHERE codOrg=?)", array($codOrg));
		$result5 = $magus->execute("DELETE FROM Estrutura WHERE codOrg=?", array($codOrg));
		
		$query = "DELETE FROM Organizacao WHERE codOrg=?";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "i", $codOrg);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Organização excluída';
			
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