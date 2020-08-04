<?php 
    //require database module
    require_once './database/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="STEPS | Multipurpose Working Wizard with Branches">
    <meta name="author" content="Ansonika">
    <title>STEPS | Multipurpose Working Wizard with Branches</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="css/style.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">
    
	<script type="text/javascript">
    function delayedRedirect(){
        window.location = "index.html"
    }
    </script>

</head>
<body style="background:#f8f8f8 url(img/pattern.svg) repeat;" onLoad="setTimeout('delayedRedirect()', 5000)">
<?php
						$mail = $_POST['email'];

						$to = "test@domain.com";	/* YOUR EMAIL HERE */
						$subject = "Quotation from STEPS";
						$headers = "From: Quotation from STEPS <noreply@yourdomain.com>";
						$message = "DETAILS\n";
						$message .= "\nWhat Type of Project do you need: " . $_POST['branch_1_group_1'] . "\n";
	
						$message .= "\nPERSONAL DETAILS\n" ;
						$message .= "\nMr/Mrs: " . $_POST['mr_mrs'];
						$message .= "\nName: " . $_POST['firstname'];
						$message .= "\nNachname: " . $_POST['lastname'];
						$message .= "\nCompany_name: " . $_POST['company_name'];
						$message .= "\nEmail: " . $_POST['email'];
						$message .= "\nTelephone " . $_POST['phone'];
						$message .= "\nHave_Domain: " . $_POST['have_domain'];
						$message .= "\nDomain_Name: " . $_POST['domain_name'];
						$message .= "\nTerms and conditions accepted: " . $_POST['terms'] . "\n";
						
						// information that will be send to database 
						$project_name = $_POST['branch_1_group_1'];

						$personal_info = (object) [   
							"Mr/Mrs" => $_POST['mr_mrs'], 
							"name" => $_POST['firstname'],
							"nachname" => $_POST['lastname'],
							"company_name" => $_POST['company_name'],
							"email" => $_POST['email'],
							"phone" => $_POST['phone'],
							"have_domain" => $_POST['have_domain'],
							"domain_name" => $_POST['domain_name']
						];

						$personal_info =  json_encode($personal_info);

						$message.= $personal_info;

						$websites = [];

						if (isset($_POST['website_1_answers']) && $_POST['website_1_answers'] != "")
							{
							$message.= "\Website Selected:\n";
							foreach($_POST['website_1_answers'] as $value)
								{
								$trim_value = trim(stripslashes($value));
								array_push($websites, $trim_value);
								$message.= "-" . $trim_value . "\n";
								};
								
							}
						$websites = implode(",", $websites);
						$message.= $websites;
						
						$menus_selected = [];
						if (isset($_POST['menu_1_answers']) && $_POST['menu_1_answers'] != "")
							{
							$message.= "\nMenu Selected:\n";
							foreach($_POST['menu_1_answers'] as $value)
								{
								$trim_value = trim(stripslashes($value));
								array_push($menus_selected, $trim_value);
								$message.= "-" . trim(stripslashes($value)) . "\n";
								};
								$message .= "\nOther menu: " . $_POST['menu_other'] . "\n";
								
							}
						$menus_selected = implode(",", $menus_selected);
						$message.= $menus_selected;
						$documents = NULL;
						
						// insert into database 
						$insert = $mysqli->prepare("INSERT INTO formmm(project_name, personal_info, websites, menus, documents) VALUES(?,?,?,?,?)");
						$insert->bind_param("sssss", $project_name, $personal_info, $websites, $menus_selected, $documents);
						$insert->execute();

						if (isset($_FILES['files']) && $_FILES['files'] != "")
							{
							$message.= "\nPictures Upload:\n";
							// File upload configuration 
							$targetDir = "uploads/"; 
							$allowTypes = array('jpg','png','jpeg','gif'); 
							
							$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
							$fileNames = array_filter($_FILES['files']['name']); 
							if(!empty($fileNames)){ 
								foreach($_FILES['files']['name'] as $key=>$val){ 
									// File upload path 
									$fileName = basename($_FILES['files']['name'][$key]); 
									$newFilename = round(microtime(true)).'_'.$fileName;
									$message.= "\nFile Name:\n". $newFilename;
									$targetFilePath = $targetDir . $newFilename; 
									
									// Check whether file type is valid 
									$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
									if(in_array($fileType, $allowTypes)){ 
										// Upload file to server 
										if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
											// Image db insert sql 
											$insertValuesSQL .= "('".$fileName."', NOW()),"; 
										}else{ 
											$errorUpload .= $_FILES['files']['name'][$key].' | '; 
										} 
									}else{ 
										$errorUploadType .= $_FILES['files']['name'][$key].' | '; 
									} 
								}
							}
								
							}
						

						// echo $message;
												
						//Receive Variable
						$sentOk = mail($to,$subject,$message,$headers);
						
						//Confirmation page
						$user = "$mail";
						$usersubject = "Thank You";
						$userheaders = "From: info@steps.com\n";
						/*$usermessage = "Thank you for your time. Your quotation request is successfully submitted.\n"; WITH OUT SUMMARY*/
						//Confirmation page WITH  SUMMARY
						$usermessage = "Thank you for your time. Your quotation request is successfully submitted. We will reply shortly.\n\nBELOW A SUMMARY\n\n$message"; 
						mail($user,$usersubject,$usermessage,$userheaders);
	
?>
<!-- END SEND MAIL SCRIPT -->   
<div id="success">
	<div class="icon icon--order-success svg">
		<svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                <g fill="none" stroke="#8EC343" stroke-width="2">
                  <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                  <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                </g>
              </svg>
	</div>
	<h4><span>Request successfully sent!</span>Thank you for your time</h4>
	<small>You will be redirect back in 5 seconds.</small>
</div>
</body>
</html>