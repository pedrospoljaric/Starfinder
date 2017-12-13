<?php

if (isset($_POST['submit']))
{
	$data_missing = array();
	
	if (empty($_POST['codConf']))
	{
		$data_missing[] = 'codConf';
	}
	else
	{
		$codConf = trim($_POST['codConf']);
	}
	
	if (empty($data_missing))
	{
		require_once('mysqli_connect.php');
		
		$result = $magus->execute("DELETE FROM ConflitoOrganizacao WHERE codConf=?", array($codConf));
		
		$query = "DELETE FROM Conflito WHERE codConf=?";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "i", $codConf);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Conflito excluído';
			
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
		echo '<script language="javascript">';
		echo 'alert("';
		echo 'You need to enter the following data: ';
		
		foreach ($data_missing as $missing)
		{
			echo "$missing ";
		}
		echo '")</script>';
	}
}

header('location: ../home.php');
?>