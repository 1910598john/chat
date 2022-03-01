$(".user-container").click(function(){
    var user = $(this).children("div.username").html();
    localStorage.setItem("user", user);
    $.ajax({
        type: 'POST',
        url: 'convo.php',
        data: { user : user },
    });
    document.getElementById("main").insertAdjacentHTML("afterbegin", `
    <div class="chat-wrapper" style="padding:20px;border-radius:15px;z-index:5;position:absolute;width:100%;height:100%;background:#fff;top:0;left:0;">
        <div class="friend-avatar" style="border-radius:15px 15px 0 0;z-index:10;background-image:linear-gradient(#fff, rgba(255,255,255,0.5));padding: 10px 0;position:absolute;top:0;left:50%;transform:translateX(-50%);width:100%;height:95px;">
            <div class="return" id="return" style="position:absolute;left:7%;top:50%;transform:translateY(-50%);"><i class="fa-solid fa-arrow-left" style="cursor:pointer;font-size:1.7em;"></i></div>
            <div class="image" style=";width:50px;height:50px;;text-align:center;position:absolute;transform:translateX(-50%);left:50%;"><img style="width:100%;border-radius:50%;height:100%;object-fit:cover;" src="images/blank_avatar.png"></div>
            <div class="name" style="position:absolute;bottom:10px;left:50%;transform:translateX(-50%);"><span>${user}</span></div>
        </div>
        <div id="message-wrapper" style="position:absolute;bottom:50px;width:calc(100% - 40px);height:auto;max-height:350px;overflow-y:scroll;"></div>
        <div class="user-input" style="border-radius:0 0 15px 15px;z-index:10;background:#fff;position:absolute;bottom:0;left:0;width:100%;height:50px;">
            <input type="text" id="input" placeholder="Say something.." style="padding:7px 5px;font-size:.9em;width:calc(100% - 40px);position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);border-radius:4px;border:1px solid gray;">
        </div>
    </div>`)
    document.getElementById("input").addEventListener("keypress", function(event){
        if (event.keyCode === 13) {
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
        }
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
    document.getElementById("return").addEventListener("click", function(){
        $(".chat-wrapper").remove();   
    })
})
$(".profile").click(function(){
    document.getElementById("main").insertAdjacentHTML("afterbegin", `
    <div class="chat-wrapper" style="border-radius:15px;z-index:5;position:absolute;width:100%;height:100%;background:#fff;top:0;left:0;">
        
        
    </div>`)
})
//update status to offline
function func(){
    $.ajax({
        type: 'POST',
        url: 'inactive.php',
        success: function(response){
            $("body").append(response);
        }
    });
}
//update status to online
function load(){
    $.ajax({
        type: 'POST',
        url: 'online.php',
        success: function(response){
            $("body").append(response);
        }
    });
}