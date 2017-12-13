<?php
echo "withour true";
if (isset($_POST['submit']))
{
	$data_missing = array();
	
	if (empty($_POST['nome_cientifico']))
	{
		$data_missing[] = 'nome_cientifico';
	}
	else
	{
		$nome_cientifico = trim($_POST['nome_cientifico']);
	}
	if (empty($_POST['nome_usual']))
	{
		$data_missing[] = 'nome_usual';
	}
	else
	{
		$nome_usual = trim($_POST['nome_usual']);
	}
	if (empty($_POST['descricao']))
	{
		$data_missing[] = 'descricao';
	}
	else
	{
		$descricao = trim($_POST['descricao']);
	}
	if (empty($_POST['planeta_natal']))
	{
		$data_missing[] = 'planeta_natal';
	}
	else
	{
		$planeta_natal = trim($_POST['planeta_natal']);
	}
	
	if (empty($data_missing))
	{
		require_once('mysqli_connect.php');
		
		$query = "INSERT INTO Especie VALUES (NULL, ?, ?, ?)";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "sss", $nome_cientifico, $nome_usual, $descricao);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		

		if ($affected_rows == 1)
		{
			echo 'Espécie cadastrada id='.mysqli_insert_id($dbc);

			$query = "INSERT INTO PertenceEspecieAstro VALUES (?, ?, 1)";
			
			$stmt = mysqli_prepare($dbc, $query);
			
			$inserted_id = mysqli_insert_id($dbc);
			mysqli_stmt_bind_param($stmt, "ii", $inserted_id, $planeta_natal);
			
			mysqli_stmt_execute($stmt);

			echo "Planeta linkado";
		}
		else
		{
			echo 'Erro';
			echo mysqli_error();
		}

		
			
		mysqli_stmt_close($stmt);
		
		mysqli_close($dbc);
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

//header('location: ../home.php');
?>