$(document).ready(function(){
	//Kalkulatu handler
	$("#btnNireGalderakErakutsi").click(function(){
		$("#emaitza").empty();
		$("#emaitza").load("../Zerbitzaria/showQuestionsAJAX.php");
		$("#btnGalderaIgo").css("display", "none");

	});	
	
	$("#btnGalderakGehitu").click(function(){
		if ($("#erabiltzailea").text() != ""){
				$("#emaitza").empty();
				$("#emaitza").load("../Zerbitzaria/addQuestionAJAX.php?erabiltzailea=" + $("#erabiltzailea").text());
				$("#btnGalderaIgo").css("display", "block");
		}
		
	});
	
	$("#btnGalderaIgo").click(function(){
		
		var ema = $.post("../Zerbitzaria/addQuestionAJAX.php?erabiltzailea=" + $("#erabiltzailea").text(),
		{
			txt_eposta: $("#txt_eposta").val(),
			txt_testua: $("#txt_testua").val(),
			txt_erantzun_zuzena: $("#txt_erantzun_zuzena").val(),
			txt_erantzun_okerra_1: $("#txt_erantzun_okerra_1").val(),
			txt_erantzun_okerra_2: $("#txt_erantzun_okerra_2").val(),
			txt_erantzun_okerra_3: $("#txt_erantzun_okerra_3").val(),
			txt_zailtasuna: $("#txt_zailtasuna").val(),
			txt_gai_arloa: $("#txt_gai_arloa").val(), 
			f_irudia: $("#f_irudia").val()
        },
        function(data,status){
			$("#emaitza").empty();
			$("#emaitza").html(data);
			$("#emaitza2").text(status);
        }, 
		"html");

		alert(ema[0]);
		
		
	});
	
	
});









 		