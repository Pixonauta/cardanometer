
<?php

if(isset($_REQUEST['wallet'])){

    $wallet = $_REQUEST['wallet'];

    

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://cardano-mainnet.blockfrost.io/api/v0/accounts/'.$wallet); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $headers = array(
        "project_id: mainnetUTxDXTg2MuJ7x8GKW63roI86vmmGFvDP"
     );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
    $data = curl_exec($ch); 
    curl_close($ch); 

    echo $data;
}

/* if(isset($_GET('action'))){
    echo json_encode('AQUI HAY ALGO '.$data);
} */
//$data = $_GET("action");
    


/* if (isset() {
    // do user authentication as per your requirements
    // ...
    // ...
    // based on successful authentication
    echo json_encode(array('success' => 1));
} else {
    echo json_encode(array('success' => 0));
}
 */
function getWallet(){
    echo "wallet success";
}

?>