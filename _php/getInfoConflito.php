<?php

require_once('mysqli_connect.php');

$query = "SELECT * FROM Conflito";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left"
	cellspacing="5" cellpadding="8">
	
	<tr>
		<td align="left"><b>codConf</b></td>
		<td align="left"><b>nome</b></td>
		<td align="left"><b>data_inicio</b></td>
		<td align="left"><b>data_fim</b></td>
		<td align="left"><b>descricao</b></td>
		<td align="left"><b>codLug</b></td>
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