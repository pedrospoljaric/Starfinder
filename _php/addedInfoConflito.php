<?php

if (isset($_POST['submit']))
{
	$data_missing = array();
	
	if (empty($_POST['nome']))
	{
		$data_missing[] = 'nome';
	}
	else
	{
		$nome = trim($_POST['nome']);
	}
	if (empty($_POST['data_inicio']))
	{
		$data_missing[] = 'data_inicio';
	}
	else
	{
		$data_inicio = trim($_POST['data_inicio']);
	}
	if (empty($_POST['data_fim']))
	{
		$data_missing[] = 'data_fim';
	}
	else
	{
		$data_fim = trim($_POST['data_fim']);
	}
	if (empty($_POST['descricao']))
	{
		$data_missing[] = 'descricao';
	}
	else
	{
		$descricao = trim($_POST['descricao']);
	}
	if (empty($_POST['codLug']))
	{
		$data_missing[] = 'codLug';
	}
	else
	{
		$codLug = trim($_POST['codLug']);
	}
	
	if (empty($data_missing))
	{
		require_once('mysqli_connect.php');
		
		$query = "INSERT INTO Conflito VALUES (NULL, ?, ?, ?, ?, ?)";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "ssssi", $nome, $data_inicio, $data_fim, $descricao, $codLug);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Conflito cadastrado';
			
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