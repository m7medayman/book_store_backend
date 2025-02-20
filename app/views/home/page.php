<!DOCTYPE html>
<html>
    <head>
        <title>
home 
        </title>
        <link rel="stylesheet" href="./app/views/home/style.css">
    </head>
    <body>
        <H1>
            home page
        </H1>
        <br>
        <hr>
        <div id="view_section"></div>
    <hr>
<div>
<button id="addButton"
onclick="goToAddPage()"
>
add book
        </button>
</div>
<script>
    
function goToAddPage(){

    window.location.href = "index.php?page=add_page";
}

    function getAllBooks() {
        console.log("start fetching");
    let requestBody = JSON.stringify({ get_books: true });
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'index.php', true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            let response = JSON.parse(xhr.responseText);
            
            if (response["message"] == "success") {
                alert("Added successfully");
                let books = response["books"]; // JSON of books list 
                let viewSection = document.getElementById("view_section");

                // Clear existing content before appending new books
                viewSection.innerHTML = "";

                for (let book of books) {
                    // Create a new book container
                    let bookDiv = document.createElement("div");
                    bookDiv.innerHTML = `ISBN: ${book["isbn"]} `;

                    // Create Edit Button
                    let editBtn = document.createElement("button");
                    editBtn.textContent = "Edit";
                    editBtn.onclick = function () {
                        editBook(book["isbn"]);
                    };

                    // Create Delete Button
                    let deleteBtn = document.createElement("button");
                    deleteBtn.textContent = "Delete";
                    deleteBtn.onclick = function () {
                        deleteBook(book["isbn"]);
                    };

                    // Append buttons to the book div
                    bookDiv.appendChild(editBtn);
                    bookDiv.appendChild(deleteBtn);

                    // Append book div to the view section
                    viewSection.appendChild(bookDiv);
                }
            } else {
                let message = response["message"] ?? "There is no message in the response";
                alert(`${message}`);
                console.log(response);
            }
        }
    };

    xhr.send(requestBody);
}
window.onload=getAllBooks();

// Example functions for editing and deleting books
function editBook(isbn) {
    alert(`Edit book with ISBN: ${isbn}`);
    // Implement edit functionality here
}

function deleteBook(isbn) {
    alert(`Delete book with ISBN: ${isbn}`);
    // Implement delete functionality here
}

</script>
    </body>
</html>