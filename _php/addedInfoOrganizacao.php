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
	if (empty($_POST['descricao']))
	{
		$data_missing[] = 'descricao';
	}
	else
	{
		$descricao = trim($_POST['descricao']);
	}
	if (empty($_POST['dtCriacao']))
	{
		$data_missing[] = 'dtCriacao';
	}
	else
	{
		$dtCriacao = trim($_POST['dtCriacao']);
	}
	if (empty($_POST['dtDissolucao']))
	{
		$data_missing[] = 'dtDissolucao';
	}
	else
	{
		$dtDissolucao = trim($_POST['dtDissolucao']);
	}
	
	if (empty($data_missing))
	{
		require_once('mysqli_connect.php');
		
		$query = "INSERT INTO Organizacao VALUES (NULL, ?, ?, ?, ?)";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "ssss", $nome, $descricao, $dtCriacao, $dtDissolucao);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Organização cadastrada';
			
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

header('location: ../../home.php');
?>