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
		
		$.post("../Zerbitzaria/addQuestionAJAX.php?erabiltzailea=" + $("#erabiltzailea").text(),
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
			
			if(status=='success'){
				$("#emaitza").empty();
				$("#emaitza").html(data);
				$("#emaitza2").text(status);
			}
			
			else{
				alert('AJAX POST ezin izan da ongi egin. Arazo bat gertatu da. ');
				$("#emaitza2").text(status);
			}
			
        }, 
		"html");
		
		
	});
	
	$("#txt_eposta").keyup(function(){
		
		$.post("../Zerbitzaria/egiaztatuPosta.php",
		{
			txt_eposta: $("#txt_eposta").val()
        },
        function(data,status){
			
			if(data == 'BAI'){
				$("#lbl_balizkoEposta").text("Erabiltzaile posta zuzena da. ");
				$("#lbl_balizkoEposta").css("color", "green");
				$("#btn_erregistratu").prop("disabled", false);

			}
			else{
				$("#lbl_balizkoEposta").text("Erabiltzaile posta ez da zuzena. ");
				$("#lbl_balizkoEposta").css("color", "red");
				$("#btn_erregistratu").prop("disabled", true);
			}
			
        });
		
		
	});
	
	$("#pwd_pasahitza").keyup(function(){
		
		$.post("../Zerbitzaria/egiaztatuPasahitzaBezeroa.php",
		{
			pwd_pasahitza: $("#pwd_pasahitza").val()
        },
        function(data,status){
			if(data == 'BALIOZKOA'){
				$("#lbl_balizkoPasahitza").text("Pasahitza egokia da. ");
				$("#lbl_balizkoPasahitza").css("color", "green");

			}
			else{
				$("#lbl_balizkoPasahitza").text("Pasahitza ez da trinkoa. ");
				$("#lbl_balizkoPasahitza").css("color", "red");
			}
			
        });
		
		
	});
	
	$("#pwd_pasahitza2").keyup(function(){
		
		if ($("#pwd_pasahitza").val() != $("#pwd_pasahitza2").val()){
			$("#lbl_balizkoPasahitza2").text("Pasahitzak desberdinak dira. ");
			$("#lbl_balizkoPasahitza2").css("color", "red");
		}
		else{
			$("#lbl_balizkoPasahitza2").text("Pasahitzak berdinak dira");
			$("#lbl_balizkoPasahitza2").css("color", "green");
		}
		
		
	});
	
	
	
});









 		