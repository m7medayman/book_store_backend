<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./app/views/auth/style.css">
    <title>signup</title>
    
</head>
<body>
    <form id="signup_form" 
    >
        <label for="user"> User name: </label>
        <input id="user" name="user" type="text" required> <br>

        <label for="password"> password: </label>
        <input id="password" name="password"  type="password" required><br>


        <button type="submit">signup</button>
      <a href="#" style="color: grey; display: block; margin-top: 20px; text-align: center;" onclick="goTosignupPage(event)">
        go to login page
      </a>

      </button>

    </form>
    <script>
        document.getElementById("signup_form").addEventListener("submit",function(event){
            event.preventDefault();
      
            let formData = new FormData(this);
    let jsonObject = {};
    
    formData.forEach((value, key) => {
        jsonObject[key] = value;
    });

    // Wrap the form data inside another object with key "form"
    let requestBody = JSON.stringify({ signup_form: jsonObject });

            let xhr=new XMLHttpRequest();
            xhr.open("POST",'index.php',true);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.onreadystatechange=function(){
                if(xhr.readyState==4&&xhr.status==200){
                    console.log(xhr.responseText);
                    let response = JSON.parse(xhr.responseText);
                    if(response["message"]=="success"){
                        alert("adding success ");
                        window.history.back();
                }
                else{
                    let message= response["message"]??"there is no message in the response";
                    alert(`${message}`);
                    console.log(response);
                    
                }
            }

        }
        xhr.send(requestBody);
    })
    function goTosignupPage(){
        window.location.href = "index.php?page=login_page";
    }
    </script>
</body>
</html>