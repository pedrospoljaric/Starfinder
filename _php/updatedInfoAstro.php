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
	if (empty($_POST['nome']))
	{
		$data_missing[] = 'nome';
	}
	else
	{
		$nome = trim($_POST['nome']);
	}
	if (empty($_POST['composicao']))
	{
		$data_missing[] = 'composicao';
	}
	else
	{
		$composicao = trim($_POST['composicao']);
	}
	if (empty($_POST['dist']))
	{
		$data_missing[] = 'dist';
	}
	else
	{
		$dist = trim($_POST['dist']);
	}
	if (empty($_POST['codSet']))
	{
		$data_missing[] = 'codSet';
	}
	else
	{
		$codSet = trim($_POST['codSet']);
	}
	
	if (empty($data_missing))
	{
		require_once('mysqli_connect.php');
		
		$query = "UPDATE Astro SET nome=?, composicao=?, dist=?, codSet=? WHERE codAst=?";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "ssdii", $nome, $composicao, $dist, $codSet, $codAst);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Astro atualizado';
			
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