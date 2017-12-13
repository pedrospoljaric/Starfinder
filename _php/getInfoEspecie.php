<?php

require_once('mysqli_connect.php');

$query = "SELECT * FROM Especie";

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
		<td><b>codEsp</b></td>
		<td><b>nome_cientifico</b></td>
		<td><b>nome_usual</b></td>
		<td><b>descricao</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['codEsp'] . '</td><td align="left">' .
		$row['nome_cientifico'] . '</td><td align="left">' .
		$row['nome_usual'] . '</td><td align="left">' .
		$row['descricao'] . '</td>';
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