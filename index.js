//form functions..
$(".register a").click(function(){
    $(".register").css("display", "none");
    $(".login").show();
    $(".form input").val("");
})
$(".login a").click(function(){
    $(".login").css("display", "none");
    $(".register").show();
    $(".form input").val("");
})

    //register button function..
document.getElementById("register-confirm").addEventListener("click", function(){
    let name = document.getElementById("reg-name").value;
    let username = document.getElementById("reg-username").value;
    let password = document.getElementById("reg-password").value;

    if (name.length > 13) {
        alert("Name must not exceed 13 characters.");
    }
    else if (name == "" || username == "" || password == "") {
        alert("Input fields must be filled out.");
    }
    else {
        $.ajax({
            type: 'POST',
            url: 'register.php',
            data: {
                name: name,
                username: username,
                password: password
            },
            success: function(response){
                $("body").append(response);
                $(".register").css("display", "none");
                $(".login").show();
            }
        })
    }
})
       //login button function..
document.getElementById("login-confirm").addEventListener("click", function(){
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    if (username == "" || password == "") {
        alert("Input fields must be filled out.");
    }
    else {
        localStorage.setItem("username", username);
        $.ajax({
            type: 'POST',
            url: 'auth.php',
            data: {
                username: username,
                password: password
            },
            success: function(response){
                $("body").append(response);
            }
        })
    }
})
