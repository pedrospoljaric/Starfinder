$('input.submit').click(function() {
	var post_url = $(this).parent("p").parent("form").attr("action");
	var dados = [];
	
	$(this).parent("p").parent("form").find("input").each(function(){
		dados[$(this).attr("name")] = $(this).val();
		//alert("key: " + $(this).attr("name") + " | value: " + $(this).val());
	});

	dados = $(this).parent("p").parent("form").serializeArray();
	dados.push({name: 'submit', value: 'true'});
	console.log(dados);

	$.post(post_url,
		dados,
		function(data, status){
			alert("Comando executado com sucesso!");
		});

	// $.ajax({
    //     url: post_url,
    //     type: 'POST',
    //     data: dados,
    //     success: function(msg) {
    //         alert('Ajax executado');
    //     }               
    // });
});