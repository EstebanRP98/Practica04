function buscarPorCorreo(){
    var correo = document.getElementById("correo").value
    var codigo = document.getElementById("remite").value
    if(correo ==""){
        document.getElementById("informacion").innerHTML="";
    }else{
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("informacion").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","../vista/buscar.php?correo="+correo+"&id="+codigo,true);
        xmlhttp.send();
    }
}