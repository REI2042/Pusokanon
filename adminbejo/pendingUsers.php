
<?php include 'headerAdmin.php'; 
    include '../db/DBconn.php'; 
    $users = fetchRegister($pdo);
?>  
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script src="https://cdn.emailjs.com/dist/email.min.js"></script>

<link rel="stylesheet" href="css/pending.css">
<main>
    <div class="container-fluid">
        <div class="titleHolder">
            <h1>Pending User</h1>
        </div>
        <div class="row d-flex justify-content-end m-2">
                <div class="col-12 col-md-4 d-flex justify-content-end p-0">
                    <a href="Admin-Document.php" class="back-button">
                        <i class="fa-solid fa-circle-chevron-left fa-2x"></i>
                        <span >Back</span>
                    </a>
                </div>
            </div>
            <div class="row d-flex justify-content-end m-2">
                <div class="col-12 col-md-4 d-flex justify-content-center p-0" style="gap:5px;">
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort By Purpose
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item">Work</a>
                            <a class="dropdown-item">School</a>
                            <a class="dropdown-item">Employment</a>
                        </div>
                    </div>
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort By Name
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item">Ascending</a>
                            <a class="dropdown-item">Descending</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="card">
                    <div class="card-body mt-2">
                        <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Age
                                    </th>
                                    <th>
                                       Sitio
                                    </th>
                                    <th>
                                        Date Register
                                        
                                    <th>
                                        Registered Voter
                                    </th>
                                    <th>
                                        More Details
                                    </th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody class="scrollable-table-body">
                                <?php if (empty($users)): ?>

                                    <td colspan="7">No user registering</td>

                                <?php else: ?>    
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            
                                            <?php
                                                $birthdate = new DateTime($user['birth_date']);
                                                $currentDate = new DateTime();
                                                $age = $currentDate->diff($birthdate)->y;

                                                $imagePath = "../db/uploadedFiles/{$user['verification_image']}";
                                                // Check if the image file if exists
                                                if (file_exists($imagePath)) {
                                                    // Read the image file and convert to a Base64-encoded string
                                                    $imageData = base64_encode(file_get_contents($imagePath));
                                                    $imageMimeType = mime_content_type($imagePath);
                                                    $imageSrc = "data:$imageMimeType;base64,$imageData";
                                                } else {
                                                    // Default image source if the file kay wla
                                                    $imageSrc = ''; 
                                                }
                                            ?>
                                            <td><?= htmlspecialchars(ucfirst($user['res_fname']).' '.ucfirst(substr($user['res_midname'], 0, 1)).'. '.ucfirst($user['res_lname'])) ?></td>
                                            <td><?= htmlspecialchars($age) ?></td>
                                            <td>
                                               <?= htmlspecialchars($user['addr_sitio'])?>
                                            </td>
                                            <td><?= htmlspecialchars($user['register_at'])?>  </td>
                                            <td class="reg-voter">
                                                <?= htmlspecialchars($user['registered_voter']) ?> 
                                                <i class="bi bi-x text-danger btn" onclick="handleXClick(<?= htmlspecialchars($user['res_ID']) ?>)"></i>
                                                <i class="bi bi-check2 text-success btn" onclick="handleCheckClick(<?= htmlspecialchars($user['res_ID']) ?>)"></i>
                                            </td>
                                            <td>
                                                <a href="#" onclick="showDetails('<?= $imageSrc ?>',
                                                                                    '<?= ucfirst($user['res_fname']).' '.ucfirst(substr($user['res_midname'], 0, 1)).'. '.ucfirst($user['res_lname']) ?>',
                                                                                    '<?= htmlspecialchars($user['addr_sitio'])?>',
                                                                                    '<?= htmlspecialchars($user['birth_date'])?>',
                                                                                    '<?= htmlspecialchars($user['contact_no'])?>',
                                                                                    '<?= htmlspecialchars($user['res_email'])?>',
                                                                                    '<?= htmlspecialchars($user['citizenship'])?>')">View details</a>

                                            </td>
                                            
                                            <td class="tools">
                                                <div class="btn btn-danger btn-sm" res_email="<?= htmlspecialchars($user['res_email']) ?>" 
                                                                                    res_ID="<?= htmlspecialchars($user['res_ID']) ?>"id="cancelButton" 
                                                                                    onclick="handleCancelClick(this.getAttribute('res_email'), 
                                                                                                                    this.getAttribute('res_ID'))">
                                                    <span class="btn-text">Cancel</span><i class="bi bi-person-x-fill"></i>
                                                </div>

                                                <div class="btn btn-primary btn-sm" 
                                                    res_ID="<?= htmlspecialchars($user['res_ID']) ?>"id="approveButton" 
                                                    onclick="handleApproveClick(this.getAttribute('res_ID'))">

                                                <span class="btn-text">Approve</span><i class="bi bi-person-fill-check"></i></div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script src="../js/sweetAlert.js"></script>
