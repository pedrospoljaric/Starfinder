<?php

require_once('mysqli_connect.php');

$query = "SELECT A.nome FROM Especie E
JOIN PertenceEspecieAstro P ON E.codEsp = P.codEsp
JOIN Astro A ON P.codAst = A.codAst
WHERE E.nome_usual = 'Humanos';";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left"
	cellspacing="5" cellpadding="8">
	
	<tr>
		<td align="left"><b>Nome da espécie</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['nome'] . '</td>';
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