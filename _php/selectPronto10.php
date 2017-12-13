<?php

require_once('mysqli_connect.php');

$query = "SELECT O.nome, anoIntervalo(C.data_inicio, C.data_fim) AS anosDeConflito
FROM Organizacao AS O LEFT JOIN
	ConflitoOrganizacao AS CO ON (O.codOrg = CO.codOrg) LEFT JOIN
	Conflito AS C ON (CO.codConf = C.codConf)
WHERE C.data_fim IS NOT NULL AND
	anoIntervalo(C.data_inicio, C.data_fim) >= 10
GROUP BY O.codOrg
ORDER BY anosDeConflito DESC;";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left"
	cellspacing="5" cellpadding="8">
	
	<tr>
		<td align="left"><b>Nome da organização</b></td>
		<td align="left"><b>Duração do conflito(anos)</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['nome'] . '</td><td align="left">' .
		$row['anosDeConflito'] . '</td>';
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