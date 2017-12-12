<?php

require_once('mysqli_connect.php');

$query = "SELECT * FROM Regiao";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left"
	cellspacing="5" cellpadding="8">
	
	<tr>
		<td align="left"><b>codReg</b></td>
		<td align="left"><b>descricao</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['codReg'] . '</td><td align="left">' .
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