<?php
/**
 * Plugin Name: Get Popup Leads
 * Plugin URI: https://5starprocessing.com/
 * Description: Custom plugin by: DIPIKA
 * Version: 1.0
 * Author: Dipika
 * Author URI: https://5starprocessing.com/
 */

register_activation_hook ( __FILE__, 'on_activate' );

function on_activate() {

}

add_action('wp_footer','popup_open_three_times_func');
function popup_open_three_times_func(){ ?>
    <div class="exit-poup-code-wrap">    
        <div class="popup-content-area" style="position:relative;">
          <span class="popup_exit_close">X</span>       
            <h2>
                Apply for your Merchant Account today !
            </h2>
          <?php //echo do_shortcode('[wpforms id="1116"]'); ?>
              <input type="text" name="fullname_custom" id="full_n_c" placeholder="Enter Full name" /><br/><br/>
              <input type="email" name="email_custom" id="full_e_c" placeholder="Enter Email"  /><br/><br/>
              <input type="text" name="phonenumber_custom" id="full_pn_c" placeholder="Enter phone Number"  /><br/><br/>
              <input type="text" name="companyname_custom" id="full_cn_c" placeholder="Enter company Number" /><br/><br/>
              <input type="text" name="website_custom" id="full_web_c" placeholder="Enter Website Number" /><br/><br/>
              <p>What do you need help with ? *</p>
              <select name="needhelp_box" id="needhelp_box">
                    <option>Select Any One</option>
                    <option value="Payment Processing, Business Credit Card, Business / Personal Loan, Credit Monitoring">Select all</option>
                    <option value="Payment Processing">Payment Processing</option>
                    <option value="Business Credit Card">Business Credit Card</option>
                    <option value="Business / Personal Loan">Business / Personal Loan</option>
                    <option value="Credit Monitoring">Credit Monitoring</option>
              </select><br/><br/>
              <button id="but_popup_leads">Submit Now</button>
       </div>
    </div>
    <style type="text/css">
        .exit-poup-code-wrap {
            top: 0px;
            width: 100%;
            height: 100vh;
            background: rgb(255 255 255 / 25%);
            z-index: 99999;
            position: fixed;
            align-items: center;
            justify-content: center;
            color: rgb(255, 255, 255);
            display: none;
        }
        .popup-content-area p {
            font-size: 17px;
            color: #ffffff;
            font-weight: 200;
        }
        .popup-content-area {
            background-repeat: no-repeat !important;
            background-size: cover !important;
            border-radius: 15px;
            width: 100%;
            max-width: 50%;
            margin: 0px auto;
        }
        .popup-content-area img {
            width: 100%;
            max-width: 240px;
        }
            label.wpforms-field-label-inline {
        color: #000000;
        }
        .popup-content-area h2 {
            color: #000000;
            font-weight: 800;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-top: 0;
            padding-top: 27px;
            padding-bottom: 0;
            margin-bottom: 10px;
        }
          .popup-content-area h3 {
            color: #05171e;
            padding: 10px 50px;
            background: #a4c33a;
            width: 100%;
            max-width: fit-content;
            margin: 20px auto;
            font-weight: 500;
            font-size: 23px;
            letter-spacing: 1px;
        }
        .popup-content-area {
            background-repeat: no-repeat !important;
            background-size: cover !important;
            border-radius: 15px;
            background: #ffffff;
            padding: 30px;
            border: 20px solid #000;
        }
        span.popup_exit_close {
            cursor: pointer;
            position: absolute;
            top: 0;
            right: 0;
            background: #ffffff;
            line-height: 0;
            padding: 22px;
            color: #000;
            font-weight: bold;
        }
        .popup-content-area p {
            color: #000;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 0;
            font-size: 12px;
        }
        /* Changing media query from 600 to 780px due to caching issues  */
        @media only screen and (max-width: 780px) {
            .popup-content-area {
            
            max-width: 90%;
        }
        }
    </style>
    <script type="text/javascript">
        jQuery('document').ready(function($){
            setInterval(function(){ 
                var popupCounter = localStorage.getItem("popupCounter");        
                if (popupCounter == '' || popupCounter == null) {
                    setTimeout(function(){
                        jQuery('.exit-poup-code-wrap').fadeIn();
                        $('.popup_exit_close').on('click',function(){
                            localStorage.setItem("popupCounter",'1');
                            
                        });                 
                    }, 2000);               
                }
                if(popupCounter == '1'){
                    setTimeout(function(){
                        jQuery('.exit-poup-code-wrap').fadeIn();
                        $('.popup_exit_close').on('click',function(){
                            localStorage.setItem("popupCounter",'2');
                        });     
                    }, 45000);
                }
                if(popupCounter == '2'){
                    setTimeout(function(){
                        jQuery('.exit-poup-code-wrap').fadeIn();
                        $('.popup_exit_close').on('click',function(){
                            localStorage.setItem("popupCounter",'3');
                        });                 
                    }, 90000);
                }
                if(popupCounter == '3'){
                //  do nothing      
                return false;
                    clearInterval();
                }
                  console.log('hi');
            }, 3000);
            $('body').on('click','.popup_exit_close', function(){
                $('.exit-poup-code-wrap').fadeOut();
                window.location.href="";
            });
            $('#but_popup_leads').on('click',function(){
                var name = $('#full_n_c').val();
                var email = $('#full_e_c').val();
                var phone = $('#full_pn_c').val();
                var company = $('#full_cn_c').val();
                var needhelp = $('#needhelp_box').val();
                var web = $("#full_web_c").val();
                var referrer = window.location.href;
                jQuery.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: { action: 'add_form_lead_popup' , name: name, email: email, phone: phone, company: company,website: web, needhelp: needhelp,referrer:referrer }
                  }).done(function( msg ) {
                    if(msg == 'success'){
                        $('#but_popup_leads').after('<p style="color:green;">Thank You for your response</p>');
                        setTimeout(function(){
                            $('.popup_exit_close').trigger('click');              
                        }, 5000);                          
                    }                         
                 });
            });
        });
    </script>