<script>
// function showDetails(imageSrc, additionalData, addSitio, birthDate, contactNumber, email,  citizenship) {
//     Swal.fire({
//         title: additionalData,
//         html: `<div style="text-align: left;">
//                     <p><strong style="padding-left:15px;padding-right:15px;"> House Address:</strong>${addSitio}</p>
//                     <p><strong style="padding-left:55px;padding-right:15px;"> Birth Date:</strong>${birthDate}</p>
//                     <p><strong style="padding-left:0px;padding-right:10px;"> Contact Number:</strong> ${contactNumber}</p>
//                     <p><strong style="padding-left:95px;padding-right:15px;"> Email:</strong>${email}</p>
//                     <p><strong style="padding-left:50px;padding-right:10px;"> Citizenship:</strong> ${citizenship}</p>
//                </div>`,
//         imageUrl: imageSrc,
//         imageWidth: 400,
//         imageHeight: 200,
//         imageAlt: "Custom image",
//         customClass: {
//             confirmButton: 'gray-btn'
//         }
//     });
// }

// document.getElementById('cancelButton').addEventListener('click', handleCancelClick);

// async function handleCancelClick(userEmail) {
//     const { value: text } = await Swal.fire({
//         title: "Message",
//         input: "textarea",
//         inputLabel: "Write Message.",
//         inputPlaceholder: "Type your message here...",
//         inputAttributes: {
//             "aria-label": "Type your message here"
//         },
//         showCancelButton: true
//     });

//     if (text) {

//         Fetch sender email from the database
//         const senderEmail = "<?= $user['res_email'] ?>";

//         Email.send({
//             SecureToken : "53fa4906-cb95-4a98-b24d-dc75b4225487",
//             To : 'azeetaurus@gmail.com', // Replace with the recipient's email address
//             From : 'reiiiiiiii.24@gmail.com', // Use the fetched sender email from the database
//             Subject : "Message from User",
//             Body : text  // Use the text entered by the user as the body of the email
//         }).then(
//           message => {
//               Swal.fire({
//                   title: "Email Sent!",
//                   text: message,
//                   icon: "success"
//               });
//           }
//         ).catch(
//             error => {
//                 Swal.fire({
//                     title: "Error",
//                     text: error,
//                     icon: "error"
//                 });
//             }
//         );
//     } else {
//         Swal.fire({
//             title: "Cancelled",
//             text: "Your action has been cancelled",
//             icon: "error"
//         });
//     }
// }

// emailjs.init('-eg-XfJjgYaCKpd3Q');

// async function handleCancelClick(userEmail) {
//     const { value: text } = await Swal.fire({
//         title: "Message",
//         input: "textarea",
//         inputLabel: "Write Message.",
//         inputPlaceholder: "Type your message here...",
//         inputAttributes: {
//             "aria-label": "Type your message here"
//         },
//         showCancelButton: true
//     });

//     if (text) {
//         // Fetch user data from the server based on user ID
//         const senderEmail = "<?= $user['res_email'] ?>";
//             // Send email using EmailJS
//             emailjs.send('service_uhvx5cl', 'template_tv4l19k', {
//                 from_email: 'reiiiiiiii.24@gmail.com',
//                 to_email: 'reiiiiiiii.24@gmail.com',
//                 subject: "Message from User",
//                 message: text
//             }).then(
//                 function(response) {
//                     Swal.fire({
//                         title: "Email Sent!",
//                         text: response.text,
//                         icon: "success"
//                     });
//                 },
//                 function(error) {
//                     Swal.fire({
//                         title: "Error",
//                         text: error.text,
//                         icon: "error"
//                     });
//                 }
//             );
//     } else {
//         Swal.fire({
//             title: "Cancelled",
//             text: "Your action has been cancelled",
//             icon: "error"
//         });
//     }
// }
// </script>

<?php include 'footerAdmin.php'; ?> 