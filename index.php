<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

   <title>Product List</title>

   <style>
      .spanner {
         position: absolute;
         top: 50%;
         left: 0;
         background: #2a2a2a55;
         width: 100%;
         display: block;
         text-align: center;
         height: 300px;
         color: #FFF;
         transform: translateY(-50%);
         z-index: 1000;
         visibility: hidden;
      }

      .overlay {
         position: fixed;
         width: 100%;
         height: 100%;
         background: rgba(0, 0, 0, 0.5);
         visibility: hidden;
      }

      .loader,
      .loader:before,
      .loader:after {
         border-radius: 50%;
         width: 2.5em;
         height: 2.5em;
         -webkit-animation-fill-mode: both;
         animation-fill-mode: both;
         -webkit-animation: load7 1.8s infinite ease-in-out;
         animation: load7 1.8s infinite ease-in-out;
      }

      .loader {
         color: #ffffff;
         font-size: 10px;
         margin: 80px auto;
         position: relative;
         text-indent: -9999em;
         -webkit-transform: translateZ(0);
         -ms-transform: translateZ(0);
         transform: translateZ(0);
         -webkit-animation-delay: -0.16s;
         animation-delay: -0.16s;
      }

      .loader:before,
      .loader:after {
         content: '';
         position: absolute;
         top: 0;
      }

      .loader:before {
         left: -3.5em;
         -webkit-animation-delay: -0.32s;
         animation-delay: -0.32s;
      }

      .loader:after {
         left: 3.5em;
      }

      @-webkit-keyframes load7 {

         0%,
         80%,
         100% {
            box-shadow: 0 2.5em 0 -1.3em;
         }

         40% {
            box-shadow: 0 2.5em 0 0;
         }
      }

      @keyframes load7 {

         0%,
         80%,
         100% {
            box-shadow: 0 2.5em 0 -1.3em;
         }

         40% {
            box-shadow: 0 2.5em 0 0;
         }
      }

      .show {
         visibility: visible;
      }

      .spanner,
      .overlay {
         opacity: 0;
         -webkit-transition: all 0.3s;
         -moz-transition: all 0.3s;
         transition: all 0.3s;
      }

      .spanner.show,
      .overlay.show {
         opacity: 1
      }
   </style>
</head>

<?php
$product_key = "MD173398";
if ($_POST) {
   $product_key = $_POST["product"];
}
$opts = array(
   'http' => array(
      'method' => "GET",
      'header' => "Accept-language: nb-NO"
   )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$response = file_get_contents('https://www.plandent.no/api/search?q=' . $product_key, false, $context);

$response = json_decode($response);
$product = [];
$product = $response->data->items;


$curl = curl_init();

curl_setopt_array($curl, array(
   CURLOPT_URL => "https://www.plandent.no/api/Pricing/CustomerPrice",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS => "[\"$product_key\"]",
   CURLOPT_HTTPHEADER => array(
      "cookie: please change the cookie",
      "content-type: application/json"
   ),
));

$response = curl_exec($curl);
curl_close($curl);

$response = json_decode($response);

?>

<body>
   <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <!-- Brand/logo -->
      <a class="navbar-brand" href="#">Gunnar Pauls task</a>
      <!-- Links -->
   </nav>
   <div class="overlay"></div>
   <div class="spanner">
      <div class="loader"></div>
      <p>Getting the product information, please be patient.</p>
   </div>
   <div class="container">
      <div class="row mt-5">
         <div class="alert alert-info">
            If you are ok, Would you contact me via skype?
            In the future, if you have any task, I can support for you perfect.
            <h4>My skype id : live:.cid.55e47e37ef6dea8f</h4>
            <h4>My email : futuredev918@outlook.com</h4>
            Looking forwards to your reply.
            Thanks
         </div>
      </div>
      <form action="index.php" method="post">
         <div class="row mt-5">
            <div class="col-10">
               <input type="text" class="form-control" placeholder="Search Product Key" name="product" value="<?php echo $response->data[0]->itemId ?>">
            </div>
            <div class="col-2">
               <button type="submit" class="btn btn-danger">Search</button>
            </div>
         </div>
      </form>
      <hr>
      <h2>Result:</h2>
      <div class="row">
         <div class="col-12">
            <table class="table" style="table-layout: fixed;">
               <thead>
                  <tr>
                     <th>Product No</th>
                     <th>Product Name</th>
                     <th>Product Link Page</th>
                     <th>Product Price (with vat)</th>
                     <th>Package Size</th>
                     <th>Pachage Content</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  if (!$product) {
                  ?>
                     <tr>
                        <td colspan="6" class="text-center">
                           <h3>No result</h3>
                        </td>
                     </tr>
                  <?php } else { ?>
                     <?php foreach ($product as $key => $value) { ?>
                        <tr>
                           <td>
                              <?php echo $response->data[0]->itemId ?>
                           </td>
                           <td><?php echo $value->displayName ?></td>
                           <td>
                              <a style="word-break: break-all;" href="<?php echo "https://www.plandent.no/" . $value->url ?>" target="_blank"><?php echo "https://www.plandent.no/" . $value->url ?></a></td>
                           <td><?php echo $response->data[0]->customerPrice->price->vatValue ?></td>
                           <td><?php echo $value->packageSize ?></td>
                           <td><?php echo $value->packageContent ?></td>
                        </tr>
                     <?php } ?>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <script>
      $(".btn").click(function() {
         $("div.spanner").addClass("show");
         $("div.overlay").addClass("show");
      });
   </script>
</body>

</html>