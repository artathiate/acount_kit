<html>
    <head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

        <script src="jquery-3.0.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://sdk.accountkit.com/fr_FR/sdk.js"></script>
        <link rel = "stylesheet" href = "https://www.w3schools.com/w3css/4/w3.css">
        <link rel = "stylesheet" href = "style.css">
       
    </head>
<style>
    #verify{
        color:green;
        display:inline;
    }
</style>
    <body>
      <center>
        <!--<div class = "w3-container w3-blue">
<h1 class = "w3-center"> Kit de compte par Facebook </h1>
</div><br><br>
<input value="+1" id="country_code" /><br><br>
                <input placeholder="phone number" id="phone_number"/><br><br>
                <button onclick="smsLogin();">Login via SMS</button>-->
           <div id="login">
        <h3 class="text-center text-white pt-5"> Kit de compte par Facebook</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Connectez-vous</h3>
                            <div class="form-group" style="display: none;">
                                <label for="username"  class="text-info">Indicatif:</label><br>
                                <input type="text" name="username" value="+1" id="country_code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info" ></label><br>
                                <input placeholder="votre numero" type="number" required name="password"  id="phone_number" class="form-control"/>
                            </div>
                            <div class="form-group">
                               <button onclick="smsLogin();" class="btn btn-info btn-md" value="submit">Recevoir par SMS</button>
                               <div class="message">
                    <p><center><b>Message de vérification</b></center></p>
                </div>
                               
                                
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>     
    
       
        
        <script>
          //https://developers.facebook.com/docs/accountkit/webjs
          $(".message").append("<p>initialized Account Kit.</p>");
          
          // initialize Account Kit with CSRF protection
          AccountKit_OnInteractive = function(){
            AccountKit.init(
              {
                appId:"755746284809194", 
                state:"ddb9e72ac946c816c9d291d3f654b0f4", 
                version:"v1.0",
                fbAppEventsEnabled:true
              }
            );
          };

            
          // login callback
          function loginCallback(response) {
            if (response.status === "PARTIALLY_AUTHENTICATED") {
              var code = response.code;
              var csrf = response.state;
                $(".message").append("<p>Received auth token from facebook -  "+ code +".</p>");
                $(".message").append("<p>Triggering AJAX for server-side validation.</p>");
                
                $.post("verify.php", { code : code, csrf : csrf }, function(result){
                    $(".message").append( "<p>Server response : " + result + "</p>" );
                });
                
            }
            else if (response.status === "NOT_AUTHENTICATED") {
              // handle authentication failure
                $(".message").append("<p>( Error ) NOT_AUTHENTICATED status received from facebook, something went wrong.</p>");
            }
            else if (response.status === "BAD_PARAMS") {
              // handle bad parameters
                $(".message").append("<p>( Error ) BAD_PARAMS status received from facebook, something went wrong.</p>");
            }
          }
            
            
          // phone form submission handler
          function smsLogin() {
            //var countryCode = document.getElementById("country_code").value;
            var countryCode = "+221"
            var phoneNumber = document.getElementById("phone_number").value;
            $(".message").append("<p>Triggering phone validation.</p>");
            AccountKit.login(
              'PHONE', 
              {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
              loginCallback
            );
          }


          
        </script>
         <script src="jquery-3.0.0.min.js"></script>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
       
    </body>
</html>
