$(document).ready(function(){
	//Kalkulatu handler
	$("#btnNireGalderakErakutsi").click(function(){
		$("#emaitza").empty();
		$("#emaitza").load("../Zerbitzaria/showQuestionsAJAX.php");
		$("#btnGalderaIgo").css("display", "none");

	});	
	
	$("#btnGalderakGehitu").click(function(){
		
		$("#emaitza").empty();
		$("#emaitza").load("../Zerbitzaria/addQuestionAJAX.php");
		$("#btnGalderaIgo").css("display", "block");
		
		
	});
	
	$("#btnGalderaIgo").click(function(){
		
		$.post("../Zerbitzaria/addQuestionAJAX.php",
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
	
	$("#btnGalderakEditatu").click(function(){
		$("#emaitza").empty();
		$("#emaitza").load("../Zerbitzaria/galderakEditatu.php");
		
		
	});
	
	$(".btnGalderaEditatu").click(function(){
		
		var row_index = $(this).parent().parent().index();		
		$("#taulaGalderakEditatu #" +row_index+" *").prop("disabled", false);
		$("#taulaGalderakEditatu #" +row_index+" #txt_eposta").prop("disabled", true);
		$("#"+row_index+" .btnGalderaGorde").show();
				
	});
	
	$(".btnGalderaGorde").click(function(){
		var row_index = $(this).parent().parent().index();
		var txt_eposta = $("#taulaGalderakEditatu #" +row_index+" #txt_eposta").val();
		var txt_testua = $("#taulaGalderakEditatu #" +row_index+" #txt_testua").val();
		var txt_erantzun_zuzena = $("#taulaGalderakEditatu #" +row_index+" #txt_erantzun_zuzena").val();
		var txt_erantzun_okerra_1 = $("#taulaGalderakEditatu #" +row_index+" #txt_erantzun_okerra_1").val();
		var txt_erantzun_okerra_2 = $("#taulaGalderakEditatu #" +row_index+" #txt_erantzun_okerra_2").val();
		var txt_erantzun_okerra_3 = $("#taulaGalderakEditatu #" +row_index+" #txt_erantzun_okerra_3").val();
		var txt_zailtasuna = $("#taulaGalderakEditatu #" +row_index+" #txt_zailtasuna").val();
		var txt_gaia = $("#taulaGalderakEditatu #" +row_index+" #txt_gaia").val();
		var txt_identifikatzailea = $("#taulaGalderakEditatu #"+row_index+" #txt_identifikatzailea").val();
		
		$("#taulaGalderakEditatu #" +row_index+" *").prop("disabled", false);
		$("#taulaGalderakEditatu #" +row_index+" #txt_eposta").prop("disabled", true);
		if(confirm("Balio berriak hauek dira, ados?: Eposta: "+txt_eposta+"\nTestua: "+txt_testua+"\nErantzun zuzena: "+txt_erantzun_zuzena+"\nErantzun okerra 1: "+txt_erantzun_okerra_1+"\nErantzun okerra 2: "+txt_erantzun_okerra_2+"\nErantzun okerra 3: "+txt_erantzun_okerra_3+"\nZailtasuna: "+txt_zailtasuna+"\nGaia: "+txt_gaia+"\n")){
			$.post("../Zerbitzaria/galderakEditatu.php",
			{
				txt_eposta: txt_eposta,
				txt_testua: txt_testua,
				txt_erantzun_zuzena: txt_erantzun_zuzena,
				txt_erantzun_okerra_1: txt_erantzun_okerra_1,
				txt_erantzun_okerra_2: txt_erantzun_okerra_2,
				txt_erantzun_okerra_3: txt_erantzun_okerra_3,
				txt_zailtasuna: txt_zailtasuna,
				txt_gaia: txt_gaia,
				txt_identifikatzailea: txt_identifikatzailea
			},
			function(data,status){
				if($.trim(data) == "BAI"){
					alert("Aldaketak ongi egin dira");
				}
				else{
					alert("Arazo bat gertatu da. " + data);
				}
				
			
			}
			);
		}
		
		else{
			alert("Etzetz aukeratu duzu");
		} 
		$("#taulaGalderakEditatu #" +row_index+" *").prop("disabled", true);
		$(".btnGalderaEditatu").prop("disabled", false);
		$(this).css("display", "none");	
	});
	
	
	
});









 		