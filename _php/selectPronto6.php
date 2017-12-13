<?php

require_once('mysqli_connect.php');

$query = "SELECT A.nome, E.tipo, R.codReg
FROM Estrela AS E LEFT JOIN
	Astro AS A ON (E.codAst = A.codAst) LEFT JOIN
	AstroSistema AS S ON (A.codAst = S.codAst) LEFT JOIN
	SistemaRegiao AS R ON (S.codSis = R.codSis)
WHERE R.codReg IN (
	SELECT R.codReg
	FROM Especie AS E LEFT JOIN
		PertenceEspecieAstro AS A ON (E.codEsp = A.codEsp) LEFT JOIN
		AstroSistema AS S ON (A.codAst = S.codAst) LEFT JOIN
		SistemaRegiao AS SR ON (S.codSis = SR.codSis) LEFT JOIN
		Regiao AS R ON (SR.codReg = R.codReg)
	WHERE E.nome_cientifico = 'Mon Calamari' OR E.nome_usual = 'Mon Calamari');";

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
		<td><b>Nome do astro</b></td>
		<td><b>Tipo de estrela</b></td>
		<td><b>Código da região</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['nome'] . '</td><td align="left">' .
		$row['tipo'] . '</td><td align="left">' .
		$row['codReg'] . '</td>';
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