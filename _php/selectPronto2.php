<?php

require_once('mysqli_connect.php');

$query = "Select B.nome
FROM Astro B
JOIN AstroOrbita AO ON B.codAst = AO.codAst
JOIN Astro A ON AO.codOrbita = A.codAst
WHERE A.nome = 'Siskeen';";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left" border-collapse="collapse" border="1px solid black"
	cellspacing="5" cellpadding="8">
	
	<tr border="1px solid black">
		<td border="1px solid black" align="left"><b>Nome do astro</b></td>
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