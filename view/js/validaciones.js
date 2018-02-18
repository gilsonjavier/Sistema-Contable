    function mayusculas(e) {
      e.value = e.value.toUpperCase();
    }

    function texto(e){
      key = e.keyCode || e.which;
      teclado = String.fromCharCode(key).toLowerCase();
      nombre = " abcdefghijklmnñopqrstuvwxyz";
      especiales = "8-37-38-46-164";
      teclado_especial = false;
      for (var i in especiales){
        if(key==especiales[i]){
          teclado_especial = true; break;
        }
      }
      if(nombre.indexOf(teclado)==-1 && !teclado_especial){
        return false;
      }
    }
    

    function numeros(k){
      key = k.keyCode || k.which;
      teclado = String.fromCharCode(key);
      nume = "0123456789";
      especi = "8-37-38-46";
      tec_espe = false;
      for (var c in especi){
        if(key==especi[c]){
          tec_espe = true;
        }
      }
      if(nume.indexOf(teclado)==-1 && !tec_espe){
        return false;
      }
    }

function LetrasNumeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789abcdefghijklmnñopqrstuvwxyz";
    especiales = [];
 
    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}


function decimales(d){
      key = d.keyCode || d.which;
      teclado = String.fromCharCode(key);
      nume = "0123456789.";
      especi = "8-37-38-46";
      tec_espe = false;
      for (var c in especi){
        if(key==especi[c]){
          tec_espe = true;
        }
      }
      if(nume.indexOf(teclado)==-1 && !tec_espe){
        return false;
      }
    }
    /*
    function mueveReloj(){
      momentoActual = new Date()
      hora = momentoActual.getHours()
      minuto = momentoActual.getMinutes()
      segundo = momentoActual.getSeconds()
    horaImprimible = hora + ":" + minuto + ":" + segundo
    document.getElementById('reloj').value = horaImprimible
    setTimeout("mueveReloj()",1000)}

var flag = false;
    var teclaAnterior = "";
    
    function teclear(event) {
      teclaAnterior = teclaAnterior + " " + event.keyCode;
      var arregloTA = teclaAnterior.split(" ");
      if (event.keyCode == 32 && arregloTA[arregloTA.length - 2] == 32) {
        event.preventDefault();
      }
    }*/
