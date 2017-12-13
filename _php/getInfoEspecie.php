<?php

require_once('mysqli_connect.php');

$query = "SELECT * FROM Especie";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left" border-collapse="collapse" border="1px solid black"
	cellspacing="5" cellpadding="8">
	
	<tr border="1px solid black">
		<td border="1px solid black" align="left"><b>codEsp</b></td>
		<td border="1px solid black" align="left"><b>nome_cientifico</b></td>
		<td border="1px solid black" align="left"><b>nome_usual</b></td>
		<td border="1px solid black" align="left"><b>descricao</b></td>
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