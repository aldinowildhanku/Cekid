<?php
//error
//error_1 = id character tidak ketemu
//error_server = response curl saat ambil username tidak muncul
function waktu(){
  date_default_timezone_set('Asia/Jakarta');
  $waktu = date("n/j/Y-1440");
  $waktu = urlencode($waktu);
  return $waktu;
}
function random($panjang){
    $random = rand(1000000000,1000000000000).$_SERVER['REMOTE_ADDR'];
    $dst    = substr(md5($random), 0, $panjang);
    return $dst;
}
function cookie_per_user($target_id){
    return md5($target_id);
}
function curl($link, $headers = NULL, $post = NULL, $target_id = NULL){
    $ch = curl_init();
    //headers
    if($headers != NULL){
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    //post
    if($post != NULL){
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    //cookie
    if($target_id != NULL){
        $cookie_per_user = cookie_per_user($target_id);
        curl_setopt($ch, CURLOPT_COOKIEJAR, "./cookie/$cookie_per_user.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, "./cookie/$cookie_per_user.txt");
    }
  //basic
    curl_setopt($ch, CURLOPT_URL, $link);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}


if(@$_POST['user_id'] && @$_POST['server_id'] != NULL){
    $target_id = $_POST['user_id'];
    $zoneid = $_POST['server_id'];
    $server = $_POST['server'];
    $target_id = urlencode($target_id);
    $zoneid = urlencode($zoneid);
    $headers[] = "accept: application/json, text/plain, */*";
    $headers[] = "accept-language: id-ID";
    $headers[] = "content-type: application/x-www-form-urlencoded; charset=UTF-8";
    $headers[] = "origin: https://www.codashop.com";
    $headers[] = "referer: https://www.codashop.com/";
    $headers[] = "sec-ch-ua-mobile: ?0";
    $headers[] = "sec-fetch-dest: empty";
    $headers[] = "sec-fetch-mode: cors";
    $headers[] = "sec-fetch-site: same-site";
    $headers[] = "user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36";
    $headers[] = "x-session-country2name: ID";
    $headers[] = "x-session-key";
    $random_1 = random('5');
    $waktu = waktu();
    $query = "voucherPricePoint.id=90641&voucherPricePoint.price=48507.0&voucherPricePoint.variablePrice=0&n=$waktu&email=din0812$random_1%40store.com&userVariablePrice=0&order.data.profile=eyJuYW1lIjoiICIsImRhdGVvZmJpcnRoIjoiIiwiaWRfbm8iOiIifQ==&user.userId=$target_id&user.zoneId=$zoneid&msisdn=0213829389&voucherTypeName=MOBILE_LEGENDS&voucherTypeId=5&gvtId=19&shopLang=id_ID&checkoutId=658949d7-d998-462e-9988-c298d735642f&affiliateTrackingId=&impactClickId=&anonymousId=0070f667-d075-4559-b6e5-77090a6c6453&fullUrl=https%3A%2F%2Fwww.codashop.com%2Fid-id%2Fmobile-legends&userSessionId=YWxkaW5vd2lsZGhhbjFAZ21haWwuY29t&userEmailConsent=true&userMobileConsent=true&verifiedMsisdn=&promoId=&promoCode=&clevertapId=54a323c67fe14597af0518dd65468e89&promotionReferralCode=";
    $link = 'https://order-sg.codashop.com/initPayment.action';
    $curl = curl($link, $headers, $query);
    if(preg_match('/(username|invalid)/i',$curl)){
        //cek error
        if(preg_match('/username/',$curl)){
            $js = json_decode($curl,true);
            $character = $js['confirmationFields']['username'];
            if($character != NULL){
                $json = array(
                                "status" => "ok",
                                "nama" => urldecode($character),
                                "id" => $target_id
                               );
            
            }else{
                $json = array("status" => "error_1");
             
            }
        }else{
          $json = array("status" => "error_1");
     
        }
    }else{
        $json = array("status" => "error_server");
   
    }
    echo json_encode($json);
}

?>