<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function encrypt()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {
				$postData = $this->input->post();
				if (isset($postData["private"]) && !empty($postData["private"]) && isset($postData["passcode"]) && !empty($postData["passcode"])){
					echo json_encode(array("encrypted" => $this->Encryption_model->encryptWallet($postData["passcode"],$postData["private"])));
				}
			}
		}
	}

	public function decrypt()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {
				$postData = $this->input->post();
				if (isset($postData["private"]) && !empty($postData["private"]) && isset($postData["passcode"]) && !empty($postData["passcode"])){
					echo json_encode(array("decrypted" => $this->Encryption_model->decryptWallet($postData["passcode"],$postData["private"])));
				}
			}
		}
	}
}
