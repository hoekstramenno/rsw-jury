import Chart from "chart.js";
import { axios } from "../../app";

let url = window.location.pathname;

const scores = document.querySelectorAll('.rating-category-score');


scores.forEach(function (score) {

    let canvas = score.querySelector('canvas');

    axios.get('/' + url.split('/')[1] + '/stats/category/' + canvas.getAttribute('data-category'))
        .then(function (response) {
            // handle success
            canvas.getContext('2d');

            new Chart(canvas, {
                type: 'horizontalBar',
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

});




