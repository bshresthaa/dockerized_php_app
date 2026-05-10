document.getElementById("userLogin").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("../auth/loginfunctions.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success"){ 
            window.location.href = "/admin/view.php"; 
        }else{ 
            document.getElementById("errorMsg").innerText = data.message; 
        }
        this.reset();  
    })
    .catch(err => console.error("Error", err));
});


