<?php

require_once('mysqli_connect.php');

$query = "SELECT * FROM Organizacao";

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
		<td><b>codOrg</b></td>
		<td><b>nome</b></td>
		<td><b>descricao</b></td>
		<td><b>dtCriacao</b></td>
		<td><b>dtDissolucao</b></td>
	</tr>';
	
	while ($row = mysqli_fetch_array($response))
	{
		echo '<tr><td align="left">' .
		$row['codOrg'] . '</td><td align="left">' .
		$row['nome'] . '</td><td align="left">' .
		$row['descricao'] . '</td><td align="left">' .
		$row['dtCriacao'] . '</td><td align="left">' .
		$row['dtDissolucao'] . '</td>';
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