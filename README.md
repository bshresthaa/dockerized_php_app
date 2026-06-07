# Weather Forecast Application 🌦️

This project is a **Weather Forecast Application** that allows users to input a ZIP code, fetch the corresponding geographical coordinates, and display weather forecasts using the [National Weather Service API](https://www.weather.gov/documentation/services-web-api).

---

## Features ✨

- **ZIP Code Lookup**: Converts a ZIP code into geographical coordinates (latitude and longitude).
- **Weather Forecast**: Fetches and displays a detailed weather forecast for the given location.
- **Dynamic Table**: Displays the forecast data in a user-friendly table format.
- **Error Handling**: Alerts users if the ZIP code is invalid or if there are issues fetching data.

---

## Technologies Used 🛠️

- **HTML**: For the form and table structure.
- **CSS**: (Optional) For styling the application.
- **JavaScript**: For handling form submissions, API calls, and dynamically updating the DOM.
- **APIs**:
  - [National Weather Service API](https://www.weather.gov/documentation/services-web-api) for weather data.
  - Custom ZIP code API (`zipcode.php`) for converting ZIP codes to coordinates.

---

## How It Works ⚙️

1. **User Input**:
   - The user enters a ZIP code in the form and submits it.

2. **ZIP Code to Coordinates**:
   - The application sends the ZIP code to the `zipcode.php` API to retrieve the latitude and longitude.

3. **Weather Data Fetch**:
   - Using the coordinates, the application fetches weather data from the National Weather Service API.

4. **Forecast Display**:
   - The weather forecast is displayed in a table, including:
     - Time period (e.g., "Today", "Tonight").
     - Temperature.
     - Probability of precipitation.
     - Detailed forecast description.

---

## Installation & Setup 🖥️

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/weather-forecast-app.git
   cd weather-forecast-app
