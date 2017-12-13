<?php

require_once('mysqli_connect.php');

$query = "SELECT R.nome, COUNT(E.codAst) as qtdRemanescente, R.qtdEstrela, COUNT(E.codAst)/R.qtdEstrela as proporcaoRemanescente
FROM (SELECT * FROM Estrela WHERE tipo <> 'Sol') AS E LEFT JOIN
	AstroSistema AS S ON (E.codAst = S.codAst) LEFT JOIN
    SistemaRegiao AS SR ON (S.codSis = SR.codSis) RIGHT JOIN
    (SELECT R.codReg, R.nome, COUNT(E.codAst) as qtdEstrela
	FROM Estrela AS E LEFT JOIN
		AstroSistema AS S ON (E.codAst = S.codAst) LEFT JOIN
		SistemaRegiao AS SR ON (S.codSis = SR.codSis) RIGHT JOIN
		VisaoRegiao AS R ON (R.codReg = SR.codReg)
	GROUP BY R.codReg) AS R ON (R.codReg = SR.codReg)
GROUP BY R.codReg
ORDER BY R.codReg;";

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
		<td><b>Nome da região</b></td>
		<td><b>Quantidade de remanescentes</b></td>
		<td><b>Quantidade de estrelas</b></td>
		<td><b>Proporção</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['nome'] . '</td><td align="left">' .
		$row['qtdRemanescente'] . '</td><td align="left">' .
		$row['qtdEstrela'] . '</td><td align="left">' .
		$row['proporcaoRemanescente'] . '</td>';
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