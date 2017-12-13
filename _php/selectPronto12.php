<?php

require_once('mysqli_connect.php');

$query = "SELECT R.codReg, R.nome, 
	COUNT(L.codLug) as totalAstros,
	IFNULL(SUM(IF(L.tipoLugar = 'Planeta', 1, 0)), 0) AS qtdPlanetas,
	IFNULL(SUM(IF(L.tipoLugar = 'Satelite', 1, 0)), 0) AS qtdSatelites,
	IFNULL(SUM(IF(L.tipoLugar = 'Asteroide', 1, 0)), 0) AS qtdAsteroides,
	IFNULL(SUM(IF(L.tipoLugar = 'Estrela', 1, 0)), 0) AS qtdEstrelas,
	IFNULL(SUM(IF(L.tipoLugar = 'Remanescente de Estrela', 1, 0)), 0) AS qtdRemanescentes
FROM VisaoRegiao AS R LEFT JOIN
	SistemaRegiao AS S ON (R.codReg = S.codReg) LEFT JOIN
    AstroSistema AS A ON (S.codSis= A.codSis) LEFT JOIN
    VisaoLugar AS L ON (A.codAst = L.codLug)
GROUP BY R.codReg
HAVING COUNT(L.codLug) <= 5
ORDER BY totalAstros DESC;";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left" border-collapse="collapse" border="1px solid black"
	cellspacing="5" cellpadding="8">
	
	<tr border="1px solid black">
		<td border="1px solid black" align="left"><b>Código da região</b></td>
		<td border="1px solid black" align="left"><b>Nome da região</b></td>
		<td border="1px solid black" align="left"><b>Total de astros</b></td>
		<td border="1px solid black" align="left"><b>Planetas</b></td>
		<td border="1px solid black" align="left"><b>Satélites</b></td>
		<td border="1px solid black" align="left"><b>Asteróides</b></td>
		<td border="1px solid black" align="left"><b>Estrelas</b></td>
		<td border="1px solid black" align="left"><b>Remanescentes</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['codReg'] . '</td><td align="left">' .
		$row['nome'] . '</td><td align="left">' .
		$row['totalAstros'] . '</td><td align="left">' .
		$row['qtdPlanetas'] . '</td><td align="left">' .
		$row['qtdSatelites'] . '</td><td align="left">' .
		$row['qtdAsteroides'] . '</td><td align="left">' .
		$row['qtdEstrelas'] . '</td><td align="left">' .
		$row['qtdRemanescentes'] . '</td>';
		echo '</tr>';
	}
	
	echo '</table>';
}
else
{
	echo "Couldn't issue database query";
	
	echo mysqli_error($dbc);
}

mysqli_close($dbc);

?>