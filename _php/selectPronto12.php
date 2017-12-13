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
	echo'<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>';
	echo '<table align="left"
	cellspacing="5" cellpadding="8">
	
	<tr>
		<td><b>Código da região</b></td>
		<td><b>Nome da região</b></td>
		<td><b>Total de astros</b></td>
		<td><b>Planetas</b></td>
		<td><b>Satélites</b></td>
		<td><b>Asteróides</b></td>
		<td><b>Estrelas</b></td>
		<td><b>Remanescentes</b></td>
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