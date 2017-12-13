<!DOCTYPE html>
<?php

require_once('_php/mysqli_connect.php');

?>
<html lang="pt-br">

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta charset="UTF-8"/>
	<title>Starfinder</title>
	<link rel="stylesheet" href="_bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="_css/estilo.css"/>
	
	<script language="javascript" src="_js/funcoes.js"></script>

	<script src="jquery/jquery.min.js"></script>
	<script src="_bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div id="fundo_menu">
</div>

<div id="interface">
	<header id="cabecalho">
		Projeto Starfinder
	</header>
	
	<nav id="menu">
		<ul>
			<!-- <a href="inicio.html"> -->
			<li><div class="styled-select slate"><select id="tabelas" onchange="selectTable(value);">
				<option value="default" hidden>Tabelas</option>
				<option value="astro">Astro</option>
				<option value="conflito">Conflito</option>
				<option value="especie">Espécie</option>
				<option value="organizacao">Organização</option>
				<option value="regiao">Região</option>
				<option value="sistema">Sistema</option>
			</select></div></li>
			<!-- </a> -->
			<!-- <a href="sobre.html"> -->
			<li><div class="styled-select slate"><select>
				<option hidden>Visões</option>
				<option>teste2</option>
			</select></div></li>
			<!-- </a> -->
			<!-- <a href="autores.html"> -->
			<li><div class="styled-select slate"><select>
				<option hidden>Gatilhos</option>
				<option>teste2</option>
			</select></div></li>
			<!-- </a> -->
			<!-- <a href="publicacoes.html"><li>related work</li></a> -->
		</ul>
	</nav>
	
	<section id="comandos">
		<button id="btnSelect" onclick="selectOption('Select')" type="button">SELECT</button>
		<button id="btnInsert" onclick="selectOption('Insert')" type="button">INSERT</button>
		<button id="btnUpdate" onclick="selectOption('Update')" type="button">UPDATE</button>
		<button id="btnDelete" onclick="selectOption('Delete')" type="button">DELETE</button>
	</section>
	
	<section id="opcoes">
	
		<div onclick="changeSelect(1)">• Nomes dos astros que estão no Setor Calamari e orbitam o planeta Kashyyyk<br></div>
		<div onclick="changeSelect(2)">• Nomes dos astros que orbitam a estrela Siskeen<br></div>
		<div onclick="changeSelect(3)">• Nomes das estruturas dominadas pelo Império Galáctico<br></div>
		<div onclick="changeSelect(4)">• Nomes dos astros que são habitados pela espécie Humana<br></div>
		<div onclick="changeSelect(5)">• Nomes dos astros presentes no Sistema de Calamari<br></div>
		<div onclick="changeSelect(6)">• Estrelas que pertencem a mesma região que os Mon Calamari habitam <br></div>
		<div onclick="changeSelect(7)">• Encontramos um erro no mapa galáctico. Encontre quais planetas estão orbitando uma estrela (ou remanescente) mas não constam como pertencentes ao sistema da estrela<br></div>
		<div onclick="changeSelect(8)">• Astros que estão no setor Corusca e suas órbitas e quantidades de orbitas, ordenando por tipo de lugar<br></div>
		<div onclick="changeSelect(9)">• Contabilizar a proporcao de remanescentes de estrela por regiao da galáxia, ordenando pelo codRegiao<br></div>
		<div onclick="changeSelect(10)">• Listas as Organizações que participaram de conflitos que duraram mais de uma década, ordenando por anos de conflito e exibindo somente o conflito que levou mais tempo<br></div>
		<div onclick="changeSelect(11)">• Foi encontrado outro erro no mapa galáctico. Alguns planetas possuem outros planetas orbitando eles, não rola isso na física. exibir os astros e quantidade de satelites, planetas e outros corpos que orbitam ele<br></div>
		<div onclick="changeSelect(12)">• Consultar total de astros nas regiões, especificando quantos de cada tipo de astro, o total e somente para regiões com menos de 5 astros cadatrados, ordenando da maior total de astros pro menor<br></div>
	
	</section>
	
	<section id="mainSelect">
		<object type="text/html" data=getSelect() width="790" height="497" id="monica">
		</object>
	</section>
	<section id="mainInsert">
		<form action="_php/addedInfoAstro.php" method="post" id="astroForm">
			<b>Adicionar Astro</b>			
			<p>Código:
			<input type="text" name="codAst" size="30" value=""</>
			</p>
			<p>Nome:
			<input type="text" name="nome" size="30" value=""</>
			</p>
			<p>Composição:
			<input type="text" name="composicao" size="30" value=""</>
			</p>
			<p>Distância:
			<input type="text" name="dist" size="30" value=""</>
			</p>
			<p>Código do setor:
			<select name="codSet">
			<?php
				$result = $magus->execute("SELECT * FROM Setor ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codSet'].'">'.$row['nome'].'</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Cadastrar" />
			</p>
		</form>
		<form action="_php/addedInfoConflito.php" method="post" id="conflitoForm">
			<b>Adicionar Conflito</b>
			<p>Nome:
			<input type="text" name="nome" size="30" value=""</>
			</p>
			<p>Início:
			<input type="text" name="data_inicio" size="30" value=""</>
			</p>
			<p>Fim:
			<input type="text" name="data_fim" size="30" value=""</>
			</p>
			<p>Descrição:
			<input type="text" name="descricao" size="30" value=""</>
			</p>
			<p>Código do lugar:
			<input type="text" name="codLug" size="30" value=""</>
			<select name="codLug">
			<?php
				$result = $magus->execute("SELECT * FROM VisaoLugar ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codLug'].'">'.$row['nome'].'</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Cadastrar" />
			</p>
		</form>
		<form action="_php/addedInfoEspecie.php" method="post" id="especieForm">
			<b>Adicionar Espécie</b>
			<p>Nome científico:
			<input type="text" name="nome_cientifico" size="30" value=""</>
			</p>
			<p>Nome usual:
			<input type="text" name="nome_usual" size="30" value=""</>
			</p>
			<p>Descrição:
			<input type="text" name="descricao" size="30" value=""</>
			</p>
			<p>Planeta natal:
			<select name="planeta_natal">
			<?php
				$result = $magus->execute("SELECT * FROM VisaoLugar WHERE tipoLugar IN ('Planeta', 'Satelite') ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codLug'].'">'.$row['nome'].' ('.$row['tipoLugar'].')</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Cadastrar" />
			</p>
		</form>
		<form action="_php/addedInfoOrganizacao.php" method="post" id="organizacaoForm">
			<b>Adicionar Organização</b>
			<p>Nome:
			<input type="text" name="nome" size="30" value=""</>
			</p>
			<p>Descrição:
			<input type="text" name="descricao" size="30" value=""</>
			</p>
			<p>Data de criação:
			<input type="text" name="dtCriacao" size="30" value=""</>
			</p>
			<p>Data de dissolução:
			<input type="text" name="dtDissolucao" size="30" value=""</>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Cadastrar" />
			</p>
		</form>
		<form action="_php/addedInfoRegiao.php" method="post" id="regiaoForm">
			<b>Adicionar Região</b>			
			<p>Código:
			<input type="text" name="codReg" size="30" value=""</>
			</p>
			<p>Descrição:
			<input type="text" name="descricao" size="30" value=""</>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Cadastrar" />
			</p>
		</form>
		<form action="_php/addedInfoSistema.php" method="post" id="sistemaForm">
			<b>Adicionar Sistema</b>			
			<p>Código:
			<input type="text" name="codSis" size="30" value=""</>
			</p>
			<p>Nome:
			<input type="text" name="nome" size="30" value=""</>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Cadastrar" />
			</p>
		</form>
	</section>
	<section id="mainUpdate">
		<form action="_php/updatedInfoAstro.php" method="post" id="astroUpdateForm">
			<b>Atualizar Astro</b>			
			<p><b>Código:</b>
			<input type="text" name="codAst" size="30" value=""</>
			</p>
			<p>Nome:
			<input type="text" name="nome" size="30" value=""</>
			</p>
			<p>Composição:
			<input type="text" name="composicao" size="30" value=""</>
			</p>
			<p>Distância:
			<input type="text" name="dist" size="30" value=""</>
			</p>
			<p>Código do setor:
			<select name="codSet">
			<?php
				$result = $magus->execute("SELECT * FROM Setor ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codSet'].'">'.$row['nome'].'</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Atualizar" />
			</p>
		</form>
		<form action="_php/updatedInfoConflito.php" method="post" id="conflitoUpdateForm">
			<b>Atualizar Conflito</b>			
			<p><b>Código:</b>
			<input type="text" name="codConf" size="30" value=""</>
			</p>
			<p>Nome:
			<input type="text" name="nome" size="30" value=""</>
			</p>
			<p>Início:
			<input type="text" name="data_inicio" size="30" value=""</>
			</p>
			<p>Fim:
			<input type="text" name="data_fim" size="30" value=""</>
			</p>
			<p>Descrição:
			<input type="text" name="descricao" size="30" value=""</>
			</p>
			<p>Código do lugar:
			<select name="codLug">
			<?php
				$result = $magus->execute("SELECT * FROM VisaoLugar ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codLug'].'">'.$row['nome'].'</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Atualizar" />
			</p>
		</form>
		<form action="_php/updatedInfoEspecie.php" method="post" id="especieUpdateForm">
			<b>Atualizar Espécie</b>
			<p><b>Código:</b>
			<input type="text" name="codEsp" size="30" value=""</>
			</p>
			<p>Nome científico:
			<input type="text" name="nome_cientifico" size="30" value=""</>
			</p>
			<p>Nome usual:
			<input type="text" name="nome_usual" size="30" value=""</>
			</p>
			<p>Descrição:
			<input type="text" name="descricao" size="30" value=""</>
			</p>
			<p>Planeta natal:
			<select name="planeta_natal">
			<?php
				$result = $magus->execute("SELECT * FROM VisaoLugar WHERE tipoLugar IN ('Planeta', 'Satelite') ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codLug'].'">'.$row['nome'].' ('.$row['tipoLugar'].')</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Atualizar" />
			</p>
		</form>
		<form action="_php/updatedInfoOrganizacao.php" method="post" id="organizacaoUpdateForm">
			<b>Atualizar Organização</b>			
			<p><b>Código:</b>
			<input type="text" name="codOrg" size="30" value=""</>
			</p>
			<p>Nome:
			<input type="text" name="nome" size="30" value=""</>
			</p>
			<p>Descrição:
			<input type="text" name="descricao" size="30" value=""</>
			</p>
			<p>Data de criação:
			<input type="text" name="dtCriacao" size="30" value=""</>
			</p>
			<p>Data de dissolução:
			<input type="text" name="dtDissolucao" size="30" value=""</>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Atualizar" />
			</p>
		</form>
		<form action="_php/updatedInfoRegiao.php" method="post" id="regiaoUpdateForm">
			<b>Atualizar Região</b>			
			<p><b>Código:</b>
			<input type="text" name="codReg" size="30" value=""</>
			</p>
			<p>Descrição:
			<input type="text" name="descricao" size="30" value=""</>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Atualizar" />
			</p>
		</form>
		<form action="_php/updatedInfoSistema.php" method="post" id="sistemaUpdateForm">
			<b>Atualizar Sistema</b>			
			<p><b>Código:</b>
			<input type="text" name="codSis" size="30" value=""</>
			</p>
			<p>Nome:
			<input type="text" name="nome" size="30" value=""</>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Atualizar" />
			</p>
		</form>
	</section>
	<section id="mainDelete">
		<form action="_php/deletedInfoAstro.php" method="post" id="astroDeleteForm">
			<b>Excluir Astro</b>			
			<p><b>Código:</b>
			<select name="codAst">
			<?php
				$result = $magus->execute("SELECT * FROM Astro ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codAst'].'">'.$row['nome'].'</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Excluir" />
			</p>
		</form>
		<form action="_php/deletedInfoConflito.php" method="post" id="conflitoDeleteForm">
			<b>Excluir Conflito</b>			
			<p><b>Código:</b>
			<select name="codConf">
			<?php
				$result = $magus->execute("SELECT * FROM Conflito ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codConf'].'">'.$row['nome'].'</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Excluir" />
			</p>
		</form>
		<form action="_php/deletedInfoEspecie.php" method="post" id="especieDeleteForm">
			<b>Excluir Espécie</b>
			<p><b>Código:</b>
			<select name="codEsp">
			<?php
				$result = $magus->execute("SELECT * FROM Especie ORDER BY nome_usual ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codEsp'].'">'.$row['nome_usual'].'</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Excluir" />
			</p>
		</form>
		<form action="_php/deletedInfoOrganizacao.php" method="post" id="organizacaoDeleteForm">
			<b>Excluir Organização</b>			
			<p><b>Código:</b>
			<select name="codOrg">
			<?php
				$result = $magus->execute("SELECT * FROM Organizacao ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codOrg'].'">'.$row['nome'].'</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Excluir" />
			</p>
		</form>
		<form action="_php/deletedInfoRegiao.php" method="post" id="regiaoDeleteForm">
			<b>Excluir Região</b>			
			<p><b>Código:</b>
			<select name="codReg">
			<?php
				$result = $magus->execute("SELECT * FROM VisaoRegiao ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codReg'].'">'.$row['nome'].'</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Excluir" />
			</p>
		</form>
		<form action="_php/deletedInfoSistema.php" method="post" id="sistemaDeleteForm">
			<b>Excluir Sistema</b>			
			<p><b>Código:</b>
			<select name="codSis">
			<?php
				$result = $magus->execute("SELECT * FROM Sistema ORDER BY nome ASC", null);
				foreach($result as $row){
					echo '<option value="'.$row['codSis'].'">'.$row['nome'].'</option>';
				}
			?>
			</select>
			</p>
			<p>
				<input type="button" class="submit" name="submit" value="Excluir" />
			</p>
		</form>
	</section>
	
</section> 
</div>

<script src="_js/general.js"></script>

</body>
</html>