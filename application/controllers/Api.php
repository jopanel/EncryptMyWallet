<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    protected function validatePassword($password)
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException('Your password needs to be at least 8 characters long. ');
        }

        if(!preg_match('/(?=.*?[a-z])(?=.*?[A-Z])/', $password)){
            throw new InvalidArgumentException('You need at least one lowercase and uppercase letter. ');
        }

        if(!preg_match('/(?=.*?[0-9])(?=.*?[!@#$%^&*])/', $password)){
            throw new InvalidArgumentException('Your password must have at least 1 number and 1 special character (!@#$%^&*). ');
        }

        if (preg_match('/(?=(\d{4}))/', $password)) {
            throw new InvalidArgumentException('Consecutive numbers are not allowed. ');
        }
    }

	public function encrypt()
	{
	    try {
            $postData = $this->input->post();
            if ($this->input->is_ajax_request() && $postData) {
                $this->validatePassword($postData["passcode"]);
                if (isset($postData["private"]) && !empty($postData["private"]) && isset($postData["passcode"]) && !empty($postData["passcode"])){
                    echo json_encode(
                        array(
                            "success" => 1,
                            "encrypted" => $this->Encryption_model->encryptWallet($postData["passcode"],$postData["private"])
                        )
                    );
                }
            }
        } catch (InvalidArgumentException $e) {
            echo json_encode(
                array(
                    "success" => 0,
                    "error" => $e->getMessage()
                )
            );
        } catch (Exception $e) {
            echo json_encode(
                array(
                    "success" => 0,
                    "error" => "Something went wrong"
                )
            );
        }
	}

	public function decrypt()
	{
        $postData = $this->input->post();
		if ($this->input->is_ajax_request() && $postData) {
            $postData = $this->input->post();
            if (isset($postData["private"]) && !empty($postData["private"]) && isset($postData["passcode"]) && !empty($postData["passcode"])){
                echo json_encode(array("decrypted" => $this->Encryption_model->decryptWallet($postData["passcode"],$postData["private"])));
            }
		}
	}
}
