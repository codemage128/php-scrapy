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
      "cookie: _ga=GA1.2.195102298.1595884976; ai_user=/q/ZW|2020-07-27T21:22:57.036Z; _fbp=fb.1.1595884978149.1187495515; plandent.language=nb-NO; TiPMix=93.1406566841251; x-ms-routing-name=self; EPi:StateMarker=true; EPi:UrlReferrerKey=http://localhost/php/; ARRAffinity=9b75f72e995dc42970680a5f267936e44a4ed6a005f0b53720c473ab6e9b6ba5; _gid=GA1.2.1657249837.1596026116; logindialogue=dismissed; __cfduid=da73271281926c0b7514255356311dbf11596026159; .AspNet.Cookies=yEbUxDMpr-fSjETznVooCqtufny9j7Id9Ulx8EtfNxhdJd9ajJ1Y0gSxWwlBqDHtjS2Ah63QYxZElLtjQ_Z_nj4SmR-FGIOjp7oCKspAXlPnBP8GGjNzUgkl5pm1srcS7utC3dvFvv3B1oMKChVlYzeG8i0FrIlxYpEz17S3vItUq26oiMRLH5TodQoiAM3F8qry_QiYVnszb3VQBW-jVnD29w8ZWqbmRW2xLLD1syH0XXmVtwubI6byszOwqZRWf5BNMWN3s-Q8HY6D1qRAZci66NG9vX7ZnhDobHpKClh0oOYohyU_AJM2B2nC_lkXLmxPphdGR2fEOtFUPziyV4DcImbDnCyE-oH93qV_XFAZt6HH7t72wtBV5nwIAhtSOc7HN1U_8u8bmYnrUrhhoccO7di8wmaOxgUEtIkgCk_U0YK_IICbDV26R7XsBNLoVhpM2xf_YY59PWTSfpmcYirzfYTWG5dEpzvfbHaGoerHz1GU4Bk2smzIGy0djI1rhFFDM7p4HxGJJpHD7naXLJm_rKRH3QXt3lWHjBeHYkW8N_C8oUp9mbCgA0w8o3X4CtwolbjZ7dihSETR3hQSbRuMgcz1TeZy-TzUd6YEfoXmGLvyYq_T9TsCrRY3369WEjlIyJwmJthjkgBLHSGg8G8S0WS8fhLGb3OqxUnp3Fn03GlFSvflULtRkzr8w1o66G9SfBxaHNc5yELsdE2bicCCL6TD12Ro_-1PZFh9Nf4_VMYAnUt_X-IXsGJPEotozJL8hhce-3x37SQAtZucvc4pm_pmge2sa1ZhiwJUDEbZLiCgNf53jcgMs1jQ1C6V-QpE9b4SScn8aFZ3uqmyFyx42j_LPV3Fn0SOK4Zk-tml01ow60nt4K0Bht2rixob9Tg5lIlc6NO6VT7E_rD1nlR3qOC09kORwu-TX01JIBRKhANf8270Muz121sejcmt4st9OwADaKJNyt5DULFr-hSzPu2yDTZRURLlI-Ibq5nO8IMfT1fFdH1lKUCA1u1TBArc6o3qo0bWdgsuF20VNus4kLyNrqzal7K9bAA_kMzrIbjhXczOA_G-eA1wchHh6XR75jDxkskZCrLXk5tnAQKqucv4cUi1Nd_aLcb8elneDsAJlAvBIf0Sc46AhzHed4Lr-RUFWt5bo7vo_l4FQX7iT-gKkuRKIEMCXWooAP1ydYW-YbSFycAnV110XCS91ZQn-qaThNxa5VrydIebn6EdgbnRvYUdqHA61Dw8Na5YafZfdnthmstWOQNim0lTYPYkr85rcAtHMU4rNy1cSTdLGwp6KgljdhrMumLKOUt6KQauGZ4f9_E3X-aEDyJhyFJzj7GGmCK3Ru28yxO1D48Kyb11gqpeQc7I7OwDv5hsf7-_bggLIO85A6B6U2lK4phT_ktqIz1229A9eHOem4ensdCRyGvTQHfSCvPPquXJrg3eTBxUmI1GqqUMzaEzZT8ZhUhM23hzWmrfWwEZeXUSlJuRsOgYjKiR7g4WHsWYqOwDp2IBc6yLQw6ZN0ZOxrha3Omvgc685cNcN_nlfxEND1Yw50IQtRkITwof4s6z8VVtzhyaT-vTZFVwpOi3MsfFqxedGESstInb0wWdyerj1I1oozciFUknvDIH1F-u_iW5BSHkhrVdlGQzLxoRrPGv9WRmKTR3flW7CXo3ypWmR143t_2jpJ1c3m_Z0-1w44SFvi9A6S4-POIqB55Ar45aYtbX6r8lQ9a-Oczl6-a4uuC2Ma_ixvURZDnNi6vchz1SWU0cDCxhe4E0hju9tDCNN9JftH2VxSiTQNOzZQtc0qzUWskSDDtzWBfi9ZNaJ0KC1AJpzhXv9r8NXOlIqGwcn6YavMS2W1i-mLdAVTo4nKoO0v3B93WFdII7qAv0rrB6YRT0S2N_eLIXPVpNnd8sqp-5IvdKslffmiQBtN3CcDb1y4ckGmKQ8McRsVEXr3I-5ssU2OSMp4HLp8O4lyf1TvHirPrXLIvsf0dUBfSh28afJ8g2e2P6ROnvu3QUqNwKb6y-9ls1EAiPHMY39oMRVTUAG_KCOKlcC4Zh66lROGUfw6Dkw3WVAhH7mGbhHxI_Sz2YOxgzb-76ucWomzzuYbIXk7w6IZhQGfT_x159PIXkYasaj0BTZ-FQ3UegweN8wdxR1lx4yMOkzFZtME7J5lfGseDZycehw2VZY9rjEKt6e5OvGY2MZeIM-OYVToY6q5K7Ee4goskfExFGeo3lLViaamXBQrGUC3sH8VX5i82s_LY0xuQ3dVKcyZOE0CLKqwtmw8ED-SzaLrnuv3nsuOTih9SFlwScS4uQ2eVL_lkjXLQFRis0XORCZUDPi8ckONrY_zN4lNnt4FzL7aAO78_dHz8zPqEbv9QRfOEXgU3N5cFpsLQuF0t7ofillC8TjcB4UKNMoYwqdQgKo9Ldun4huF-U1ek8nlOKblchRY1wUzjwQK2Ici2ve5YsnVCWQV2J99EAduR49hgw; ai_session=9LRWU|1596026170951.51|1596026170951.51",
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