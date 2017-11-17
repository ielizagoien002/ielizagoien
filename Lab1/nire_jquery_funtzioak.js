$(document).ready(function(){
	
	//Kalkulatu handler
	$("#btn_konprobatu").click(function(){
		var n1 = parseFloat($("#lehena").val());
        var n2 = parseFloat($("#bigarrena").val());
        var erag = $("#eragilea").val()
        var eran = parseFloat($("#erantzuna").val());
	
		if (erag==="+"){
            result= n1+n2;
        }
        
        if (erag==="-"){
            result= n1-n2;
        }
        
        if (erag==="*"){
            result= n1*n2;
        }
        
        if (erag==="/"){
            result= n1/n2;
        }
	
		if (result===eran){
            $("#emaitza").val("ZUZENA!!");
        }else{
           $("#emaitza").val("OKERRA!!");
        }
		$("#emaitza").css("display", "block");

	});
	
	
	//Reset handler
	$("#btn_reset").click(function(){
	
		$("#lehena").val("");
		$("#bigarrena").val("");
        $("#eragilea").val("+");
        $("#emaitza").val("");
		$("#erantzuna").val("");
		$("#emaitza").css("display", "none");
	
	});
	
	
	//Erantzun aldaketa handler
	$("#erantzuna2").change(function(){
		
		var espr_balioa = $("#espresioa").val();
		var ema = parseFloat(math.eval(espr_balioa));
		var eran = parseFloat($("#erantzuna2").val());
		if(ema === eran){
			$("#emaitza").val("ZUZENA!!");
		}
		else{
			$("#emaitza").val("OKERRA!!");
		}
		$("#emaitza").css("display", "block");
	});
	
	//Reset handler 2
	$("#btn_reset2").click(function(){
	
		$("#espresioa").val("");
		$("#erantzuna2").val("");
		$("#emaitza").css("display", "none");
	
	});
});