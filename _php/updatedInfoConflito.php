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
		
		$query = "UPDATE Conflito SET nome=?, data_inicio=?, data_fim=?, descricao=?, codLug=? WHERE codConf=?";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "ssssii", $nome, $data_inicio, $data_fim, $descricao, $codLug, $codConf);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Conflito atualizado';
			
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