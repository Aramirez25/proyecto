intentos = 0;

function entrar1(){
    var usuario = document.getElementById("user").value;
    var contrasena1 = document.getElementById("password1").value;
    var contrasena2 = document.getElementById("password2").value;
    
if(usuario != "" && contrasena1 != ""){
    document.getElementById("introducir_dato").style.display="block";
   
 }
}
console.log(entrar1());