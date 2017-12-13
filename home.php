<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8"/>
	<title>Starfinder</title>
	<link rel="stylesheet" href="_css/estilo.css"/>
</head>
<script language="javascript" src="_js/funcoes.js"></script>
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
	Lista de selects disponíveis vem aqui.
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
			<input type="text" name="codSet" size="30" value=""</>
			</p>
			<p>
				<input type="submit" name="submit" value="Cadastrar" />
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
			</p>
			<p>
				<input type="submit" name="submit" value="Cadastrar" />
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
			<p>
				<input type="submit" name="submit" value="Cadastrar" />
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
				<input type="submit" name="submit" value="Cadastrar" />
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
				<input type="submit" name="submit" value="Cadastrar" />
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
				<input type="submit" name="submit" value="Cadastrar" />
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
			<input type="text" name="codSet" size="30" value=""</>
			</p>
			<p>
				<input type="submit" name="submit" value="Atualizar" />
			</p>
		</form>
		<form action="_php/updatedInfoConflito.php" method="post" id="conflitoUpdateForm">
			<b>Atualizar Conflito</b>			
			<p><b>Código:</b>
			<input type="text" name="codAst" size="30" value=""</>
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
			<input type="text" name="codLug" size="30" value=""</>
			</p>
			<p>
				<input type="submit" name="submit" value="Atualizar" />
			</p>
		</form>
		<form action="_php/updatedInfoEspecie.php" method="post" id="especieUpdateForm">
			<b>Atualizar Espécie</b>
			<p><b>Código:</b>
			<input type="text" name="codAst" size="30" value=""</>
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
			<p>
				<input type="submit" name="submit" value="Atualizar" />
			</p>
		</form>
		<form action="_php/updatedInfoOrganizacao.php" method="post" id="organizacaoUpdateForm">
			<b>Atualizar Organização</b>			
			<p><b>Código:</b>
			<input type="text" name="codAst" size="30" value=""</>
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
				<input type="submit" name="submit" value="Atualizar" />
			</p>
		</form>
		<form action="_php/updatedInfoRegiao.php" method="post" id="regiaoUpdateForm">
			<b>Atualizar Região</b>			
			<p><b>Código:</b>
			<input type="text" name="codAst" size="30" value=""</>
			</p>
			<p>Descrição:
			<input type="text" name="descricao" size="30" value=""</>
			</p>
			<p>
				<input type="submit" name="submit" value="Atualizar" />
			</p>
		</form>
		<form action="_php/updatedInfoSistema.php" method="post" id="sistemaUpdateForm">
			<b>Atualizar Sistema</b>			
			<p><b>Código:</b>
			<input type="text" name="codAst" size="30" value=""</>
			</p>
			<p>Nome:
			<input type="text" name="nome" size="30" value=""</>
			</p>
			<p>
				<input type="submit" name="submit" value="Atualizar" />
			</p>
		</form>
	</section>
	<section id="mainDelete">
	Id vem aqui.
	</section>
	
</section> 
</div>

<script src="jquery/jquery.min.js"></script>
<script src="_js/general.js"></script>
</body>
</html>