<?php

function getRandomString($length = 40, $charset = 'alphanum') {
    $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '0123456789';
    switch ($charset) {
        case 'alpha':
            $chars = $alpha;
            break;
        case 'alphanum':
            $chars = $alpha . $num;
            break;
        case 'num':
            $chars = $num;
            break;            
    }
    
    $randstring='';
    $maxvalue=strlen($chars)-1;
    for ($i = 0; $i < $length; $i++)
      $randstring .= substr($chars, rand(0, $maxvalue), 1);
    return $randstring;
}

// user login info
$user = 'madhav2k';
$pass = '123456';

// account info
$accnt_num = '5424180272332050';
$accnt_type = 'CITI CARDS';

// date and a random unique transaction id
$txn_id = getRandomString(6);
$tz_offset = date('Z')/3600;
$date = date("YmdHis[$tz_offset:T]");

// CitiCard Info
$org = 'Citigroup';
$fid = '24909';
$bank_id = '24909';

// transaction retrieval date range
$start_date = '20090101000000';        // from date, to..
$end_date = date('YmdHis');        // now

$xml = "
<OFX>
    <SIGNONMSGSRQV1>
        <SONRQ>
            <DTCLIENT>$date</DTCLIENT>
            <USERID>$user</USERID>
            <USERPASS>$pass</USERPASS>
            <LANGUAGE>ENG</LANGUAGE>
            <FI>
                <ORG>$org</ORG>
                <FID>$fid</FID>
            </FI>
            <APPID>QWIN</APPID>
            <APPVER>1800</APPVER>
        </SONRQ>
    </SIGNONMSGSRQV1>
    
    <BANKMSGSRQV1>
        <STMTTRNRQ>
            <TRNUID>$txn_id</TRNUID>
            <STMTRQ>
                <BANKACCTFROM>
                    <BANKID>$bank_id</BANKID>
                    <ACCTID>$accnt_num</ACCTID>
                    <ACCTTYPE>$accnt_type</ACCTTYPE>
                </BANKACCTFROM>
                <INCTRAN>
                    <DTSTART>$start_date</DTSTART>
                    <DTEND>$end_date</DTEND>
                    <INCLUDE>Y</INCLUDE>
                </INCTRAN>
            </STMTRQ>
        </STMTTRNRQ>
    </BANKMSGSRQV1>
</OFX>";

$ch = curl_init();
$ch1 = curl_setopt($ch, CURLOPT_URL, 'https://secureofx2.bankhost.com/citi/cgi-forte/ofx_rt?servicename=ofx_rt&pagename=ofx');
$ch2 = curl_setopt($ch, CURLOPT_POST, 1);
$ch3 = curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
$ch4 = curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
$ch5 = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$ch6 = curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);
if ($result) {
    $correctedXML = preg_replace('/<([A-Za-z]*?)>(?![\s\S]*?<\/\1>)(.+)/m', '<\1>\2</\1>', $result);
    $x = new SimpleXMLElement($correctedXML);
}
else
    echo "<pre>CURL ERROR: " . curl_error($ch) . "</pre>";
curl_close ($ch);

?>