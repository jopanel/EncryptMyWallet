<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


          <div class="inner cover">
            <div style="display:none;" class="alert alert-success" id="total-success" role="alert">
              Your encrypted wallet has been successfully decrypted.
            </div>
            <div style="display:none;" class="alert alert-danger" id="total-failure" role="alert">
              <strong>Sorry</strong> You entered the wrong password. Try Again.
            </div>
            <h1 class="cover-heading">Decrypt Your Wallet</h1>
            <input type="text" class="form-control" placeholder="Your Encrypted Wallet" required autofocus id="wallet-string"> 
            <input type="password" class="form-control" placeholder="Password" required id="password-string"> <br>
            <p class="lead">
              By decrypting your wallet you agree to our <a href="<?=base_url()?>tos">terms of service.</a>
            </p>
            <input class="btn btn-lg btn-primary btn-block" id="decrypt-btn" type="submit" value="Decrypt" onClick="decryptWallet()">
            <input type="text" class="form-control success" style="display:none;" onClick="this.setSelectionRange(0, this.value.length)" id="decrypted-wallet"><br>
            <p class="lead">
              EncryptMyWallet.com does not hold your information for you. We cannot access accounts, recover keys, reset passwords, nor reverse transactions. Protect your keys & password. Always check that you are on correct URL. <a href="<?=base_url()?>tos">You are responsible for your security.</a>
            </p> 
          </div>
          <script>
            function decryptWallet() {
                  $("#decrypt-btn").hide(); 
                  var wallet = document.getElementById("wallet-string").value;
                  var password = document.getElementById("password-string").value; 
                  var postData = { "private": wallet, "passcode": password };
                  $.ajax({
                      type: 'POST',
                      url: '<?=base_url()?>api/decrypt', 
                      dataType: 'json',
                      data: postData,
                      cache: false,
                      success: function (jsonData) {  
                        if (jsonData.decrypted == "" || jsonData.decrypted == null || jsonData.decrypted == undefined) {
                          document.getElementById("wallet-string").value = "";
                          document.getElementById("password-string").value = "";
                          $("#decrypt-btn").show();
                          $("#total-failure").show();
                        } else {
                          document.getElementById("decrypted-wallet").value = jsonData.decrypted;
                          $("#decrypted-wallet").show();
                          $("#total-success").show();
                          $("#total-failure").hide();
                        }
                      }
                  });
              } 
          </script>
