<?php 
require_once("inc/initialize.php"); 

if(isset($_GET['ajiya']))
{

    $form_id = customDecrypt($_GET['ajiya']);

    $sql = "SELECT * FROM `adm_access_code` WHERE `jamb_rem_no`='".$form_id."' AND `reg_num`='".$form_id."'";
    $payment_record = $database->fetch_array($database->query($sql));

    if(empty($payment_record))
    {
    	redirect_to('select_form.php');
    }

    $user = new User();
    $user_sql = "SELECT * FROM `personal_details` WHERE `form_id` = '".$form_id."'";
    $user = $user->find_by_sql($user_sql);
    $user = array_shift($user);

    $student_status = $user->get_student_status();

    $database = new MYSQLDatabase();
    $sqlprogrammedetails = "SELECT * FROM personal_details p, department d, faculty f, photographs photo WHERE p.applicant_id=".$user->applicant_id." AND p.programme_applied_id=d.department_id AND d.faculty_id=f.faculty_id AND p.applicant_id = photo.applicant_id";
    $programmedetails = $database->fetch_array($database->query($sqlprogrammedetails));
    $sessiondetails = $database->fetch_array($database->query("SELECT session FROM application_status WHERE id=1"));
    $paymentdetails = $database->fetch_array($database->query("SELECT * FROM adm_access_code WHERE jamb_rem_no='".$programmedetails['form_id']."'"));

    $invoice = new Invoice();
    $invoice->db_fields = array('applicant_id','date', 'amount');
    $invoice->applicant_id = $user->applicant_id;
    $invoice->date = date('Y-m-d H:i:s', time());
    $invoice->amount = $paymentdetails['amount'];
    $invoice->save();

    $invoicedetails = $database->fetch_array($database->query("SELECT * FROM invoice WHERE applicant_id='".$user->applicant_id."'"));
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
        <link href="css/global-style.css" rel="stylesheet">
        <link href="css/invoice.css" rel="stylesheet">
        <style type="text/css">
            body{
              -webkit-print-color-adjust:exact;
            }
        	@media print{
                #Header, #Footer { display: none !important; }
        		.noprint{display:none}
        		.imgg{
            			margin-top:-900px; 
                        margin-left: 300px;
            			opacity:0.1; 
            			width:200px; 
            			display:inline-block !important;
        			} 
        		
                .table-striped tbody tr:nth-child(odd) td,
                .table-striped tbody tr:nth-child(odd) th {
                    background-color: #f9f9f9;
                }
        	}
        	.imgg{display:none;}
        </style>
    </head>
    <body>
        <div class="noprint">
        <?php  include_layout_template("header.php"); ?> 
            <div class="navbar">
                <div class="navbar-inner">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="home.php"><span><i class="icon-home"></i> </span> Home</a></li>
                    </ul>
                </div>
            </div>
        </div> 

        <!-- beginnning of main content -->

        <section class="slice">
                <!-- Invoice wrapper -->
                <div id="invoice" class="paid">
                    <div class="this-is" style="margin-bottom: 10px;">
                    
                        <strong> APPLICATION FORM INVOICE FOR <?= $sessiondetails['session']; ?> ACADEMIC SESSION</strong>
                    </div>
                    <header id="header">
                        <table width="100%">
                            <tr>
                                <td>
                                    <div class="invoice-intro">
                                        <h1>
                                            <img style="height:110px;" src="/mis.unijos.edu.ng/app_form_template/images/logo.png">
                                        </h1>
                                    </div>
                                </td>
                                <td width="50%">
                                    <dl class="invoice-meta">
                                        <dt class="invoice-number">Invoice #</dt>
                                        <dd><?= $student_status.$user->applicant_id.$invoicedetails['invoice_id']; ?></dd>
                                        <dt class="invoice-date">Date</dt>
                                        <dd><?= date('m-d-Y', strtotime($paymentdetails['payment_date'])); ?></dd>
                                        <dt class="invoice-due">Due Date</dt>
                                        <dd><?= date('m-d-Y', strtotime($paymentdetails['payment_date'])); ?></dd>
                                    </dl>
                                </td>
                            </tr>
                        </table>
                    </header>

                    <table width="100%" >
                        <tr>
                            <th align="left"><h2>Invoice To:</h2></th>
                            <th align="left"><h2>Invoice From:</h2></th>
                            <th align="left"><h3>Invoice Status</h3></th>
                        </tr>
                        <tr>
                            <td >
                                <div >
                                    
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
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div >
                                    
                                    <div id="hcard-Admiral-Valdore" class="vcard">
                                        <?php 
                                            if($student_status == 'PGA') {
                                                echo '<a class="url fn">School of Postgraduate Studies</a>';
                                            } else {
                                                echo '<a class="url fn">Non-NUC Funded Programmes</a>';
                                            }
                                        ?>
                                        <div class="org">University of Jos</div>
                                        <a class="email">PMB 2084 Jos, Jos.</a>
                                        
                                        <div class="adr">
                                            <div>Plateau State</div>
                                            <div>Nigeria</div>
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <td >
                                <div style="background: #008000; background: rgba(122,185,0,0.7); float:left;width:40%;padding-left: 5%; color: #fff;">
                                   
                                    <strong>Invoice is <em>Paid</em></strong>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <section class="invoice-financials" style="margin-top: 10px;">
                        <div class="invoice-items">
                            <table class="table table-striped">
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
                                        <td colspan="2"></td>
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

                            <div class="invoice-pay noprint">
                                <h5>Application Form Invoice</h5>
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

                        <table width="100%">
                            <tr>
                                <td>
                                    <div class="invoice-notes">
                                    
                                        <h6>Notes &amp; Information:</h6>
                                        <p>This is to certify that the Application form payments for  <?= $programmedetails['surname'].' '.$programmedetails['first_name'].' '.$programmedetails['middle_name']; ?>   <font style="color:#008000"> is genuine !</font></p>
                                        
                                    
                                    </div>
                                </td>
                                <td>
                                    <div class="pull-right" style="height:120px; width:100px; overflow:hidden; margin:auto; border:1px solid #ccc;">
                                        <p><img src="<?php echo 'passport/'.$programmedetails['filename']; ?>" alt="<?php echo $personal_details['caption']; ?>" title="<?php echo $personal_details['caption']; ?>" width="100" /></p>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div class="noprint">
                           <!-- <button class="btn btn-primary " onClick="window.print();" >PRINT</button>-->
                        </div>
                        <img src="/mis.unijos.edu.ng/app_form_template/images/logo.png" class="imgg">
                    </section>
                </div>
        </section>

        <!-- end of main content ->
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


<?php 
}else{
redirect_to('index.php');
}

?>