<?php 
require_once("inc/initialize.php"); 
 
if(!$session->is_logged_in())
{
	redirect_to('index.php');
}

$user = new User();

$user->applicant_id = $session->applicant_id;

$form_id = $user->get_form_id();

$sql = "SELECT * FROM `adm_access_code` WHERE `jamb_rem_no`='".$form_id."' AND `reg_num`='".$form_id."'";

$payment_record = $user->find_by_sql($sql);

if(empty($payment_record))
{
	redirect_to('select_form.php');
}

$student_status = $user->get_student_status();

$database = new MYSQLDatabase();

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php 
	require_once(LIB_PATH.DS.'javascript.php');
	require_once(LIB_PATH.DS.'css.php');
?>
<style type="text/css">
	@media print{
		.noprint{display:none}
		.imgg{
			margin-top:-400px; 
			opacity:0.1; 
			width:200px; 
			display:inline-block !important;
			}
		
	}
	.imgg{display:none;}
</style>
</head>
<body>

<div class="noprint">
<?php include_layout_template("header.php"); ?> 
<?php include_layout_template("confirmation_menu.php"); ?> 
</div> 

<!--The Main Content Here Please-->

<!-- beginnning of main content-->
<?php
    $sqlprogrammedetails = "SELECT * FROM personal_details p, department d, faculty f WHERE p.applicant_id=".$session->applicant_id." AND p.programme_applied_id=d.department_id AND d.faculty_id=f.faculty_id";
    $programmedetails = $database->fetch_array($database->query($sqlprogrammedetails));
    $sessiondetails = $database->fetch_array($database->query("SELECT session FROM application_status WHERE id=1"));
    $paymentdetails = $database->fetch_array($database->query("SELECT * FROM adm_access_code WHERE jamb_rem_no='".$programmedetails['form_id']."'"));
?>

<section class="slice">
        <!-- Invoice wrapper -->
        <div id="invoice" class="paid">
            <div class="this-is">
                <strong>Invoice</strong>
            </div>

            <header id="header">
                <div class="invoice-intro">
                    <h1>
                        <img style="height:110px;" src="/mis.unijos.edu.ng/app_form_template/images/logo.png">
                    </h1>
                    <h5>University of Jos</h5>
                </div>

                <dl class="invoice-meta">
                    <dt class="invoice-number">Invoice #</dt>
                    <dd>6859</dd>
                    <dt class="invoice-date">Date of Invoice</dt>
                    <dd><?= date('m-d-Y', strtotime($paymentdetails['payment_date'])); ?></dd>
                    <dt class="invoice-due">Due Date</dt>
                    <dd><?= date('m-d-Y', strtotime($paymentdetails['payment_date'])); ?></dd>
                </dl>
            </header>

            <!-- <section id="parties">
                <div class="invoice-to">
                    <h2>Invoice To:</h2>
                    <div id="hcard-Hiram-Roth" class="vcard">
                        <a class="url fn">
                            <?= $programmedetails['surname'].' '.$programmedetails['first_name'].' '.$programmedetails['middle_name']; ?>
                        </a>
                        <div class="org"><?= $programmedetails['form_id']; ?></div>
                        <div><?= $paymentdetails['pin']; ?></div>
                        
                        <div class="adr">
                            <div><?= $programmedetails['faculty_name']; ?></div>
                            <div><?= $programmedetails['department_name']; ?></div>
                        </div>

                        <div class="tel">888-555-2311</div>
                    </div>
                </div>

                <div class="invoice-from">
                    <h2>Invoice From:</h2>
                    <div id="hcard-Admiral-Valdore" class="vcard">
                        <a class="url fn">School of Postgraduate Studies</a>
                        <div class="org">University of Jos</div>
                        <a class="email">PMB 2084 Jos, Jos.</a>
                        
                        <div class="adr">
                            <div>Plateau State</div>
                            <div>Nigeria</div>
                        </div>

                    </div>
                </div>

                <div class="invoice-status">
                    <h3>Invoice Status</h3>
                    <strong>Invoice is <em>Paid</em></strong>
                </div>
            </section> -->

            <table width="750px" style="border: 1px solid #000;">
                <tr>
                    <th><h2>Invoice To:</h2></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <div class="invoice-to">
                            
                            <div id="hcard-Hiram-Roth" class="vcard">
                                <a class="url fn">
                                    <?= $programmedetails['surname'].' '.$programmedetails['first_name'].' '.$programmedetails['middle_name']; ?>
                                </a>
                                <div class="org"><?= $programmedetails['form_id']; ?></div>
                                <div><?= $paymentdetails['pin']; ?></div>
                                
                                <div class="adr">
                                    <div><?= $programmedetails['faculty_name']; ?></div>
                                    <div><?= $programmedetails['department_name']; ?></div>
                                </div>

                                <div class="tel">888-555-2311</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="invoice-from">
                            <h2>Invoice From:</h2>
                            <div id="hcard-Admiral-Valdore" class="vcard">
                                <a class="url fn">School of Postgraduate Studies</a>
                                <div class="org">University of Jos</div>
                                <a class="email">PMB 2084 Jos, Jos.</a>
                                
                                <div class="adr">
                                    <div>Plateau State</div>
                                    <div>Nigeria</div>
                                </div>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="invoice-status">
                            <h3>Invoice Status</h3>
                            <strong>Invoice is <em>Paid</em></strong>
                        </div>
                    </td>
                </tr>
            </table>

            <section class="invoice-financials">
                <div class="invoice-items">
                    <table>
                        <caption>Your Invoice</caption>
                        <thead>
                            <tr>
                                <th>Item Description</th>
                                <th>Price (&#8358;)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Programme</th>
                                <td>&#8358;<?= $paymentdetails['amount']; ?>.00</td>
                            </tr>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Amounts in bars of Gold Pressed Latinum</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="invoice-totals">
                    <table>
                        <caption>Totals:</caption>
                        <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td>&#8358;<?= $paymentdetails['amount']; ?>.00</td>
                            </tr>
                            <tr>
                                <th>Transaction Charge</th>
                                <td>&#8358;300.00</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>&#8358;<?= $paymentdetails['amount'] + 300; ?>.00</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="invoice-pay">
                        <h5>APPLICATION FORM INVOICE FOR <?= $sessiondetails['session']; ?> ACADEMIC SESSION</h5>
                        <ul>
                            <li>
                                <a href="#" class="gcheckout">Checkout with Google</a>
                            </li>
                            <li>
                                <a href="#" class="acheckout">Checkout with Amazon</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="invoice-notes">
                    <h6>Notes &amp; Information:</h6>
                    <p>Application form payments are not refundable after payment.</p>
                    <p>Make sure the payment details on the receipt matches your details.</p>
                </div>

                <div class="noprint">
                    <button class="btn btn-primary " onClick="window.print();" >PRINT</button>
                </div>
                <!-- <img src="/mis.unijos.edu.ng/app_form_template/images/logo.png" class="imgg"> -->
            </section>
        </div>
 </section>

<!--The Main Content Here Please-->
<div class="noprint">
<?php include_layout_template("footer.php"); ?>
</div>
</body>
</html>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/dropdownscript.js"></script>
<script src="js/nav_tabs.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>