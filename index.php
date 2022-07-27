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
                    <img src="assets/img/pixonauta-logo-04.png" alt="Angel Mavare Logo" style="max-width:200px;">
                    
                </a>
            </header>

            <div class=" bg-light rounded-3" style="background: url('assets/img/gitcommandsbg.jpg'); background-size: cover;background-position:center;">
                <div class="p-5 mb-4" style="background:rgba(0,0,0,0.3); ">
                    <div class="container-fluid py-5">
                        <img src="assets/img/cardanologowhite.svg" alt="Cardano logo" style="max-width:200px;">
                        <h1 class="display-5 fw-bold text-white">{{ tittle }}</h1>
                        <p class="col-md-8 fs-4 text-white"></p>
                        <!-- <button class="btn btn-primary btn-lg" type="button">Example button</button> -->
                    </div>
                </div>
                
            </div>
    <?php echo $dir = dirname(__FILE__); ?>
            <div class="row pt-4 pb-4">
                <div class="col-md-6">
                    <form action="">
                        <h4 class="alert-heading">Scanner</h4>
                        <p>Write your wallet address to retrieve info about it</p>
                        <hr>
                        <div class="mb-3 row">
                            <label for="height" class="col-sm-3 col-form-label">Wallet address</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="wallet" v-model="wallet" >
                            </div>
                        </div>
                        
                        <div class="mb-3 row">

                            <div class="col-sm-10">
                                <a class="btn btn-primary" href="#" v-on:click="searchWallet" >Search <i class="bi bi-search"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div v-if="seenResults" class="alert alert-success" role="alert">
                        <h4  id="results" class="alert-heading pb-3">Results</h4>
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

    <?php $current_url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
    <script>
        const { createApp } = Vue

        createApp({
            data() {
                return {
                    message: '',
                    wallet: '',
                    url: window.location.href,
                    updateFooter: new Date().getFullYear()
                }
            },
            methods: {
                async searchWallet(e) {
                    e.preventDefault();
                    //console.log("hola");
                    if(this.wallet != ''){
                        fetch(`${this.url}/api/index.php?wallet=${this.wallet}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data.controlled_amount)
                        }
                            
                        
                        );
                    }else{
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