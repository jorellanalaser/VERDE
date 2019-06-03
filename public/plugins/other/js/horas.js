fecha = new Date();
 hora = fecha.getHours();
 /* Fondo */
 $(document).ready(function(){

	if(hora >= 5 && hora <12 ){
		console.log('dia');
		$(".item").addClass("dia");
        $(".item").removeClass("tarde");
        $(".item").removeClass("noche");
	}
	if(hora >= 12 && hora <19 ){
		console.log('tarde');
		$(".item").addClass("tarde");
        $(".item").removeClass("dia");
        $(".item").removeClass("noche");
        
	}
	if(hora < 5 || hora >= 19){
		console.log('noche');
		$(".item").addClass("noche");
        $(".item").removeClass("tarde");
        $(".item").removeClass("dia");
        
	}
     
    /* DIVIDER */ 
     
    /*if(hora >= 6 && hora <12 ){
		$(".divider").addClass("dia");
        $(".divider").removeClass("tarde");
        $(".divider").removeClass("noche");
	}
	if(hora >= 12 && hora <19 ){
		$(".divider").addClass("tarde");
        $(".divider").removeClass("dia");
        $(".divider").removeClass("noche");
	}
	if(hora >= 19 /!*&& hora <6 *!/){
		$(".divider").addClass("noche");
        $(".divider").removeClass("tarde");
        $(".divider").removeClass("dia");
	}*/
 });