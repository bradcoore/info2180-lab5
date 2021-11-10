window.onload=function(){
    var lookup= document.getElementById("lookup");
    var lookupcities= document.getElementById("lookupcities");
    
    lookup.addEventListener("click",(e)=>{
        e.preventDefault();
        var input = document.getElementById("country").value;
        var httpRequest= new XMLHttpRequest();
        var url= "world.php?country=" + input + "&context=countries";
        
        httpRequest.onreadystatechange= display;
        httpRequest.open("GET",url);
        httpRequest.send();

        function display(){
            if(httpRequest.readyState===XMLHttpRequest.DONE){
                if(httpRequest.status===200){
                    var response= httpRequest.responseText;
                    var result=document.getElementById("result");
                    result.innerHTML=response;
                }else{
                    alert("There was a problem with this request");
                }
            }
        }
    });

    lookupcities.addEventListener("click",(e)=>{
        e.preventDefault();
        var input = document.getElementById("country").value;
        var httpRequest= new XMLHttpRequest();
        var url= "world.php?country=" + input + "&context=cities";
        httpRequest.onreadystatechange= getcity;
        httpRequest.open("GET",url);
        httpRequest.send();

        function getcity(){
            if(httpRequest.readyState===XMLHttpRequest.DONE){
                if(httpRequest.status===200){
                    var response= httpRequest.responseText;
                    var result=document.getElementById("result");
                    result.innerHTML=response;
                }else{
                    alert("There was a problem with this request");
                }
            }
        }
    });
}
