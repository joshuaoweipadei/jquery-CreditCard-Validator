<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery CreditCard Validator</title>
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <div class="creditCard">
    <h2>jQuery Credit Card Validation Form</h2>
    <div class="creditCard__container">
      <div class="creditCard_wrapper">
        <form class="formValidator" action="" method="post" onSubmit="return cardValidator()">
          <div class="form__row">
            <label for="">Card Holder Name</label>
            <span id="card-holder-name-info" class="info"></span><br/>
            <input type="text" id="card-holder-name" class="input__field" />
          </div>

          <div class="form__row">
            <label>Card Number</label>
            <span id="card-number-info" class="info"></span><br />
            <input type="text" id="card-number" class="input__field" />
          </div>

          <div class="form__row form__rowSelect">
            <div class="group__row column-right">
              <label>Expiry Month / Year</label>
              <span id="userEmail-info" class="info"></span><br /> 
              <select name="expiryMonth" id="expiryMonth" class="input__fieldSelect">
                <?php
                for($i = date("m"); $i <= 12; $i ++) {
                  $monthValue = $i;
                  if(strlen($i) < 2){
                    $monthValue = "0" . $monthValue;
                  }
                ?>
                <option value="<?php echo $monthValue; ?>"><?php echo $i; ?></option>
                <?php
                }
                ?>
              </select>
              <select name="expiryMonth" id="expiryMonth" class="input__fieldSelect">
                <?php
                for ($i = date("Y"); $i <= 2030; $i ++) {
                  $yearValue = substr($i, 2);
                  ?>
                  <option value="<?php echo $yearValue; ?>"><?php echo $i; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>

            <div class="group__row cvv-box">
              <label>CVV</label>
              <span id="cvv-info" class="info"></span><br />
              <input type="text" name="cvv" id="cvv" class="input__fieldCVV cvv-input">
            </div>
          </div>

          <button type="submit" class="submitCardForm">Submit</button>

          <div id="error-message"></div>
        </form>
      </div>
    </div>
  </div>

  <script src="js/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="js/creditcard-validator/jquery.creditCardValidator.js"></script>
  <script>
    function cardValidator(){
      var valid = true;
      $(".input__field").css('background-color', '');
      var message = "";

      var cardHolderNameRegex = /^[a-z ,.'-]+$/i;
      var cvvRegex = /^[0-9]{3,3}$/;

      var cardHolderName = $("#card-holder-name").val();
      var cardNumber = $("#card-number").val();
      var cvv = $("#cvv").val();

      if(cardHolderName == "" || cardNumber == "" || cvv == ""){
        message += "<div>All fields are required.</div>";
        if(cardHolderName == ""){
          $("#card-holder-name").css('background-color', '#87afe0');
        }
        if(cardNumber == ""){
          $("#card-number").css('background-color', '#87afe0');
        }
        if(cvv == ""){
          $("#cvv").css('background-color', '#87afe0');
        }
        valid = false;
      }

      if(cardHolderName != "" && !cardHolderNameRegex.test(cardHolderName)){
        message += "<div>Card Holder Name is invalid</div>";
        $("#card-holder-name").css('background-color', '#87afe0');
        valid = false;
      }

      if(cardNumber != ""){
        $("#card-number").validateCreditCard(function(result){
          if(!(result.valid)){
            message += "<div>Card Number is Invalid</div>";
            $("#card-number").css('background-color', '#87afe0');
            valid = false;
          }
        });
      }

      if(cvv != "" && !cvvRegex.test(cvv)){
        message += "<div>CVV is Invalid</div>";
        $("#cvv").css('background-color', '#87afe0');
        valid = false;
      }

      if(message != ""){
        $("#error-message").show();
        $("#error-message").html(message);
      } else {
        alert("Credit Card validation successfully");
      }

      return valid;
    }
  </script>
</body>
</html>



