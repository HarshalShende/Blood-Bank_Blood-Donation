<?php
include("config.php");

$b="{$_POST["BLOOD"]}";
$sql = "SELECT * FROM `blood_donor` WHERE BLOOD=?"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $b);
$stmt->execute();
$result = $stmt->get_result();

 while($row=$result->fetch_assoc())
  {
      $fields = array(
      "sender_id" => "FSTSMS",
      "message" => "Blood Needed Name:{$_POST["NAME"]}, Group:{$_POST["BLOOD"]}, phone: {$_POST["CON1"]} Addr:{$_POST["HOSP"]},{$_POST["CITY"]},{$_POST["PIN"]}, Required Date:{$_POST["RDATE"]}",
      "language" => "english",
      "route" => "p",
      "numbers" => "{$row['CONTACT_1']}",
      );

  $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($fields),
    CURLOPT_HTTPHEADER => array(
      "authorization: uJ3fC0byGT7hcUFoAxSWEB92Nkvw4sPqIjQaZ8H1mtizdpOL6KuY0qW42H8UROECBPM39IDfSAdxpQZw",
      "accept: */*",
      "cache-control: no-cache",
      "content-type: application/json"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
    echo "<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Record : </strong>Sorry No Match Message Not Sent</div>";
  } else {
   // echo $response;
}
    echo "<div class='alert alert-info fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SMS Sent : </strong>{$row['NAME']},{$row['CONTACT_1']}</div>";
  }

?>