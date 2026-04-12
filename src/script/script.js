document.getElementById("userForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("api/submit.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert("User added!");
        form.reset(); 
    })
    .catch(err => console.error(err));
});
