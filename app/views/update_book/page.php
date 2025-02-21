<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./app/views/adding_book/style.css">
    <title>update Book</title>
    
</head>
<body>
    <form id="myForm" 
    >
        <label for="isbn"> ISBN of the book: </label>
        <input id="isbn" name="isbn" type="text" readonly> <br>

        <label for="stock"> Stock of the book: </label>
        <input id="stock" name="stock"  type="number" max="1000" min="1" required><br>

        <label for="title"> Title of the book: </label>
        <input id="title" name="title" type="text" required><br>

        <label for="price"> Price of the book: </label>
        <input id="price" name="price" type="number" min="0" required><br>

        <label for="year"> Publication year: </label>
        <input id="year" name="year" type="number" min="1901" max="2025" required><br>

        <button type="submit">Update</button>
    </form>
    <script>
        document.getElementById("myForm").addEventListener("submit",function(event){
            event.preventDefault();
      
            let formData = new FormData(this);
    let jsonObject = {};
    
    formData.forEach((value, key) => {
        jsonObject[key] = value;
    });

    // Wrap the form data inside another object with key "form"
    let requestBody = JSON.stringify({ updateForm: jsonObject });

            let xhr=new XMLHttpRequest();
            xhr.open("POST",'index.php',true);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.onreadystatechange=function(){
                if(xhr.readyState==4&&xhr.status==200){
                    console.log(xhr.responseText);
                    let response = JSON.parse(xhr.responseText);
                    if(response["message"]=="success"){
                        alert("updateing success");
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
    window.onload= function (){
        let book = getQueryParam("book");
        document.getElementById('isbn').value=book.isbn;
        document.getElementById('title').value=book.title;
        document.getElementById('year').value=book.publication_year;
        document.getElementById('price').value=book.price;
        document.getElementById('stock').value=book.stock;

    }
    // Function to get query parameters
function getQueryParam(param) {
    let urlParams = new URLSearchParams(window.location.search);
// Get and decode the book object
let bookEncoded = urlParams.get(param);
console.log(bookEncoded)
if (bookEncoded) {
    try {
        let book = JSON.parse(decodeURIComponent(bookEncoded));
        console.log("Received Book:", book);
        return book;
    } catch (error) {
        console.error("Error decoding book data:", error);
    }
}
}
    </script>
</body>
</html>