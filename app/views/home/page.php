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
                let books = response["books"]; // JSON of books list 
                let viewSection = document.getElementById("view_section");

                // Clear existing content before appending new books
                viewSection.innerHTML = "";

                for (let book of books) {
                    // Create a new book container
                    let bookDiv = document.createElement("div");
                bookDiv.innerHTML= `
            <p>
    <span class="sp">ISBN: ${book.isbn}</span>
    <span class="sp">Title: ${book.title}</span>
    <span class="sp">Price: ${book.price}</span>
    <span class="sp">Stock: ${book.stock}</span>
    <span class="sp">Publish year: ${book.publication_year}</span>
</p>

<div class="button-container">
    <button class="edit-btn" data-book='${JSON.stringify(book)}' onclick='editBook(this)'>Edit</button>
    <button class="delete-btn" onclick="deleteBook('${book.isbn}')">Delete</button>
</div>

<hr>`;

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
function editBook(button) {
    let book = JSON.parse(button.getAttribute("data-book"));
    let encodedBook = encodeURIComponent(JSON.stringify(book));
    console.log(book);
    console.log(encodedBook);
    window.location.href = `index.php?page=update_page&book=${encodedBook}`;
}

function deleteBook(isbn) {
    // Implement delete functionality here
    console.log("start deleting");
    let requestBody = JSON.stringify({ delete_isbn: isbn });
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'index.php', true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            let response = JSON.parse(xhr.responseText);
            if (response["message"] == "success") {
                alert("book deleted");
                getAllBooks()
        }else {
                let message = response["message"] ?? "There is no message in the response";
                alert(`${message}`);
                console.log(response);
            }
    }
}
xhr.send(requestBody);
}

</script>
    </body>
</html>