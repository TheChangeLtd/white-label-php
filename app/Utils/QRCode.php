<?php

namespace App\Utils;

use Exception;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;

class QRCode
{
    public static function generateQRCode($network, $address, $amount){
        $cryptoURI = $network . ':' . $address;
        if (!empty($amount)) {
            $cryptoURI .= '?amount=' . $amount;
        }

        try {
            $result = Builder::create()
                ->writer(new PngWriter())
                ->data($cryptoURI)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelLow())
                ->size(300)
                ->margin(0)
                ->build();
            return $result->getDataUri();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function generateQRCodeForMemo($memo)
    {

        try {
            $result = Builder::create()
                ->writer(new PngWriter())
                ->data($memo)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelLow())
                ->size(300)
                ->margin(0)
                ->build();

            return $result->getDataUri();
        } catch (Exception $e) {
            error_log('Error generating QR code for memo: ' . $e->getMessage());
            return null;
        }
    }
}
