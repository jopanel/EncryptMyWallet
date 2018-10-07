<?php

class Qr_Code_Helper
{
	const QR_CODE_API_URL = 'https://api.qrserver.com/v1/create-qr-code/';

	const SIZE = '400';

	const CHARSET = 'UTF-8';

	// can be equal to L (low), M (middle), Q (quality), H (high)
	const ERROR_CORRECTION = 'L';

	const FORMAT = 'png';

	/* 
	 * Generates an image with a QR code containing the given data in it.
	 * 
	 * @param string $data
	 *
	 * @return image/png
	*/
    function generateHtmlQrCode($data){

    	// construct request for qr code api
    	$ch = curl_init(self::QR_CODE_API_URL);

    	if ($ch === false) {
    		throw new Exception('Failed to init cURL session.');
    	}

    	// it is a post request
    	curl_setopt($ch, CURLOPT_POST, true);

    	// with following parameters
    	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( array(
    		'data' => $data,
    		'size' => self::SIZE . 'x' . self::SIZE,
    		'charset-source' => self::CHARSET,
    		'ecc' => self::ERROR_CORRECTION,
    		'format' => self::FORMAT,
    	)));

    	// we want the server response which contains our QR code
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    	// response with image/png content-type (with default FORMAT)
    	$image_response = curl_exec($ch);

    	if ($image_response === false) {
	        throw new Exception(curl_error($ch), curl_errno($ch));
	    }

    	curl_close($ch);

    	return $image_response;
    }
}