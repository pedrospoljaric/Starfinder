<html>
<head>
<title>AddedInfoEspecie</title>
</head>
<body>

<?php

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
	
	if (empty($data_missing))
	{
		echo $nome_cientifico . '<br>';
		echo $nome_usual;
		echo $descricao;
		require_once('mysqli_connect.php');
		
		$query = "INSERT INTO Especie VALUES (NULL, ?, ?, ?)";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "sss", $nome_cientifico, $nome_usual, $descricao);
		
		mysqli_stmt_execute($stmt);
		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			echo 'Especie cadastrada';
			
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

?>

<form action="addedInfoEspecie.php" method="post">
	<b>Adicionar Espécie</b>
	<p>Código:
	<input type="text" name="codEsp" size="30" value=""</>
	</p>
	<p>Nome científico:
	<input type="text" name="nome_cientifico" size="30" value=""</>
	</p>
	<p>Nome usual:
	<input type="text" name="nome_usual" size="30" value=""</>
	</p>
	<p>Descrição:
	<input type="text" name="descricao" size="30" value=""</>
	</p>
	<p>
		<input type="submit" name="submit" value="Cadastrar" />
	</p>
</form>
	
</body>
</html>