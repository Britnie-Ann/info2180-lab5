// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Get the button and the result div
    const lookupBtn= document.getElementById('lookup');
    const resultDiv = document.getElementById('result');
    const cityLookupBtn = document.getElementById('citylookup');
    
    // Listen for clicks on the 'lookup' button
    lookupBtn.addEventListener('click', function() {
        // Get the country value from the user input (for example, a text field with id "country")
        const country = document.getElementById('country').value;

        // Use the Fetch API to send an AJAX request to world.php
        fetch(`world.php?country=${country}&lookup=countries`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Get the response as text
            })
            .then(data => {
                // Insert the response data into the result div
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                // Handle any errors that occur during the fetch
                resultDiv.innerHTML = 'Error: ' + error.message;
            });
    });

    //Listen for clicks on lookup cities button
    cityLookupBtn.addEventListener('click', function() {
        // Get the country value from the user input (for example, a text field with id "country")
        const country = document.getElementById('country').value;

        // Use the Fetch API to send an AJAX request to world.php
        fetch(`world.php?country=${encodeURIComponent(country)}&lookup=cities`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Get the response as text
            })
            .then(data => {
                // Insert the response data into the result div
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                // Handle any errors that occur during the fetch
                resultDiv.innerHTML = 'Error: ' + error.message;
            });
    });
});