<?php
  //  $url = "https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=1";
  //  $xml = file_get_contents($url);
  //  $data = simplexml_load_string($xml);
  
  //  $updateTime = $data->DateTime; 
  //  $price = $data->Exrate; 
  //  foreach($price as $priceOk){
  //         $code = $priceOk['CurrencyCode'];
  //         $name = $priceOk['CurrencyName'];
  //         $buyPrice = $priceOk['Buy']; 
  //         $transferPrice = $priceOk['Transfer']; 
  //         $sell = $priceOk['Sell']; 
  //  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style>
  hr{
		border-top: 1px solid #dfe3e8;
	}
</style>
</head>
<body>
<div id="content" style="height: auto !important;">
  <div class="container" style="height: auto !important;">
    <div id="intro-widget" class="row">
      <div class="col-sm-12">
        <h3>
          <strong>Tỷ Giá Ngoại Tệ</strong>
        </h3>
      </div>
    </div>
    <hr>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>MÃ NGOẠI TỆ</th>
          <th>TÊN NGOẠI TỆ</th>
          <th>MUA TIỀN MẶT</th>
          <th>MUA CHUYỂN KHOẢN</th>
          <th>BÁN</th>
        </tr>
      </thead>
      <tbody></tbody>
      <tbody>
          <?php
              // kiem tra trang thai link
              function checkLinkStatus($url){
                $result = curl_init($url); // gan phien session luu tru kq tu $url
                if($result == false){ // kiem tra truong hop phien luu tru kq $url == false
                  return false; 
                }
                  curl_setopt($result, CURLOPT_HEADER, false); // thiet lap tuy chon phien luu tru kq $url
                  curl_setopt($result, CURLOPT_FAILONERROR, true); 
                  curl_setopt($result, CURLOPT_NOBODY, true);
                  curl_setopt($result, CURLOPT_RETURNTRANSFER, false);
                  $connectable = curl_exec($result); // gan kq thuc thi phien url da cho o tren
                  curl_close($result);   //dong phien luu tru kq $url
								  return $connectable; // tra ve kq thu thi
              }
                $url = "https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=1"; // url du lieu tu ngan hang cung cap dc dinh dang xml
                if(checkLinkStatus($url) == true){
                  $xml = file_get_contents($url);// ham lay ra noi dung tu $url
                  $data = simplexml_load_string($xml); //ham load 1 chuoi xml thanh 1 object
                
                if($data == false){ // kiem tra du lieu tu ngan hang cung cap co ton tai ko
                  echo '<tr class="danger"><th colspan="5" style="text-align:center"><h5>DỮ LIỆU BỊ LỖI</h5></th></tr>';
                }else{
                  // var_dump($data);
                  $updateTime = $data->DateTime; //DateTime lay tu xml
                  $price = $data->Exrate; // Exrate lay tu dinh dang xml
                  foreach($price as $priceOk){
                          $code = $priceOk['CurrencyCode']; // ma ngoai te
                          $name = $priceOk['CurrencyName']; // ten ngoai te
                          $buyPrice = $priceOk['Buy']; // gia mua vao
                          $transferPrice = $priceOk['Transfer']; // gia chuyen khoan
                          $sell = $priceOk['Sell']; // gia ban ra
                          $class_color = "success";// gan ten class =success 
                      
                    echo "<tr class='".$class_color."'>";
                    echo "<td>".$code."</td>";
                    echo "<td>".$name."</td>";
                    echo "<td>".$buyPrice."</td>";
                    echo "<td>".$transferPrice."</td>";
                    echo "<td>".$sell."</td>";
                    echo "</tr>";
                  }
                }
              }else{
									echo '<tr class="danger"><th colspan="5" style="text-align:center"><h5>KHÔNG THỂ KẾT NỐI ĐẾN MÁY CHỦ VIETCOMBANK</h5></th></tr>';
							}
            ?>
          </tbody>
      <tfoot>
        <tr>
          <th colspan="5">Tỷ giá được cập nhật lúc <?php echo $updateTime ?> và chỉ mang tính chất tham khảo.</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
