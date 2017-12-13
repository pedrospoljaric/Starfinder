<?php

require_once('mysqli_connect.php');

$query = "SELECT P.codAst, A.nome, NE.nome AS nomeEstrela, NS.nome AS nomeSistema
FROM Estrela AS E LEFT JOIN
	AstroOrbita AS O ON (E.codAst = O.codOrbita) LEFT JOIN
    Astro AS A ON (O.codAst = A.codAst) JOIN
	Planeta AS P ON (A.codAst = P.codAst) LEFT JOIN
	AstroSistema AS ES ON (E.codAst = ES.codAst) LEFT JOIN
    AstroSistema AS PS ON (P.codAst = PS.codAst) LEFT JOIN
    Astro AS NE ON (E.codAst = NE.codAst) LEFT JOIN
    Sistema AS NS ON (ES.codSis = NS.codSis)
WHERE PS.codSis IS NULL;";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left" border-collapse="collapse" border="1px solid black"
	cellspacing="5" cellpadding="8">
	
	<tr border="1px solid black">
		<td border="1px solid black" align="left"><b>Código do astro</b></td>
		<td border="1px solid black" align="left"><b>Nome do astro</b></td>
		<td border="1px solid black" align="left"><b>Nome da estrela</b></td>
		<td border="1px solid black" align="left"><b>Nome do sistema</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['codAst'] . '</td><td align="left">' .
		$row['nome'] . '</td><td align="left">' .
		$row['nomeEstrela'] . '</td><td align="left">' .
		$row['nomeSistema'] . '</td>';
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