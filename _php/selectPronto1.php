<?php

require_once('mysqli_connect.php');

$query = "SELECT A.nome
FROM Astro A 
JOIN Planeta P ON A.codAst = P.codAst
JOIN AstroOrbita AO ON A.codAst = AO.codAst
JOIN Astro B ON AO.codOrbita = B.codAst
JOIN Setor S ON A.codSet = S.codSet
WHERE S.nome = 'Setor Calamari'
AND B.nome = 'Kashyyyk';";

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