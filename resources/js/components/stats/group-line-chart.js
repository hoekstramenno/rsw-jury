import { axios, Chart } from "../../app";

document.addEventListener("DOMContentLoaded", function (event) {

    let url = window.location.pathname;
    let parts = url.split('/');
    let groupId = parts[parts.length - 1];
    axios.get('/stats/group/' + groupId + '/category/7')
        .then(function (response) {
            // handle success
            let canvas = document.querySelector('.scores').getContext('2d');
            new Chart(canvas, {
                type: 'line',
                data: {
                    labels: ['slayer', 'slayer'],
                    datasets: {
                        "label": [
                            "Identiteit",
                            "Expressie",
                            "Uitdagende Scoutingtechnieken: kamperen",
                            "Veilig & Gezond",
                            "Uitdagende Scoutingtechnieken: knopen",
                            "Sport en Spel",
                            "Uitdagende Scoutingtechnieken: tocht",
                            "Buitenleven",
                            "Internatonaal",
                            "Geen categorie",
                            "Bonus",
                        ],
                        "backgroundColor": ["#80fbb7", "#8c4d7b", "#3dcfcf", "#916720", "#b850a8", "#39d749", "#dc6e82", "#c2c6eb", "#b8e0ba", "#7721f7", "#0f0fdd"],
                        "data": [1, 5, 5, 4, 2, 7, 4, 1, 1, 1, 1]
                    },
                },
                options: {}
            });
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
});
