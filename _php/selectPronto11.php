<?php

require_once('mysqli_connect.php');

$query = "SELECT P.codAst, A.nome, A.composicao,
	IFNULL(SUM(IF(L.tipoLugar = 'Satelite', 1, 0)), 0) AS satelitesOrbitando,
	IFNULL(SUM(IF(L.tipoLugar = 'Planeta', 1, 0)), 0) AS planetasOrbitando,
	IFNULL(SUM(IF(L.tipoLugar = 'Asteroide', 1, 0)), 0) AS asteroidesOrbitando,
	IFNULL(SUM(IF(L.tipoLugar = 'Estrela', 1, 0)), 0) AS estrelasOrbitando,
	IFNULL(SUM(IF(L.tipoLugar = 'Remanescente de Estrela', 1, 0)), 0) AS remanescentesOrbitando		
FROM Planeta AS P LEFT JOIN
	Astro AS A ON (P.codAst = A.codAst) LEFT JOIN
	AstroOrbita AS AO ON (P.codAst = AO.codOrbita) LEFT JOIN
    VisaoLugar AS L ON (AO.codAst = L.codLug)
GROUP BY P.codAst
ORDER BY P.codAst;";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left" border-collapse="collapse" border="1px solid black"
	cellspacing="5" cellpadding="8">
	
	<tr border="1px solid black">
		<td border="1px solid black" align="left"><b>Código do astro</b></td>
		<td border="1px solid black" align="left"><b>Nome do astro</b></td>
		<td border="1px solid black" align="left"><b>Composição do astro</b></td>
		<td border="1px solid black" align="left"><b>Satélites orbitando</b></td>
		<td border="1px solid black" align="left"><b>Planetas orbitando</b></td>
		<td border="1px solid black" align="left"><b>Asteróides orbitando</b></td>
		<td border="1px solid black" align="left"><b>Estrelas orbitando</b></td>
		<td border="1px solid black" align="left"><b>Remanescentes orbitando</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['codAst'] . '</td><td align="left">' .
		$row['nome'] . '</td><td align="left">' .
		$row['composicao'] . '</td><td align="left">' .
		$row['satelitesOrbitando'] . '</td><td align="left">' .
		$row['planetasOrbitando'] . '</td><td align="left">' .
		$row['asteroidesOrbitando'] . '</td><td align="left">' .
		$row['estrelasOrbitando'] . '</td><td align="left">' .
		$row['remanescentesOrbitando'] . '</td>';
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