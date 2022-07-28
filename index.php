<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/Pixonauta-Logo-fav.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Cardanometer</title>
</head>

<body>
    <div class="main" id="app">


        <div class="container pt-2">
            <header class="pb-2 mb-2 border-bottom">
                <nav class="navbar navbar-expand-lg bg-transparent">
                    <div class="container-fluid">
                        <a href="https://pixonauta.com/" class="d-flex align-items-center text-dark text-decoration-none">
                            <img src="assets/img/pixonauta-logo-04.png" alt="Pixonauta Logo" style="max-width:150px;">

                        </a>

                        <div class=" justify-content-end" id="navbarNavDropdown">
                            <ul class="navbar-nav">

                                <li class="nav-item">
                                    <button disabled class="nav-link btn btn-outline-dark link-secondary px-3" aria-current="page" href="#"><strong>ADA Price:</strong> ${{ adaPrice }}</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        </div>


        <div class="container py-4">

            <div class="glass-container bg-light rounded-3 " style="background: url('assets/img/bluebg2.jpg'); background-size: cover;background-position:center;">
                <!-- <div class="overlay"></div> -->
                <div class=" p-5 mb-4" style="background:rgba(0,0,0,0.0); border-radius:5px">
                    <div class="container-fluid py-5">
                        <img src="assets/img/cardanologowhite.svg" alt="Cardano logo" class="d-block mx-auto mb-3" style="max-width:150px;">
                        <h1 class="display-5  text-white mx-auto text-center mb-4">Cardanometer</h1>
                        <p class="col-md-12 fs-4 text-white text-center">Write your wallet address to retrieve info about it</p>
                        <div class="input-group mb-3 col-md-12">
                            <input type="text" id="wallet" v-model="wallet" class="form-control" placeholder="Type your Cardano wallet address" aria-label="Wallet address" aria-describedby="searchButton">
                            <a class="btn btn-primary" type="button" id="searchButton" href="#" v-on:click="searchWallet">Search
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-white pt-4" style="vertical-align:top;" v-html="walletInfo">


                            </div>
                            <div class="col-md-6 text-white pt-4" style="vertical-align:top;" v-html="walletScore">


                            </div>
                        </div>


                    </div>
                </div>

            </div>

            <div class="row pt-4 pb-4">

                <div class="col-md-6">
                    <div v-if="seenResults" class="alert alert-success" role="alert">
                        <h4 id="results" class="alert-heading pb-3">Results</h4>
                        <hr>
                        <ul class="sizeList">
                            <li> </li>

                            <li></li>

                        </ul>
                        <p v-html="message"></p>
                    </div>
                </div>
            </div>

            <div class="row align-items-md-stretch">
                <div class="col-md-6">
                    <div class="h-100 p-5 text-white bg-dark rounded-3">
                        <h2>About us</h2>
                        <p>Pixonauta is a blog responsible for disseminating information in Spanish and English about the world of technology for free.</p>
                        <a target="_blank" href="https://pixonauta.com/" class="btn btn-outline-light" type="button">Go to blog</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="h-100 p-5 bg-light border rounded-3">
                        <h2>Follow us on Twitter</h2>
                        <p>Find out about our publications through our twitter</p>
                        <a target="_blank" href="https://twitter.com/pixonauta" class="btn btn-outline-secondary" type="button">Go to Twitter</a>
                    </div>
                </div>
            </div>

            <footer class="pt-3 mt-4 text-muted border-top">
                © Copyright {{ updateFooter }}, Pixonauta
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <?php $current_url = "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    message: '',
                    wallet: '',
                    walletInfo: '',
                    walletScore: '',
                    adaPrice: '',
                    decoration: 'score-decoration',
                    url: window.location.href,
                    updateFooter: new Date().getFullYear()
                }
            },
            methods: {
                async searchWallet(e) {
                    e.preventDefault();
                    //console.log("hola");
                    if (this.wallet != '') {

                        axios
                            .get(`${this.url}/api/index.php?wallet=${this.wallet}`)
                            .then(response => {
                                if (response.data.status == 'success') {
                                    let allDataWallet = JSON.parse(response.data.info);
                                    let controlled_amount = ((allDataWallet.controlled_amount) / 1000000).toFixed(2);
                                    let rewards = ((allDataWallet.withdrawable_amount) / 1000000).toFixed(2);
                                    let pool_id = allDataWallet.pool_id;

                                    let dollar_amount = (controlled_amount * this.adaPrice).toFixed(2);
                                    let dollar_rewards = (rewards * this.adaPrice).toFixed(2);

                                    console.log(allDataWallet)
                                    this.walletInfo = `<p style="max-width:100%"><span style="font-size:1.5em; color:orange"><strong>Total ADA:</strong> ${controlled_amount} ₳ ($${dollar_amount})</span><br>
                                            <strong>Rewards available:</strong> ${rewards} ₳ ($${dollar_rewards})<br>
                                            </p>`;





                                    if (controlled_amount >= 1 && controlled_amount < 10) {
                                        this.walletScore = `<p class="score-text">Seahorse</p>`
                                    }
                                    if (controlled_amount >= 10 && controlled_amount < 25) {
                                        this.walletScore = `<p class="score-text">Pipefish</p>`
                                    }
                                    if (controlled_amount >= 25 && controlled_amount < 100) {
                                        this.walletScore = `<p class="score-text">Shrimp</p>`
                                    }
                                    if (controlled_amount >= 100 && controlled_amount < 500) {
                                        this.walletScore = `<p class="score-text">Shell</p>`
                                    }
                                    if (controlled_amount >= 500 && controlled_amount < 1000) {
                                        this.walletScore = `<p class="score-text">Oyster</p>`
                                    }
                                    if (controlled_amount >= 1000 && controlled_amount < 2000) {
                                        this.walletScore = `<p class="score-text">Starfish</p>`
                                    }
                                    if (controlled_amount >= 2000 && controlled_amount < 5000) {
                                        this.walletScore = `<p class="score-text">Crab</p>`
                                    }
                                    if (controlled_amount >= 5000 && controlled_amount < 10000) {
                                        this.walletScore = `<p class="score-text">Fish</p>`
                                    }
                                    if (controlled_amount >= 10000 && controlled_amount < 50000) {
                                        this.walletScore = `<p class="score-text">Jellyfish</p>`
                                    }
                                    if (controlled_amount >= 50000 && controlled_amount < 100000) {
                                        this.walletScore = `<p class="score-text">Piranha</p>`
                                    }
                                    if (controlled_amount >= 100000 && controlled_amount < 150000) {
                                        this.walletScore = `<p class="score-text">Swordfish</p>`
                                    }
                                    if (controlled_amount >= 150000 && controlled_amount < 400000) {
                                        this.walletScore = `<p class="score-text">Octopus</p>`
                                    }
                                    if (controlled_amount >= 400000 && controlled_amount < 750000) {
                                        this.walletScore = `<p class="score-text">Shark</p>`
                                    }
                                    if (controlled_amount >= 750000 && controlled_amount < 1000000) {
                                        this.walletScore = `<p class="score-text">Tiger Shark</p>`
                                    }
                                    if (controlled_amount >= 1000000 && controlled_amount < 5000000) {
                                        this.walletScore = `<p class="score-text">Great White Shark</p>`
                                    }
                                    if (controlled_amount >= 5000000 && controlled_amount < 10000000) {
                                        this.walletScore = `<p class="score-text">Orca</p>`
                                    }
                                    if (controlled_amount >= 10000000 && controlled_amount < 50000000) {
                                        this.walletScore = `<p class="score-text">Whale</p>`
                                    }
                                    if (controlled_amount >= 50000000 && controlled_amount < 100000000) {
                                        this.walletScore = `<p class="score-text">Fin Whale</p>`
                                    }
                                    if (controlled_amount >= 100000000 && controlled_amount < 250000000) {
                                        this.walletScore = `<p class="score-text">Blue Whale</p>`
                                    }
                                    // this.walletInfo = allDataWallet
                                } else {
                                    this.walletInfo = `<p class=" text-center" style="color:orange; font-size:1.2em;">${response.data.message}</p>`;
                                    this.walletScore = ``;
                                }


                            }).catch(error => console.log(error));


                        /* fetch(`${this.url}/api/index.php?wallet=${this.wallet}`)
                        .then(response => response.json())
                        .then(data => {
                                let allDataWallet = JSON.stringify(data);
                                let controlled_amount = (data.controlled_amount)/1000000;
                                let rewards = (data.withdrawable_amount)/1000000;
                                let pool_id = data.pool_id;

                                console.log(data)
                                this.walletInfo = `<p><strong>Total ADA:</strong> ${controlled_amount} ₳<br>
                                <strong>Rewards available:</strong> ${rewards} ₳<br>
                                <strong>Pool ID:</strong>  ${pool_id} <br></p>`;
                                //this.walletInfo = allDataWallet
                            }
                        ).catch(error => {
                            console.log('<p class="text-red text-center">We have a problem with your wallet search<p>');
                            this.walletInfo = `<p class="text-red text-center">We have a problem with your wallet search<p>`;

                        }); */

                    } else {
                        this.walletInfo = `<p class=" text-center" style="color:orange; font-size:1.2em;">Type your wallet</p>`;
                        this.walletScore = ``;
                    }



                    /* axios
                    .get("http://localhost/pixonauta/cardanometer/api/index.php?", {
                        params: {
                        action: 12345
                        }
                    })
                    .then(function (response) {
                        console.log(response);
                    }); */
                }
            },
            mounted() {

                axios
                    .get(`https://api.coinbase.com/v2/prices/ada-usd/buy`)
                    .then(response => {
                        console.log(response.data.data);
                        this.adaPrice = response.data.data.amount;
                        console.log(this.adaPrice);
                    });
            }
        }).mount('#app')
    </script>

</body>

</html>