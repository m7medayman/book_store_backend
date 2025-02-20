<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./app/views/adding_book/style.css">
    <title>Adding Book</title>
    
</head>
<body>
    <form id="addForm" 
    method="GET" title="Adding Book" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="isbn"> ISBN of the book: </label>
        <input id="isbn" name="isbn" type="text" required> <br>

        <label for="stock"> Stock of the book: </label>
        <input id="stock" name="stock"  type="number" max="1000" min="1" required><br>

        <label for="title"> Title of the book: </label>
        <input id="title" name="title" type="text" required><br>

        <label for="price"> Price of the book: </label>
        <input id="price" name="price" type="number" min="0" required><br>

        <label for="year"> Publication year: </label>
        <input id="year" name="year" type="number" min="1901" max="2025" required><br>

        <button type="submit">Submit</button>
    </form>
    <script>
        document.getElementById("addForm").addEventListener("submit",function(event){
            event.preventDefault();
            let formData=new FormData(this);

            let xhr=XMLHttpRequest();
            xhr.open("POST",`index.php?form=${form}`,true);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.onreadystatechange=function(){
                if(xhr.readyState==4&&xhr.stat){
                    let response = JSON.parse(xhr.responseText);
                    if(response["message"]=="success"){
                        alert("added success");
                }
                else{
                    let message= response["message"]??"there is no message in the response";
                    alert(`${message}`);
                    console.log(response);
                    
                }
            }

        }
        xhr.send(formData);
    })
    </script>
</body>
</html>