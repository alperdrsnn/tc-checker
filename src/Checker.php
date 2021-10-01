<?php

namespace TcChecker;

class Checker
{

    public static function checkTC(array $bilgiler)
    {
       $gonder = '<?xml version="1.0" encoding="utf-8"?>
		<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		<soap:Body>
		<TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
		<TCKimlikNo>'.$bilgiler[0].'</TCKimlikNo>
		<Ad>'.$bilgiler[1].'</Ad>
		<Soyad>'.$bilgiler[2].'</Soyad>
		<DogumYili>'.$bilgiler[3].'</DogumYili>
		</TCKimlikNoDogrula>
		</soap:Body>
		</soap:Envelope>';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,            "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_POST,           true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,    $gonder);
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array(
		'POST /Service/KPSPublic.asmx HTTP/1.1',
		'Host: tckimlik.nvi.gov.tr',
		'Content-Type: text/xml; charset=utf-8',
		'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
		'Content-Length: '.strlen($gonder)
		));
		$gelen = curl_exec($ch);
		curl_close($ch);

	    return strip_tags($gelen);
    }
}
