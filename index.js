intentos = 0;

function entrar1(){
    var usuario = document.getElementById("user").value;
    var contraseña = document.getElementById("passw").value;
    var max_intentos= 3;

if(usuario=="Puma" && contraseña == "teamomami"){
    document.getElementById("formulario").style.display="none";
    document.getElementById("mensaje").style.display="block";
}
else{
    if(intentos<2){
        if(usuario!="Puma"){
            document.getElementById("errorUsuario").style.display="block";
        }
            else{
                document.getElementById("errorUsuario").style.display="none";
            }
        if(contraseña != "teamomami"){
            document.getElementById("errorContra").style.display="block";
        }
            else{
                document.getElementById("errorContra").style.display="none";
            }
            intentos ++;
            
            document.getElementById("n_intentos").innerHTML = "Te quedan " + (max_intentos - intentos) + " intentos";

        }
        else{
            document.write('Te has equivocado muchas veces, por favor contactar al administrador');
        }
    }
}



