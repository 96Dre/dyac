/**
 * Autor: Rodrigo Chambi Q.
 * Mail:  filvovmax@gmail.com
 * web:   www.gitmedio.com
 */
  var cm=0;
jQuery(document).ready(function($) {
   //Aqui validar las cajas de texto
  $("#IngresoLog").click(function(event) {
      $.ajax({
      	url: 'VerifCaptha.php',
      	type: 'POST',
      	dataType: 'text',
      	data: {"valor": $("#valorCapt").val()},
      })
      .done(function(data) {
       alert(data);
      })
      .fail(function() {
      	//console.log("error");
      })
      .always(function() {
      	//console.log("complete");
      });
      
      });

//Gnera Captcha

  $(".btncapt").click(function(){
//document.location.reload();
  
 CargarCaptcha();

});
  //cargamos la captcha al iniciar
  //la pagina web
  CargarCaptcha();
});

//Realiza la peticion AJAX
function CargarCaptcha() {
	 $.ajax({
   	url: 'captcha1.php',
   	type: 'post',
   	dataType: 'text',
   	data:{"capt":"visto"}
   })
   .done(function(data) {
    //alert(data);
   	var visto=$.parseJSON(data);
    //Canva Graficamos el texto devuelto por 
    //el servidor
   	var canva=document.getElementById("capatcha");
    var dibujar=canva.getContext("2d");
    canva.width = canva.width;
    dibujar.fillStyle="red";
    dibujar.font='20pt "NeoPrint M319"';
    dibujar.fillText(visto.retornar,6,39);

   	//console.log(data);
   })
   .fail(function() {
   	//console.log("error");
   })
   .always(function() {
   //	console.log("complete");
   });
   
}