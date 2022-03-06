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


//view this.user profile
$(".profile").click(function(){
    document.getElementById("main").insertAdjacentHTML("afterbegin", `
    <div class="my-profile" id="my-profile" style="border-radius:15px;z-index:5;position:absolute;width:100%;height:100%;background:rgb(202, 201, 201);top:0;left:0;">
        <div id="return-from-self-profile" style="z-index:5;cursor:pointer;position:fixed;top:7%;left:7%;"><i class="fa-solid fa-arrow-left-long" style="color:rgb(51, 50, 50);font-size:1.5em;"></i></div>
        <div class="this-user-profile self-profile" id="this-user-profile" style="width:100%;height:200px;position:relative;box-shadow: 0 0 2px #000;">
            <div class="profile-wrapper" style="position:absolute;left:50%;top:80%;transform:translate(-50%, -80%);display:flex;flex-direction:column;height:140px;width:300px;">
                <div class="avatar" style="cursor:pointer;width:100px;height:100px;border:2px solid #fff;border-radius:50%;position:absolute;left:50%;transform:translateX(-50%);">
                    <img src="images/blank_avatar.png" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                    <i class="fa-solid fa-user-ninja" style="padding:5px;font-size:15px;background:#fff;"></i>
                </div>
                <div class="this-user-name" id="myname" style="text-align:center;padding:10px;width:200px;position:absolute;bottom:0;width:100%;"><span style="color:rgb(51, 50, 50);font-weight:bold;">john mark</span></div>
            </div>
        </div>
        <div class="self-info" id="self-info" style="width:100%;height:calc(100% - 200px);padding:30px 50px;">
            <span style="color:rgb(51, 50, 50);font-weight:bold;">Info:</span>
            <div class="links" style="padding: 30px 0 0 30px">
                <button id="add-link" style="margin-top:5px;width:100%;background:rgb(51, 50, 50);cursor:pointer;padding:7px 0;border-radius:4px;border:transparent;color:rgb(202, 201, 201);font-weight:bold;">Add link</button>
            </div>
        </div>
    </div>`);
    //add link
    $("button#add-link").click(function(){
        document.getElementById("my-profile").insertAdjacentHTML("afterbegin", `
        <div class="add-link-panel" style="position:fixed;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:6;">
            <div class="add-link-wrapper" style="width:90%;height:50%;background:rgb(202, 201, 201);position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);padding:40px;">
                <span style="font-weight:bold;color:rgb(51, 50, 50);">Link:</span>
                <div class="inputs" style="display:flex;flex-direction:column;">
                    <input type="text" id="name-of-link" placeholder="Name (facebook, insta..)" style="font-size:15px;padding:7px;border:1px solid transparent;border-radius:4px;margin:10px 0 5px;">
                    <input type="text" id="link" placeholder="Paste link here.." style="font-size:15px;padding:7px;border-radius:4px;border:1px solid transparent;margin:0 0 5px 0">
                    <button id="add-this-link" style="width:100%;background:rgb(51, 50, 50);cursor:pointer;padding:10px 0;border-radius:4px;border:transparent;color:rgb(202, 201, 201);font-weight:bold;">Add</button>
                </div>
            </div>
        </div>`);

        $(".add-link-panel").click(function(){
            this.remove();
        })
        $(".add-link-wrapper").click(function(event){
            event.stopPropagation();
            event.preventDefault();
        })
        $("#add-this-link").click(function(){
            let name = $("#name-of-link").val();
            let link = $("#link").val();
            document.getElementById("add-link").insertAdjacentHTML("beforebegin", `
            <div class="link">${name}</div>`);
            $(".add-link-panel").remove();
            
        })
    })
    //return
    setInterval(function(){
        let count_links = document.getElementsByClassName("link").length;
        if (count_links == 3) {
            $("#add-link").remove();
            clearInterval(this);
        }
    }, 100);

    document.getElementById("return-from-self-profile").addEventListener("click", function(){
        this.parentElement.remove();
    })
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

//change styles when click
$(".list").click(function(){
    $(".list").removeClass("active");
    $(".list").addClass("inactive");
    this.classList.remove("inactive");
    this.classList.add("active");
})


//message tab
document.getElementById("message-tab").addEventListener("click", function(event){
    $("#container").css("border-radius", "10px 0 10px 10px");
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

//group chat tab
document.getElementById("group-chat").addEventListener("click", function(){
    $("#container").css("border-radius", "10px 10px 10px 10px");
    $(".message-tab-content").remove();
    $('.active-people-content').remove();
})



//active people tab
document.getElementById("active").addEventListener("click", function(){
    $("#container").css("border-radius", "0 10px 10px 10px");
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