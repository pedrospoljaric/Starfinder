<?php

require_once('mysqli_connect.php');

$query = "SELECT * FROM Conflito";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left" border-collapse="collapse" border="1px solid black"
	cellspacing="5" cellpadding="8">
	
	<tr border="1px solid black">
		<td border="1px solid black" align="left"><b>codConf</b></td>
		<td border="1px solid black" align="left"><b>nome</b></td>
		<td border="1px solid black" align="left"><b>data_inicio</b></td>
		<td border="1px solid black" align="left"><b>data_fim</b></td>
		<td border="1px solid black" align="left"><b>descricao</b></td>
		<td border="1px solid black" align="left"><b>codLug</b></td>
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