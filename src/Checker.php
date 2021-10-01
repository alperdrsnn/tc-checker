<?php

namespace TcChecker;

class Checker
{

    public $client;

    public function __construct()
    {
        $this->client = new \SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");
    }

    public function checkTC(string $tckn, string $name, string $surname, string $year): bool
    {
        try{
            $result = $this->client->TCKimlikNoDogrula([
                'TCKimlikNo' => $tckn,
                'Ad' => $name,
                'Soyad' => $surname,
                'DogumYili' => $year
            ]);

            if ($result->TCKimlikDogrulaResult){
                return true;
            }else{
                return false;
            }
        }catch (\Exception $e) {
            return false;
        }
    }
}