<?php

require_once('mysqli_connect.php');

$query = "SELECT A.nome, L.tipoLugar, GROUP_CONCAT(L2.nome ORDER BY O.codOrbita ASC SEPARATOR ', ') As orbitas, COUNT(L2.codLug) AS qtdOrbitas
FROM Astro AS A LEFT JOIN
	VisaoLugar AS L ON (A.codAst = L.codLug) LEFT JOIN
	Setor AS S ON (A.codSet = S.codSet) LEFT JOIN	
	AstroOrbita AS O ON (A.codAst = O.codAst) LEFT JOIN
	VisaoLugar AS L2 ON (O.codOrbita = L2.codLug)
WHERE S.nome LIKE '%Corusca%'
GROUP BY A.codAst
ORDER BY L.tipoLugar;";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left"
	cellspacing="5" cellpadding="8">
	
	<tr>
		<td align="left"><b>Nome do astro</b></td>
		<td align="left"><b>Tipo de lugar</b></td>
		<td align="left"><b>Órbitas</b></td>
		<td align="left"><b>Quantidade de órbitas</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['nome'] . '</td><td align="left">' .
		$row['tipoLugar'] . '</td><td align="left">' .
		$row['orbitas'] . '</td><td align="left">' .
		$row['qtdOrbitas'] . '</td>';
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