</body>
</html>
 <!-- DU LIEU FILE XML NGAN HANG VIETCOMBANK -->
<!-- For reference only. Only one request every 5 minutes! -->
<!-- <ExrateList>
<DateTime>12/21/2022 2:36:27 PM</DateTime>
<Exrate CurrencyCode="AUD" CurrencyName="AUSTRALIAN DOLLAR " Buy="15,441.32" Transfer="15,597.29" Sell="16,099.49"/>
<Exrate CurrencyCode="CAD" CurrencyName="CANADIAN DOLLAR " Buy="16,985.40" Transfer="17,156.97" Sell="17,709.38"/>
<Exrate CurrencyCode="CHF" CurrencyName="SWISS FRANC " Buy="24,899.47" Transfer="25,150.98" Sell="25,960.78"/>
<Exrate CurrencyCode="CNY" CurrencyName="YUAN RENMINBI " Buy="3,331.96" Transfer="3,365.61" Sell="3,474.50"/>
<Exrate CurrencyCode="DKK" CurrencyName="DANISH KRONE " Buy="-" Transfer="3,319.77" Sell="3,447.29"/>
<Exrate CurrencyCode="EUR" CurrencyName="EURO " Buy="24,511.68" Transfer="24,759.28" Sell="25,883.79"/>
<Exrate CurrencyCode="GBP" CurrencyName="POUND STERLING " Buy="28,100.11" Transfer="28,383.95" Sell="29,297.84"/>
<Exrate CurrencyCode="HKD" CurrencyName="HONGKONG DOLLAR " Buy="2,964.20" Transfer="2,994.14" Sell="3,090.55"/>
<Exrate CurrencyCode="INR" CurrencyName="INDIAN RUPEE " Buy="-" Transfer="286.11" Sell="297.58"/>
<Exrate CurrencyCode="JPY" CurrencyName="YEN " Buy="174.43" Transfer="176.19" Sell="184.66"/>
<Exrate CurrencyCode="KRW" CurrencyName="KOREAN WON " Buy="15.92" Transfer="17.69" Sell="19.39"/>
<Exrate CurrencyCode="KWD" CurrencyName="KUWAITI DINAR " Buy="-" Transfer="77,205.93" Sell="80,301.57"/>
<Exrate CurrencyCode="MYR" CurrencyName="MALAYSIAN RINGGIT " Buy="-" Transfer="5,286.48" Sell="5,402.39"/>
<Exrate CurrencyCode="NOK" CurrencyName="NORWEGIAN KRONER " Buy="-" Transfer="2,351.24" Sell="2,451.34"/>
<Exrate CurrencyCode="RUB" CurrencyName="RUSSIAN RUBLE " Buy="-" Transfer="324.49" Sell="359.26"/>
<Exrate CurrencyCode="SAR" CurrencyName="SAUDI RIAL " Buy="-" Transfer="6,285.30" Sell="6,537.32"/>
<Exrate CurrencyCode="SEK" CurrencyName="SWEDISH KRONA " Buy="-" Transfer="2,226.82" Sell="2,321.62"/>
<Exrate CurrencyCode="SGD" CurrencyName="SINGAPORE DOLLAR " Buy="17,080.87" Transfer="17,253.40" Sell="17,808.92"/>
<Exrate CurrencyCode="THB" CurrencyName="THAILAND BAHT " Buy="602.97" Transfer="669.97" Sell="695.70"/>
<Exrate CurrencyCode="USD" CurrencyName="US DOLLAR " Buy="23,550.00" Transfer="23,580.00" Sell="23,860.00"/>
<Source>Joint Stock Commercial Bank for Foreign Trade of Vietnam - Vietcombank</Source>
</ExrateList> -->