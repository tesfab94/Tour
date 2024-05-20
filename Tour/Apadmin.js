document.getElementById("userDataForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission

    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;

    // Perform data validation and confirmation logic
    // You can send the data to a server, update the UI, or perform other actions here

    alert("User data confirmed!");
});