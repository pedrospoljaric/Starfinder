var selectedTab = ""

function selectTable(tableName)
{
	alert('oi');
	hideAllSections();
	var comandos = document.getElementById("comandos");
	comandos.style.display = 'block';
	
	selectedTab = tableName;
}

function selectOption(opt)
{
	hideAllSections();
	var comandos = document.getElementById("comandos");
	comandos.style.display = 'block';
	var principal = document.getElementById("main"+opt);
	principal.style.display = 'block';
	
	if (opt == 'Select')
	{
		var opcoes = document.getElementById("opcoes");
		opcoes.style.display = 'block';
	}
	if (opt == 'Insert')
	{
		hideAllInsertForms();
		var tab = document.getElementById(selectedTab+"Form");
		tab.style.display = 'block';
	}
}

function hideAllInsertForms()
{
	document.getElementById("astroForm").style.display = 'none';
	document.getElementById("conflitoForm").style.display = 'none';
	document.getElementById("especieForm").style.display = 'none';
	document.getElementById("organizacaoForm").style.display = 'none';
	document.getElementById("regiaoForm").style.display = 'none';
	document.getElementById("sistemaForm").style.display = 'none';
}

function changeImg()
{
	var img = document.getElementById("imgSel");
	style = img.currentStyle || window.getComputedStyle(img, false);
	bi = style.backgroundImage.slice(4, -1);
	
	if (bi.includes("_rot.jpg"))
	{
		bi = bi.replace("_rot.jpg", ".jpg");
		document.getElementById("imgSel").style.backgroundImage = 'url(' + bi + ')';
	}
	else
	{
		bi = bi.replace(".jpg", "_rot.jpg");
		document.getElementById("imgSel").style.backgroundImage = 'url(' + bi + ')';
	}
}

function hideAllSections()
{	
	var comandos = document.getElementById("comandos");
	var opcoes = document.getElementById("opcoes");
	var mainSelect = document.getElementById("mainSelect");
	var mainInsert = document.getElementById("mainInsert");
	var mainUpdate = document.getElementById("mainUpdate");
	var mainDelete = document.getElementById("mainDelete");
	comandos.style.display = 'none';
	opcoes.style.display = 'none';
	mainSelect.style.display = 'none';
	mainInsert.style.display = 'none';
	mainUpdate.style.display = 'none';
	mainDelete.style.display = 'none';
}

function openInfo(idGrafo)
{
	selId = idGrafo;
	
	t = setInterval(updtTime,100);
	
	var infoBox = document.getElementById("info");
	infoBox.style.display = 'inline-block';
	var prot = document.getElementById("protecao");
	prot.style.display = 'inline-block';
	
	var grafo = document.getElementById(idGrafo);
	style = grafo.currentStyle || window.getComputedStyle(grafo, false);
	bi = style.backgroundImage.slice(4, -1);
	
	imgShow = document.getElementById("imgSel");
	imgShow.style.backgroundImage = 'url(' + bi + ')';
	
	var titleIn = grafo.getElementsByClassName("nome-grafo")[0];
	var titleOut = document.getElementById("titleSel");
	
	titleOut.textContent = titleIn.textContent;
	
	var infoAdicIn = grafo.getElementsByClassName("info-grafo")[0];
	var infoAdicOut = document.getElementById("graphInfoAdic");
	
	infoAdicOut.innerHTML = infoAdicIn.innerHTML;
	
	var aCodeIn = grafo.getElementsByClassName("link-codigo")[0];
	var aCodeOut = document.getElementById("aCode");
	
	aCodeOut.href = aCodeIn.href;
	
	var videoIn = grafo.getElementsByClassName("video-grafo")[0];
	var videoOut = document.getElementById("videoSel");
	
	videoOut.innerHTML = videoIn.innerHTML;
	videoOut.load();
}

function playGif()
{
	var img = document.getElementById("imgSel");
	style = img.currentStyle || window.getComputedStyle(img, false);
	bi = style.backgroundImage.slice(4, -1);
	
	if (bi.includes(".jpg"))
	{
		if (bi.includes("_rot.jpg"))
		{
			bi = bi.replace("_rot.jpg", ".gif");
			document.getElementById("imgSel").style.backgroundImage = 'url(' + bi + ')';
		}
		else
		{
			bi = bi.replace(".jpg", ".gif");
			document.getElementById("imgSel").style.backgroundImage = 'url(' + bi + ')';
		}
		document.getElementById("chk").checked = true;
		btnPlay.textContent = "\u25A0";
	}
	else
	{
		bi = bi.replace(".gif", "_rot.jpg");
		document.getElementById("imgSel").style.backgroundImage = 'url(' + bi + ')';
		document.getElementById("chk").checked = true;
		btnPlay.textContent = "\u25B6";
	}
}

// function playVideo()
// {
	// var video = document.getElementById("videoSel");
	// var btnPlay = document.getElementById("btnPlay");
	
	// if (video.currentTime == 0)
	// {
		// video.play();
		// video.style.display = "block";
		// btnPlay.textContent = "\u25A0";
	// }
	// else
	// {
		// video.pause();
		// video.currentTime = 0;
		// video.style.display = "none";
		// btnPlay.textContent = "\u25B6";
	// }
// }

var t;
function updtTime()
{
	var video = document.getElementById("videoSel");
	var videoTime = document.getElementById("video-time");
	
	var total = parseInt(video.duration);
	if (video.duration < 10)
		total = "0" + parseInt(video.duration);
	
	if (video.currentTime < 10)
		videoTime.textContent = "0:0" + parseInt(video.currentTime) + "/0:" + total;
	else
		videoTime.textContent = "0:" + parseInt(video.currentTime) + "/0:" + total;
}