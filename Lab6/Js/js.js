$(document).ready(function(){
	//Kalkulatu handler
	$("#galderenF").submit(function(){
		/*
		var eposta = $("#txt_eposta").val();
        var email_egiaztatu = /[a-z]{2,100}\d{3}@ikasle\.ehu\.e(s|us)$/;
		
		if (!(email_egiaztatu.test(eposta))){
			alert("Sartu ongi emaila");
			return false;
		}
		
		
		//testua beteta dagoen kontrolatu
		var btestua = $("#txt_testua").val();
		if(btestua.length==0)
		{
			alert( "Ez duzu testua idatzi");				
			return false;			
		}
		
		//erantzun zuzena beteta dagoen kontrolatu
		var berantzun_zuzena = $("#txt_erantzun_zuzena").val();
		if(berantzun_zuzena.length==0)
		{
			alert( "Ez duzu erantzun zuzena idatzi");				
			return false;			
		}
		
		//erantzun okerra1 beteta dagoen kontrolatu
		var berantzun_okerra1 = $("#txt_erantzun_okerra_1").val();
		if(berantzun_okerra1.length==0)
		{
			alert( "Ez duzu erantzun okerra1 idatzi");				
			return false;			
		}
		
		//erantzun okerra2 beteta dagoen kontrolatu
		var berantzun_okerra2 = $("#txt_erantzun_okerra_2").val();
		if(berantzun_okerra2.length==0)
		{
			alert( "Ez duzu erantzun okerra2 idatzi");				
			return false;			
		}
		
		//erantzun okerra3 beteta dagoen kontrolatu
		var berantzun_okerra3 = $("#txt_erantzun_okerra_3").val();
		if(berantzun_okerra3.length==0)
		{
			alert( "Ez duzu erantzun okerra3 idatzi");				
			return false;			
		}
		
		//galderaren zailtasuna beteta dagoen kontrolatu
		var bzailtasuna = $("#txt_zailtasuna").val();
		if(bzailtasuna.length==0)
		{
			alert( "Ez duzu galderaren zailtasuna idatzi");				
			return false;			
		}
		
		//gai arloa beteta dagoen kontrolatu
		var bgai_arloa = $("#txt_gai_arloa").val();
		if(bgai_arloa.length==0)
		{
			alert( "Ez gai arloa idatzi");				
			return false;			
		}
		
		//Zailtasuna 1etik 5erako balioa den kontrolatu
		
		var zenbakiak = /[1-5]$/;
		var zailtasuna = $("#txt_zailtasuna").val();
		if(!zenbakiak.test(zailtasuna)) 
			{
				alert( "Ez duzu zailtasuna ondo idatzi, 1etik 5erako digitu bat izan behar du");	
				return false;
			}
		
		//testuak gutxienez 10 karaktereko luzera duen kontrolatu
		
		var testua_luzera = btestua.length;
		if(testua_luzera<10)
			{
				alert( "Testuak 10 karaktere izan behar ditu gutxienez");
				return false;
			}
			
		//Irudiaren tamaina 2mb baina handiagoa bada ez utzi. 
		var tamaina = $("#f_irudia")[0].files[0].size;
		
		if (tamaina > 2*1024*1024){
			alert("Irudia 2MB baina txikiagoa izan behar da. ");
			return false;
		}
		*/
		return true;
		
	});
	
	$("#erregistratuF").submit(function(){
		
		var eposta = $("#txt_eposta").val();
        var email_egiaztatu = /[a-z]{2,100}\d{3}@ikasle\.ehu\.e(s|us)$/;
		
		if (!(email_egiaztatu.test(eposta))){
			alert("Sartu ongi emaila");
			return false;
		}
		
		
		//Deiturak gutxienez bi hitz hizki larriez hasita
		var deitura = $("#txt_deitura").val();
		var deitura_egiaztatu = /[A-Z][a-z]+( [A-Z][a-z]+)+$/;
		if(!(deitura_egiaztatu.test(deitura))){
			alert( "Deitura ez da zuzena. Gutxienez hizki larriz hasitako bi hitz behar dira. ");				
			return false;			
		}
		
		//erantzun zuzena beteta dagoen kontrolatu
		var goitizena = $("#txt_goitizena").val();
		if(goitizena.length==0){
			alert( "Ez duzu goitizena idatzi");				
			return false;			
		}
		
		//erantzun okerra1 beteta dagoen kontrolatu
		var pasahitza = $("#pwd_pasahitza").val();
		
		var pasahitza2 = $("#pwd_pasahitza2").val();
		
		if(pasahitza.length==0 || pasahitza!=pasahitza2){
			alert( "Pasahitzen balioak ez dira zuzenak");				
			return false;			
		}
		
		return true;
	});
	
	
});









 		