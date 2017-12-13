<?php

require_once('mysqli_connect.php');

$query = "SELECT * FROM Conflito";

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
		<td><b>codConf</b></td>
		<td><b>nome</b></td>
		<td><b>data_inicio</b></td>
		<td><b>data_fim</b></td>
		<td><b>descricao</b></td>
		<td><b>codLug</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['codConf'] . '</td><td align="left">' .
		$row['nome'] . '</td><td align="left">' .
		$row['data_inicio'] . '</td><td align="left">' .
		$row['data_fim'] . '</td><td align="left">' .
		$row['descricao'] . '</td><td align="left">' .
		$row['codLug'] . '</td>';
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