document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('filtermake').addEventListener('change', function () {
        let make = this.value;
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '/get-models?make=' + make, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                let models = JSON.parse(xhr.responseText);
                let modelDropdown = document.getElementById('filtermodel');
                modelDropdown.innerHTML = '<option disabled selected>Select Model</option>';
                models.forEach(function (model) {
                    let option = document.createElement('option');
                    option.value = model;
                    option.text = model.toUpperCase();
                    modelDropdown.appendChild(option);
                });
            }
        };
        xhr.send();
    });
    document.getElementById('filtermodel').addEventListener('change', function () {
        let model = this.value;
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '/get-years?model=' + model, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                let years = JSON.parse(xhr.responseText);
                let yearDropdown = document.getElementById('yearfrom');
                yearDropdown.innerHTML =
                    '<option disabled selected>Year From</option>';
                years.forEach(function (year) {
                    let option = document.createElement('option');
                    option.value = year;
                    option.text = year;
                    yearDropdown.appendChild(option);
                });
            }
        };
        xhr.send();
    });
    document.getElementById('filtermodel').addEventListener('change', function () {
        let model = this.value;
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '/get-years?model=' + model, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                let years = JSON.parse(xhr.responseText);
                let yearDropdown = document.getElementById('yearto');
                yearDropdown.innerHTML =
                    '<option disabled selected>Year To</option>';
                years.forEach(function (year) {
                    let option = document.createElement('option');
                    option.value = year;
                    option.text = year;
                    yearDropdown.appendChild(option);
                });
            }
        };
        xhr.send();
    });
})