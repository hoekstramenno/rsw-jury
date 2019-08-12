import Chart from "chart.js";
import { axios } from "../../app";
let url = window.location.pathname;
axios.get('/' + url.split('/')[1] + '/stats/ratio-category')
    .then(function (response) {
        // handle success
        var ctx = document.querySelector('.rating-categories').getContext('2d');
        console.log(response);
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: response.data.labels,
                datasets: [response.data.dataset]
            },
            options: response.data.options

        });
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });


