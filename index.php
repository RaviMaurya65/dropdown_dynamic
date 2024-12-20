<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Dropdowns</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 card" style="
    width: 500px;
    padding: 50px;
">
        <h2 class="text-center mb-4">Dynamic Dependent Dropdowns</h2>
        <div class="row ">
            <div class="col-md-12">
                <label for="country" class="form-label">Country</label>
                <select id="country" name="country" class="form-select">
                    <option value="">Select Country</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="state" class="form-label">State</label>
                <select id="state" name="state" class="form-select">
                    <option value="">Select State</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="city" class="form-label">City</label>
                <select id="city" name="city" class="form-select">
                    <option value="">Select City</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Load countries on page load
            fetch('fetch_countries.php')
                .then(response => response.json())
                .then(countries => {
                    let options = '<option value="">Select Country</option>';
                    countries.forEach(country => {
                        options += `<option value="${country.id}">${country.name}</option>`;
                    });
                    document.getElementById('country').innerHTML = options;
                });

            // Fetch states on country change
            document.getElementById('country').addEventListener('change', function () {
                const countryId = this.value;

                if (countryId) {
                    fetch('fetch_states.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `country_id=${countryId}`
                    })
                        .then(response => response.json())
                        .then(states => {
                            let options = '<option value="">Select State</option>';
                            states.forEach(state => {
                                options += `<option value="${state.id}">${state.name}</option>`;
                            });
                            document.getElementById('state').innerHTML = options;
                        });
                } else {
                    document.getElementById('state').innerHTML = '<option value="">Select State</option>';
                    document.getElementById('city').innerHTML = '<option value="">Select City</option>';
                }
            });

            // Fetch cities on state change
            document.getElementById('state').addEventListener('change', function () {
                const stateId = this.value;

                if (stateId) {
                    fetch('fetch_cities.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `state_id=${stateId}`
                    })
                        .then(response => response.json())
                        .then(cities => {
                            let options = '<option value="">Select City</option>';
                            cities.forEach(city => {
                                options += `<option value="${city.id}">${city.name}</option>`;
                            });
                            document.getElementById('city').innerHTML = options;
                        });
                } else {
                    document.getElementById('city').innerHTML = '<option value="">Select City</option>';
                }
            });
        });
    </script>
</body>
</html>
