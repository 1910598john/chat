document.getElementById("active-user").innerHTML = localStorage.getItem("user");

$("button").click(function(){
    var message = $("#input").val();
    var user = localStorage.getItem("user");
    $.ajax({
        type: 'POST',
        url: 'storeconvo.php',
        data: { 
            message : message,
            user : user
        }
    })
    document.getElementById("input").value = "";
    
})

setInterval(start, 100);

function start(){
    var req = new XMLHttpRequest();
    req.onload = function(){
        document.getElementById("message-wrapper").innerHTML = this.responseText;
    }
    req.open("GET", "retrieve.php");
    req.send();
}

