<?php

require_once('mysqli_connect.php');

$query = "SELECT * FROM Astro";

$response = @mysqli_query($dbc, $query);

if ($response)
{
	echo '<table align="left" border-collapse="collapse" border="1px solid black"
	cellspacing="5" cellpadding="8">
	
	<tr border="1px solid black">
		<td border="1px solid black" align="left"><b>codAst</b></td>
		<td border="1px solid black" align="left"><b>nome</b></td>
		<td border="1px solid black" align="left"><b>composicao</b></td>
		<td border="1px solid black" align="left"><b>dist</b></td>
		<td border="1px solid black" align="left"><b>codSet</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['codAst'] . '</td><td align="left">' .
		$row['nome'] . '</td><td align="left">' .
		$row['composicao'] . '</td><td align="left">' .
		$row['dist'] . '</td><td align="left">' .
		$row['codSet'] . '</td>';
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