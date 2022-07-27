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
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="assets/img/pixonauta-logo-04.png" alt="Angel Mavare Logo" style="max-width:150px;">

                </a>
            </header>

            <div class=" bg-light rounded-3 " style="background: url('assets/img/gitcommandsbg.jpg'); background-size: cover;background-position:center;">
                <div class="p-5 mb-4" style="background:rgba(0,0,0,0.3); ">
                    <div class="container-fluid py-5">
                        <img src="assets/img/cardanologowhite.svg" alt="Cardano logo" class="d-block mx-auto" style="max-width:150px;">
                        <h1 class="display-5  text-white mx-auto text-center mb-4">Cardanometer</h1>
                        <p class="col-md-12 fs-4 text-white text-center">Write your wallet address to retrieve info about it</p>
                        <div class="input-group mb-3 col-md-12">
                            <input type="text" id="wallet" v-model="wallet" class="form-control" placeholder="Type your Cardano wallet address" aria-label="Wallet address" aria-describedby="searchButton">
                            <a class="btn btn-secondary" type="button" id="searchButton" href="#" v-on:click="searchWallet">Search
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </a>
                        </div>

                        <div class="col-md-12 text-white pt-4" v-html="walletInfo">


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
                        <h2>About me</h2>
                        <p>here you can find information about me, my work and social networks.</p>
                        <a target="_blank" href="https://angelmavare.carrd.co" class="btn btn-outline-light" type="button">Go to info</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="h-100 p-5 bg-light border rounded-3">
                        <h2>Follow me on Twitter</h2>
                        <p>Stay up to date with the latest news from Vestigion: The Golden Button</p>
                        <a target="_blank" href="https://twitter.com/angelmavare1" class="btn btn-outline-secondary" type="button">Go to Twitter</a>
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
                    url: window.location.href,
                    updateFooter: new Date().getFullYear()
                }
            },
            methods: {
                async searchWallet(e) {
                    e.preventDefault();
                    //console.log("hola");
                    if (this.wallet != '') {

                            fetch(`${this.url}/api/index.php?wallet=${this.wallet}`)
                            .then(response => response.json())
                            .then(data => {
                                    let allDataWallet = JSON.stringify(data);
                                    let controlled_amount = (data.controlled_amount)/1000000;
                                    let rewards = (data.withdrawable_amount)/1000000;
                                    let pool_id = data.pool_id;

                                    console.log(data)
                                    this.walletInfo = `<strong>Total ADA:</strong> ${controlled_amount} ₳<br>
                                    <strong>Rewards available:</strong> ${rewards} ₳<br>
                                    <strong>Pool ID:</strong>  ${pool_id} <br>`;
                                    //this.walletInfo = allDataWallet
                                }
                            );
                        
                    } else {
                        console.log('Type your wallet');
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

            }
        }).mount('#app')
    </script>

</body>

</html>