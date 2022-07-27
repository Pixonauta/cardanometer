
<?php

if(isset($_REQUEST['wallet'])){

    $wallet = $_REQUEST['wallet'];

    $addressType = substr($wallet, 0, 4);

    if($addressType == 'stak'){
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

    }else if($addressType == 'addr'){
        //First call to retrieve address info and stake address
        //$wallet = 'addr1q808ygdhtuktxszj7rvfctfhcpfhdwepq669d0ue9a5cgvxfmlyy4hu3mv28d9zzz7quhtffkvxmwq0084gjm5a6lujqays40k';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://cardano-mainnet.blockfrost.io/api/v0/addresses/'.$wallet); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $headers = array(
            "project_id: mainnetUTxDXTg2MuJ7x8GKW63roI86vmmGFvDP"
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        $data = curl_exec($ch); 
        curl_close($ch); 

    
        $stake_address_decode = json_decode($data);
        $stake_address = $stake_address_decode->stake_address;
        
        //Second call to retrieve full ada amount from stake address
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://cardano-mainnet.blockfrost.io/api/v0/accounts/'.$stake_address); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $headers = array(
            "project_id: mainnetUTxDXTg2MuJ7x8GKW63roI86vmmGFvDP"
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        $data2 = curl_exec($ch); 
        curl_close($ch); 


        echo $data2;
        /* foreach($stake_address_obj as $el){
            echo $el;
        } */
        

       /*  $stake_address = json_decode(json_encode($data));

        echo $stake_address; */
    }

    

    
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