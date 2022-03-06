window.addEventListener("load", function(){
    document.getElementById("container").insertAdjacentHTML("afterbegin", `
    <div class="active-people-content" id="active-people-content"></div>`);
    $.ajax({
        type: 'POST',
        url: 'active_people_content.php',
        success: function(res){
            $("#active-people-content").html(res);
            $(".user-container").click(function(){
                var user = $(this).children("div.username").html();
                var name = $(this).children("div.user").html();
                start_chatting(user, name);
            })
        }
    })
})


var messagefrom;
var x;
function start_chatting(user, name){
    localStorage.setItem("user", user);
    $.ajax({
        type: 'POST',
        url: 'user_name.php',
        data: {user : user},
        success: function(res){
            messagefrom = res;
            $.ajax({
                type: 'POST',
                url: 'convo.php',
                data: {
                    user: user,
                    name: name,
                }
            })
        }
    });
    document.getElementById("main").insertAdjacentHTML("afterbegin", `
    <div class="chat-wrapper" style="overflow-y:auto;padding:20px;border-radius:15px;z-index:5;position:absolute;width:100%;height:100%;background:#fff;top:0;left:0;">
        <div class="friend-avatar" style="border-radius:15px 15px 0 0;z-index:10;background-image:linear-gradient(#fff, rgba(255,255,255,0.5));padding: 10px 0;position:absolute;top:0;left:50%;transform:translateX(-50%);width:100%;height:95px;">
            <div class="return" id="return" style="position:absolute;left:7%;top:50%;transform:translateY(-50%);"><i class="fa-solid fa-arrow-left" style="color:gray;cursor:pointer;font-size:1.7em;"></i></div>
            <div class="image" style=";width:50px;height:50px;;text-align:center;position:absolute;transform:translateX(-50%);left:50%;"><img style="width:100%;border-radius:50%;height:100%;object-fit:cover;" src="images/blank_avatar.png"></div>
            <div class="name" style="position:absolute;bottom:10px;left:50%;transform:translateX(-50%);"><span>${name}</span></div>
        </div>
        <div id="message-wrapper" style="padding: 0 0 40px 0;position:absolute;bottom:50px;width:calc(100% - 40px);max-height:calc(100% - 120px);overflow-y:scroll;">
            
        </div>
        <div id="scroll-down" style="position: absolute;bottom:70px;left:50%;transformX(-50%);cursor:pointer;"><i class="fa-solid fa-arrow-down" style="color:#000;font-size:1.2em;"></i></div>
        <div class="user-input" style="border-radius:0 0 15px 15px;z-index:10;background:#fff;position:absolute;bottom:0;left:0;width:100%;height:50px;">
            <input type="text" id="input" placeholder="Say something.." style="padding:7px 5px;font-size:.9em;width:calc(100% - 40px);position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);border-radius:4px;border:1px solid gray;">
        </div>
    </div>`)
    function scr() {
        $.ajax({
            type: 'POST',
            url: 'get_last_id.php',
            success: function(response){
                let id = parseInt(response);
                document.getElementById("message" + id).scrollIntoView();
            }
        })
    }
    
    document.getElementById("scroll-down").addEventListener("click", function(){
        $.ajax({
            type: 'POST',
            url: 'get_last_id.php',
            success: function(response){
                let id = parseInt(response);
                document.getElementById("message" + id).scrollIntoView();
            }
        })
    })

    document.getElementById("input").addEventListener("keypress", function(event){
        if (event.keyCode === 13) {
            var message = $("#input").val();
            let user = localStorage.getItem("user"); //chosen person username..
            $.ajax({
                type: 'POST',
                url: 'storeconvo.php',
                data: { 
                    message : message,
                    user : user,
                    messagefrom: messagefrom
                },
                success: function(){
                    $.ajax({
                        type: 'POST',
                        url: 'messages.php',
                        data: {
                            message: message,
                            user: user,
                            messagefrom: messagefrom
                        }
                    })
                }
            })
            document.getElementById("input").value = "";
            scr();
        }
    })
    
    function test(){
        scr();
        setInterval(() => {
            var req = new XMLHttpRequest();
            req.onload = function(){
                document.getElementById("message-wrapper").innerHTML = this.responseText;
            }
            req.open("GET", "retrieve.php");
            req.send();
        }, 100);
    }
    test();
    
    document.getElementById("return").addEventListener("click", function(){
        $(".chat-wrapper").remove();   
    })
}

$(".user-container").click(function(){
    let username = $(this).children("div.username").html();
    let name = $(this).children("div.user").html();
    start_chatting(username, name);
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
    });
}
//update status to online
function load(){
    $.ajax({
        type: 'POST',
        url: 'online.php',
    });
}
//refresh page..

document.getElementById("refresh").addEventListener("click", function(){
    location.reload();
})

setInterval(() => {
    $.ajax({
        type: 'POST',
        url: 'message_notif.php',
        success: function(res){
            x = parseInt(res);
            if (x > 0) {
                $("#message-notif").css("display", "block");
            }
            else {
                $("#message-notif").css("display", "none");
            }
        }
    })
}, 100);

var interv;
function start_notification(){
    interv = setInterval(new_messages, 100);
    function new_messages(){
        let req = new XMLHttpRequest();
        req.onload = function(){
            document.getElementById("message-notif").innerHTML = this.responseText;
        }
        req.open("GET", "message_notif.php");
        req.send();
    }
}

start_notification();



document.getElementById("message-tab").addEventListener("click", function(event){

    this.style.background = "rgb(51, 50, 50)";
    $(".fa-brands").css("color", "rgb(202, 201, 201)");
    $("#message-notif").css("border-color", "rgb(51, 50, 50)");
    $("#active").css("background","rgb(202, 201, 201)");
    $("#active").css({
        "color" : "rgb(51, 50, 50)",
    });
    $(".message-tab-content").remove();
    $('.active-people-content').remove();
    document.getElementById("container").insertAdjacentHTML("afterbegin", `
    <div class="message-tab-content" id="message-tab-content"></div>`);
    $.ajax({
        type: 'POST',
        url: 'message_tab_content.php',
        success: function(res){
            $("#message-tab-content").append(res);
            $(".user-container").click(function(){
                let username = $(this).children("div.username").html();
                let name = $(this).children("div.user").html();
                start_chatting(username, name);
            })
        }
    })
    
    
})
document.getElementById("active").addEventListener("click", function(){
    document.getElementById("message-tab").style.background = "rgb(202, 201, 201)";
    $(".fa-brands").css("color", "rgb(51, 50, 50)");
    $("#message-notif").css("border-color", "rgb(202, 201, 201)");
    $("#active").css("background","rgb(51, 50, 50)");
    $("#active").css({
        "color" : "rgb(202, 201, 201)",
        "font-weight" : "bold",
    });
    $(".message-tab-content").remove();
    $('.active-people-content').remove();
    document.getElementById("container").insertAdjacentHTML("afterbegin", `
    <div class="active-people-content" id="active-people-content"></div>`);
    $.ajax({
        type: 'POST',
        url: 'active_people_content.php',
        success: function(res){
            $("#active-people-content").append(res);
            $(".user-container").click(function(){
                let username = $(this).children("div.username").html();
                let name = $(this).children("div.user").html();
                start_chatting(username, name);
            })
        }
    })
})