<?php }

add_action('wp_head', 'add_cart_ajaxurl');

function add_cart_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_ajax_add_form_lead_popup', 'add_form_lead_popup_func');
add_action( 'wp_ajax_nopriv_add_form_lead_popup', 'add_form_lead_popup_func' );

function add_form_lead_popup_func(){  
    if ( ! empty($_POST['email'] ) ) {
        global $wpdb;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $company = $_POST['company'];
        $website = $_POST['website'];
        $needhelp = $_POST['needhelp'];
        $referrer = $_POST['referrer'];

        $sql = "INSERT INTO popup_leads (fullname, email, phonenumber,companyname, website, needhelp, referrer) VALUES ('".$name."','".$email."','".$phone."','".$company."','".$website."','".$needhelp."','".$referrer."' )";
        $query = $wpdb->query($sql);
        if($query == 1){
            $to = 'lgoalead@gmail.com,nicksleads@robot.zapier.com,Colossusanirudh@gmail.com';
            $message = "
                <html>
                <head>
                <title>5starprocessing</title>
                </head>
                <body>
                <table border='1'>
                <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Company Name</th>
                <th>Website</th>
                <th>Need help for</th>
                <th>Referrer</th>
                </tr>
                <tr>
                <td>".$name."</td>
                <td>".$email."</td>
                <td>".$phone."</td>
                <td>".$company."</td>
                <td>".$website."</td>
                <td>".$needhelp."</td>
                <td>".$referrer."</td>
                </tr>
                </table>
                </body>
                </html>
                ";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            wp_mail( $to, '5 star processing', $message, $headers );
            echo 'success';
        }
        
    }
 
    // Don't forget to always exit in the ajax function.
    exit();

}

add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');
 
function wpdocs_register_my_custom_submenu_page() {
    add_submenu_page(
        'tools.php',
        'Form Leads',
        'Form Leads',
        'manage_options',
        'popup-leads-url',
        'popup_slug_leads_func' );
}
 
function popup_slug_leads_func() {
global $wpdb;
$results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM popup_leads") );
?>
    <div class="wrap"><div id="icon-tools" class="icon32"></div>
        <h2>Form Leads</h2>
        <div id="event-table">
        <table>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Company</th>
            <th>Website</th>
            <th>Need help </th>
            <th>referrer</th>
          </tr>
          <?php
          foreach ($results as $result) {

                $name = $result->fullname;
                $email = $result->email;
                $phone = $result->phonenumber;
                $company = $result->companyname;
                $website = $result->website;
                $needhelp = $result->needhelp;
                $referrer = $result->referrer; ?>
                <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $email; ?></td>     
                    <td><?php echo $phone; ?></td>
                    <td><?php echo $company; ?></td>
                    <td><?php echo $website; ?></td>
                    <td><?php echo $needhelp; ?></td>
                    <td><?php echo $referrer; ?></td>
                </tr>
          <?php }
          ?>            
          
        </table>
         </div>
    </div>
    <style type="text/css">
        table, th, td {
          border: 1px solid black;
          padding-right: 10px;
          padding-left: 10px; 
        }
        table {
            border-collapse: collapse;
        }

        tr:nth-child(even) {
          background-color: lightgrey;
        }

        th {
          background-color: skyblue;
        }
    </style>
<?php }