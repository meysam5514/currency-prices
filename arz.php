<?php

error_reporting(0);
header('Content-type: application/json;');

function convertPersianToEnglish($string) {
$persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
$english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
 
$output= str_replace($persian, $english, $string);
return $output;
}
//========================================================= 
$get=file_get_contents("https://www.tgju.org/crypto");
//=========================================================1 
preg_match_all('#</span>
<span class="crypto-title">(.*?)</span>
</td>#',$get,$coin1);
//=========================================================1
preg_match_all('#<td data-field="grade">(.*?)</td>#',$get,$symbol1);
//=========================================================1
preg_match_all('#<td data-field="p-rial">
(.*?)</td>#',$get,$cost_rial);
//=========================================================1
preg_match_all('#<td data-field="market_cap">(.*?)</td>#',$get,$arzash_bazar1);
//=========================================================1
preg_match_all('#<td data-field="volume">(.*?)</td>#',$get,$hajm_bazar1);
//=========================================================1
preg_match_all('#<td data-field="d" class="change-cell high">
(.*?)
</td>#',$get,$change1);
//=========================================================2
preg_match_all('#<td data-field="dp" class="change-cell (.*?)">
(.*?)
</td>#',$get,$change_percent1);
//=========================================================1
preg_match_all('#<span class="currency-date">(.*?)</span>#',$get,$date1);
//=========================================================
preg_match_all('#<span class="currency-time"> (.*?)</span>
</td>#',$get,$time1);
//=========================================================
$coin=$coin1[1];
$symbol=$symbol1[1];
$cost_rial=$cost_rial[1];
$arzash_bazar=$arzash_bazar1[1];
$hajm_bazar=$hajm_bazar1[1];
$change=$change1[1];
$change_high_low=$change_percent1[1];
$change_percent=$change_percent1[2];
$date=$date1[1];
$time=$time1[1];
//========================================================= 
$resultcrypto = array();    
for($i=0;$i<=count($coin1[1])-1;$i++){
$resultcrypto[$i]['name']= $coin[$i];  
$resultcrypto[$i]['symbol']= $symbol[$i];    
$resultcrypto[$i]['cost_rial']= $cost_rial[$i];    
$resultcrypto[$i]['arzash_bazar']= $arzash_bazar[$i];    
$resultcrypto[$i]['hajm_bazar']= $hajm_bazar[$i];  
$resultcrypto[$i]['change']= $change[$i];  
$resultcrypto[$i]['change_high_low']= $change_high_low[$i];    
$resultcrypto[$i]['change_percent']= $change_percent[$i]; 
$resultcrypto[$i]['date']= convertPersianToEnglish($date[$i]); 
$resultcrypto[$i]['time']= convertPersianToEnglish($time[$i]); 
} 
//***************************************************************************
// ===== اگه مادرت برات محترمه منبع رو پاک نکن عزیزم ===== \
//***************************************************************************
$get1=file_get_contents("https://www.tgju.org/currency");
//=========================================================
preg_match_all('#<th><span class="mini-flag flag-(.*?)"></span>(.*?)</th>
<td class="nf">(.*?)</td>
<td class="nf"><span class="(.*?)">((.*?)) (.*?)</span></td>
<td>(.*?)</td>
<td>(.*?)</td>
<td>(.*?)</td>#',$get1,$price1);
//=========================================================
$resultarz = array();    
for($i=0;$i<=count($price1[2])-1;$i++){
$resultarz[$i]['name']= $price1[2][$i];  
$resultarz[$i]['tag']= $price1[1][$i];    
$resultarz[$i]['cost']= $price1[3][$i];    
$resultarz[$i]['change_high_low']= $price1[4][$i];   
$resultarz[$i]['change persent']= $price1[5][$i];  
$resultarz[$i]['change']= $price1[7][$i];  
$resultarz[$i]['low']= $price1[8][$i];  
$resultarz[$i]['high']= $price1[9][$i];    
$resultarz[$i]['date']= convertPersianToEnglish($price1[10][$i]); 
} 
//=========================================================

echo json_encode(['ok' => true, 'channel' => '@SIDEPATH','writer' => '@meysam_s71',  'Results' =>['crypto'=>$resultcrypto,'arz'=>$resultarz]], 448);


