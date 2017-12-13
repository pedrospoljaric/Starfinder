<?php

if (isset($_POST['submit']))
{
	$data_missing = array();
	
	if (empty($_POST['codSis']))
	{
		$data_missing[] = 'codSis';
	}
	else
	{
		$codSis = trim($_POST['codSis']);
	}
	if (empty($_POST['nome']))
	{
		$data_missing[] = 'nome';
	}
	else
	{
		$nome = trim($_POST['nome']);
	}
	
	if (empty($data_missing))
	{
		require_once('mysqli_connect.php');
		
		echo '<script language="javascript">';
		echo 'alert("message successfully sent")';
		echo '</script>';
		
		$query = "UPDATE Sistema SET nome=? WHERE codSis=?";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "si", $nome, $codSis);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Sistema atualizado';
			
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