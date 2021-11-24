

function entrar2(){
    console.log("Estoy dentro");
    var usuario = document.getElementById("user").value;
    var contrasena1 = document.getElementById("passw1").value;
    var contrasena2 = document.getElementById("passw2").value;
   
    if(usuario == "" || contrasena1 == "" || contrasena2 == ""){
        document.getElementById("uIntroduce").style.display= "block";
        document.getElementById("cIntroduce1").style.display= "block";
        document.getElementById("cVerifica").style.display= "block";
    }
   
    
}


