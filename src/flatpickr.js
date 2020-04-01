window.flatpickr = require('flatpickr');
const el = document.getElementById('offerform-launch_date');

if (el) {
    flatpickr(el, {
        "enable": [
            function (date) {
                return (date.getDay() === parseInt(document.querySelectorAll('[app-base-config="launch_day"]')[0].value))
            }
        ],
        "locale": {
            "firstDayOfWeek": 1 // start week on Monday
        }
    });
}