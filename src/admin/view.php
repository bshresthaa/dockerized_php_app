<?php
    session_start();

    if(!isset($_SESSION['user_id']) ){ 
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
</head>
   

<style>
    body{
        font-family:Arial, Helvetica, sans-serif; 
        background: url('../assets/weather.jpg'); 
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
    }
    #headers{ 
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        width: 100%;
        height: 40px; 
        
    }
    .logout{
        margin-left: auto;
    }

    #weather-form{ 
        display:flex; 
        justify-content: center;
    }


    #table{
        display:flex;
        justify-content: center;
        color:black;
    }
    .zipcode-div{ 
        display:flex;
        justify-content: center;
        padding: 20px;
    }
    .zipcode, .zipcode:focus{
        background:transparent;
        border: 1px grey solid;
    }

    h1, h2{
        text-align: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }
</style>
<body>



<div id="headers">
            <a href="/admin/js1.php" title="js fun">jsLearnSession1</a>
            <a href="../admin/view.php">Weather</a>
            <a href="../admin/view.php">Weather</a>
            <a href="../auth/logout_handler.php" class="logout">
                <button type = "logout" > Logout</button>
            </a> 
</div>
    

    <form id="weather-from">
    
        <h1>Search weather Status with zipcode</h1>

        <div class="zipcode-div">
           <label for="zipcode"> Zipcode: </label> 
            <input type="text" class="zipcode" name="zipcode" required>
        <button type="submit" title="search weather">Search</button>
        </div>
    </form> 

    <div id="table-container"></div>
</body>


<script>
async function getzipcode(zip) { 
    const url = `../api/zipcode.php?zipcode=${zip}`; 
    const result = await fetch(url); 
    const data = await result.json(); 
    if (!data.length) {
        alert("ZIP not found");
        return;
    }
    return data; 
}

document.getElementById("weather-from").addEventListener("submit", async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const zip = formData.get("zipcode");

    //Get coordinates
    let data = await getzipcode(zip); 
    const longitude = data[0].lon;
    const latitude = data[0].lat;


    const urlWeather = `https://api.weather.gov/points/${latitude},${longitude}`;

    const res = await fetch(urlWeather);
    const weatherData = await res.json();

    const forecastUrl = weatherData.properties.forecast;

    const forecastRes = await fetch(forecastUrl);
    const forecast = await forecastRes.json();
    
    const periods = forecast.properties.periods; 
    const tbody = document.getElementById("weather"); 

    let rows = "";
    periods.forEach(p => {
        rows += `
            <tr>
                <td>${p.name}</td>
                <td>${p.temperature}</td>
                <td>${p.probabilityOfPrecipitation.value ?? "N/A"}</td>
                <td>${p.detailedForecast}</td>
            </tr>
        `;
    });
    const table = `
            <table border="1px">
                <thead>
                    <tr>
                        <th>Period</th>
                        <th>Temperature</th>
                        <th>Precipitation %</th>
                        <th>Forecast</th>
                    </tr>
                </thead>
                <tbody>
                    ${rows}
                </tbody>
            </table>
        `;
    document.getElementById("table-container").innerHTML = table;
    tbody.innerHTML = rows;




});
</script>
</html>