<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://phoeniixx.com/
 * @since      1.0.0
 *
 * @package    Phoen_Asonfw
 * @subpackage Phoen_Asonfw/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Phoen_Asonfw
 * @subpackage Phoen_Asonfw/admin
 * @author     phoeniixx <support@phoeniixx.com>
 */

class Phoen_Asonfw_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$enable_plugin = get_option( 'wc_settings_order_number_enable_plugin');

		define('plugins_url',plugin_dir_url(__FILE__));
		add_action( 'admin_menu', __CLASS__ . '::phoen_asonfw_fv_menu_page' );
		add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::phoen_asonfw_add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_settings_tab_order_number', __CLASS__ . '::phoen_asonfw_settings_tab' );
        add_action( 'woocommerce_update_options_settings_tab_order_number', __CLASS__ . '::phoen_asonfw_update_settings' );

		if($enable_plugin=='yes'){
			add_action('woocommerce_checkout_order_processed',__CLASS__ . '::phoen_asonfw_prefix_suffix', 10, 2);
			add_filter( 'woocommerce_order_number',__CLASS__ . '::phoen_asonfw_change_woocommerce_order_number');
		}
	}
	/**
	 * Register Admin menu function.
	 *
	 * @since    1.0.0
	 */
	// Admin menu function
	function phoen_asonfw_fv_menu_page(){
    add_menu_page( 
        __( 'Advanced Sequential Order Number ', 'textdomain' ),
        'Sequential Order Number ',
        'manage_options',
        'custompage',
        __CLASS__.'::phoen_asonfw_fv_setting',
        plugins_url.'images/icon1.png',
        59.9
    ); 
}	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/*
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Phoen_Advanced_Request_Quote_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Phoen_Advanced_Request_Quote_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'style.css', array(), $this->version, 'all' );

	}
	/**
	 * Create a general settings Tabs.
	 *
	 * @since    1.0.0
	 */
	public function phoen_asonfw_fv_setting(){

?>		
		<div class="wrap">
			<h2 class="nav-tab-wrapper">  
				<a href="admin.php?page=custompage&tab=tab1" <?php if($_GET['tab']=='tab2' || $_GET['tab']=='tab3' || $_GET['tab']=='tab4'){ ?> class="nav-tab" <?php }else{?> class="nav-tab nav-tab-active" <?php } ?>>How to install</a>  
				<a href="admin.php?page=custompage&tab=tab2" <?php if($_GET['tab']=='tab2'){ ?> class="nav-tab nav-tab-active" <?php }else{?> class="nav-tab" <?php } ?>>Premium</a>
				<a href="admin.php?page=custompage&tab=tab3" <?php if($_GET['tab']=='tab3'){ ?> class="nav-tab nav-tab-active" <?php }else{?> class="nav-tab" <?php } ?>>Support</a>
				<a href="admin.php?page=custompage&tab=tab4" <?php if($_GET['tab']=='tab4'){ ?> class="nav-tab nav-tab-active" <?php }else{?> class="nav-tab" <?php } ?>>Woocommerce App</a> 
			</h2>
		</div>
		<br>

<?php if($_GET['tab']=='tab3'){?>
	<!--Support Tab Settings -->		
	<form method="post" id="requestQouestForm" action enctype="multipart/form-data">
        <div class="main">
    		<div class="wrapper">
		        <div class="support-top-bar">
		            <ul>

		                <li><img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/live-chat.png"></li>
		                <li>Support:<span><a href="https://phoeniixx.com/product/custom-my-account-for-woocommerce/">Live Chat</a></span>

		                </li>
		            </ul>

		            <ul>
		                <li><img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/skype.png"></li>
		                <li>Skype:<span><a href="skype:support_65347?chat">support_65347</a></span></li>
		            </ul>

		            <ul>
		                <li><img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/whatsapp.png"></li>
		                <li>WhatsApp or Call:<span>+91 8860616134</span></li>
		            </ul>

		            <ul>
		                <li><img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/email.png"></li>
		                <li>Email Address:<span><a href="support@phoeniixx.com">support@phoeniixx.com</a></span></li>
		            </ul>
		        </div>

        		<a class="full-page-link" href="https://phoeniixx.com/wordpress-development-india/">
		            <div class="what-we-do">

		                <h2>We Expertize In</h2>

		                <div class="listing-nine-column">

		                    <ul>
		                        <li>
		                            <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Icon-1.png">
		                            <h5>Design and Develop WordPress based Websites </h5>
		                            <p>Phoeniixx Designs deliver interactive WordPress development services to help businesses drive forward in every sector. We build practically functional WordPress websites integrated with CMS capabilities and high performance algorithms.</p>
		                        </li>
		                    </ul>

		                    <ul>
		                        <li>
		                            <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Icon-2.png">
		                            <h5>Theme Customization </h5>
		                            <p>We provide theme customization services so that your website or blog gains effective and catchy online presence. Custom themes are designed by WP experts to match all your business needs.</p>
		                        </li>
		                    </ul>

		                    <ul>
		                        <li>
		                            <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/plugin.png">

		                            <h5>Plugin Customization </h5>
		                            <p>Plugin customization services are provided by highly experienced experts to expand the functionality of your website. We provide complete package of WP plugin development, installation, integration, upgrade, modification and enhancement services. </p>
		                        </li>
		                    </ul>

		                    <ul>
		                        <li>
		                            <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Icon-4.png">
		                            <h5>Ecommerce Website using WooCommerce </h5>
		                            <p>Our expert WordPress development services help you get fully functional ecommerce websites integrated with secure payment gateways. We build responsive UI designs to augment your online sales, consumer engagement and brand loyalty. </p>
		                        </li>
		                    </ul>

		                    <ul>
		                        <li>
		                            <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Icon-5.png">
		                            <h5>Custom WordPress Development </h5>
		                            <p>Phoeniixx Designs is a leading WordPress development company with spotless track record that aims to deliver an all-inclusive package of website development services at affordable price within stipulated time frame. </p>
		                        </li>
		                    </ul>

		                    <ul>
		                        <li>
		                            <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Icon-6.png">
		                            <h5>Wordpress Based Website Maintenance </h5>
		                            <p>We deliver complete website maintenance, migration and support solutions for your business right from addition/modification of content, image manipulation/addition to update/integration of new pages and database support &amp; management services. </p>
		                        </li>
		                    </ul>

		                    <ul>
		                        <li>
		                            <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Icon-7.png">
		                            <h5>PSD to WordPress </h5>
		                            <p>Phoeniixx Designs, as a renowned WordPress development company offers PSD to WordPress theme conversion services for personal blogs and corporate websites keeping in mind specific guidelines given by the client.</p>
		                        </li>
		                    </ul>

		                    <ul>
		                        <li>
		                            <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Icon-8.png">
		                            <h5>Hire Dedicated WordPress Developers </h5>
		                            <p>Hire industry experts for quality work and save a huge cost on WordPress development services. Get a complete package of WP solutions right from custom theme development to plugin installation for maximizing business ROI.</p>
		                        </li>
		                    </ul>

		                    <ul>
		                        <li>
		                            <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Icon-9.png">
		                            <h5>Mobile App for WordPress and Woocommerce </h5>
		                            <p>Get interactive mobile app development services including testing, security, integration, and quality assurance. We provide enhanced mobile app development solutions powered with specialized engineering capabilities and ongoing management of content. </p>
		                        </li>
		                    </ul>
		                </div>
		            </div>
        		</a>

    		</div>
		</div>
		 <style>
				 a.full-page-link {
				    text-decoration: none;
				}
				    .wrapper{
				        width: 90%;
				        margin: 0 auto;
				    }

				.support-top-bar{
				    display: flex;
				    flex-wrap: wrap;
				    margin-top: 20px;
				    /*justify-content: center;*/
				}
				.support-top-bar ul{
				    width: calc(27% - 20px);
				    display: flex;
				    align-items: center;
				    position: relative;
				    padding-right: 20px;
				    
				}
				.support-top-bar ul li{
				    font-family: montserrat;
				    font-size: 16px;
				    font-weight: 400;
				    word-break: break-word;
				}
				.support-top-bar ul li img{
				    margin-right: 5px;
				    width: 45px;
				    height: 46px;
				    object-fit: cover
				}

				.support-top-bar ul li span{
				    display: block;
				    font-family: montserrat;
				    font-size: 17px;
				    font-weight: 700;
				    text-decoration: underline;
				    margin-top: 5px;
				}
				.support-top-bar ul:after {
				    position: absolute;
				    right: 37px;
				    width: 1px;
				    height: 21px;
				    background: #cfcfcf;
				    content: "";
				}
				.support-top-bar ul:first-child{
				  width: 18%;
				}

				.support-top-bar ul:last-child:after{
				  content: none;
				  padding-right: 0px;
				}
				.support-top-bar ul:last-child {
				    padding-right: 0;
				}
				.support-top-bar ul li span a {
				    color: #424559;
				}
				.what-we-do h2 {
				    position: relative;
				    margin-bottom: 50px !important;
				    font-weight: 800;
				    padding-bottom: 10px;
				    text-transform: capitalize;
				    font-size: 48px;
				    text-align: center;
				    color: #424559;
				    font-family: Montserrat;
				    padding-bottom: 25px;
				}
				.what-we-do h2:before {
				    position: absolute;
				    content: "";
				    width: 55px;
				    height: 5px;
				    background: #424559;
				    left: 50%;
				    bottom: 0px;
				    transform: translateX(-50%);
				    border-radius: 50px;
				}

				.listing-nine-column ul li h5 {
				    font-family: Montserrat;
				    font-weight: 600;
				    font-size: 22px;
				    color: #424559;
				    line-height: 28px;
				    margin: 22px 0px;
				}
				.listing-nine-column {
				    display: flex;
				    flex-direction: row;
				    flex-wrap: wrap;
				}

				.listing-nine-column ul {
				    width: calc(33.3% - 17px);
				    padding-right:25px;
				}
				.listing-nine-column ul:nth-of-type(3n+3) {
				    padding-right: 0px;
				}
				.listing-nine-column ul li p{
				    font-family: Montserrat;
				    font-weight: 400;
				    font-size: 16px;
				    color: #575757;
				    line-height:23px;
				}
				.listing-nine-column  ul li img{
				  width: 84px;
				  height: 84px;
				  object-fit: cover;
				}

				.what-we-do {
				    background: #fff;
				    border-radius: 8px;
				    -webkit-box-shadow: 1px 1px 15px -1px rgba(0,0,0,0.75);
				    -moz-box-shadow: 1px 1px 15px -1px rgba(0,0,0,0.75);
				    box-shadow: 1px 1px 15px -1px rgba(0,0,0,0.75);
				    padding: 50px 30px 50px 30px !important;
				    margin: 40px 0px 120px 0px;
				}
		  </style>
	</form>	
<?php  }elseif($_GET['tab']=='tab2'){?>
		<!-- Premium Setting tab2 -->
		<form method="post" id="" action enctype="multipart/form-data">
        	<style>
				    ul.two-button li a:focus {
				    outline: none;
				    box-shadow: none;
				  }   

				  .premium .wrapper{
				        width: 100%;
				    }

				    .premium h1{
				    font-size: 48px;
				    line-height: 58px;
				    margin-top: 0px;
				    font-family: "Roboto Slab",palatino,serif;
				    color: #444444;
				    font-weight: 300;
				    letter-spacing: -.2px;
				}

				.top-left h1 span {
				    display: block;
				    margin-top: 21px;
				    font-size: 21px;
				    line-height: 28px;
				    font-weight: 400;
				}

				.premium p{
				       font-size: 18px;
				       font-weight: 300;
				       line-height: 22px;
				       font-family: Roboto,arial,sans-serif;
				       color: #444444;

				}
				.premium .wrapper img{
				    max-width: 100%!important;
				}

				.premium .top {
				    display: flex;
				    align-items: center;
				    padding: 80px 20px 80px 50px;
				    
				}

				.premium .top-left{
				    width: 50%;
				    /*padding-right: 50px;*/
				    padding-right: 2%;
				}

				..premium top-left ul.listing-alpha{
				  padding-left: 20px;
				}
				.premium .top-left ul.listing-alpha li {
				    font-size: 17px;
				    font-weight: 300;
				    line-height: 22px;
				    font-family: Roboto,arial,sans-serif;
				    color: #444444;
				}

				.premium .top-right-image{
				    /*width: calc(100% - 55%);*/
				    /*padding-left:90px;*/
				    text-align: left;
				    /*width: 44%;*/
				    width: calc(100% - 53%);
				}
				.premium .site-width {
				    margin: 0 auto;
				    width: 100%;
				}

				.premium .top-section,
				.premium .bootom-section {
				    background: #fff;
				}

				.premium .middle-section{
				    /*min-height: 600px;*/
				}

				.middle-section.light-grey {
				    background: #f6f6f6;
				}


				.premium ul.two-button li a {
				     text-decoration: none;
				    font-size: 18px;
				     padding: 10px 20px;
				     font-family: "Roboto Slab",palatino,serif;
				}

				.premium ul.two-button li:nth-of-type(1) a{
				  color: #fff;
				  background:#e7803e;
				  border:1px solid #e7803e;
				}

				.premium ul.two-button li:nth-of-type(2) a{
				  color: #000;
				  background:#fff;
				  border: 1px solid #000;
				  margin-left: 5px;
				}

				.premium .top-button {
				    padding-top: 30px;
				    padding-bottom:20px;    
				}


				.premium ul.two-button{
				  display: flex;
				  justify-content: center;
				}
				a.msg91 {
				    text-decoration: none;
				    padding: 9px 19px;
				    display: inline-block;
				    color: #fff;
				    background: #e7803e;
				    font-weight: 500;
				    margin-left: 10px;
				    border-radius: 5px;
				}
				a.msg91:hover {
				    color:#fff;
				}

			</style>
			<!-- Premium Tab2 -->
			<div class="main premium">
			    <div class="wrapper">

			        <div class="top-section">
			            <div class="site-width">
			                <div class="top-button">
			                    <ul class="two-button">
			                        <li><a target="_blank" href="https://phoeniixx.com/product/advanced-sequential-order-number-pro-for-woocommerce/">UPGRADE TO PREMIUM VERSION</a></li>
			                        <li><a target="_blank" href="https://ordersequentialpro.phoeniixxdemo.com/wp-admin/">LIVE DEMO</a></li>
			                    </ul>

			                </div>
			            </div>
			        </div>

			        <div class="top-section">
			            <div class="site-width">
			                <div class="top">

			                    <div class="top-left">
			                        <h1>2 Types of Counter Available – Sequential and Random</h1>

			                    </div>

			                    <div class="top-right-image">
			                        <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Counter-type.png">

			                    </div>
			                </div>
			            </div>
			        </div>

			        <div class="middle-section light-grey">
			            <div class="site-width">
			                <div class="top">

			                    <div class="top-left">
			                        <h1>Set Order Number Width</h1>

			                    </div>

			                    <div class="top-right-image">

			                        <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/order-number-width.jpg">

			                    </div>
			                </div>
			            </div>
			        </div>

			        <div class="middle-section light-grey">
			            <div class="site-width">
			                <div class="top">

			                    <div class="top-left">
			                        <h1>3 Types of Reset Counter – Daily, Monthly and Yearly</h1>

			                    </div>

			                    <div class="top-right-image">

			                        <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Reset-Counter.jpg">

			                    </div>
			                </div>
			            </div>
			        </div>

			        <div class="middle-section light-grey">
			            <div class="site-width">
			                <div class="top">

			                    <div class="top-left">
			                        <h1>Free Order Identifier</h1>

			                    </div>

			                    <div class="top-right-image">

			                        <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/Free-order identifier.png">

			                    </div>
			                </div>
			            </div>
			        </div>

			        <div class="middle-section light-grey">
			            <div class="site-width">
			                <div class="top">

			                    <div class="top-left">
			                        <h1>Fields to edit the Prefix/Suffix Text For Order Number and Order Date</h1>

			                    </div>

			                    <div class="top-right-image">
			                        <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/fields-to-edit-suffix-prefix.jpg">

			                    </div>
			                </div>
			            </div>
			        </div>

			        <div class="middle-section light-grey">
			            <div class="site-width">
			            </div>
			        </div>

			        <div class="bootom-section">
			            <div class="site-width">
			                <div class="top-button bottom-button">
			                    <ul class="two-button">
			                        <li><a target="_blank" href="https://phoeniixx.com/product/advanced-sequential-order-number-pro-for-woocommerce/">UPGRADE TO PREMIUM VERSION</a></li>
			                        <li><a target="_blank" href="https://ordersequentialpro.phoeniixxdemo.com/wp-admin/">LIVE DEMO</a></li>
			                    </ul>

			                </div>
			            </div>
			        </div>

			    </div>

			</div>
		</form>	
<?php  }elseif($_GET['tab']=='tab4'){?>
	<form method="post" id="" action enctype="multipart/form-data">
		<!--Woocommerce tab  Settings -->
	        <style>
				        /* wocommerce  css*/
				.wrapper.mains{
				    width: 100%;
				}
				h1.main-h {
				    font-size: 48px;
				    line-height: 58px;
				    margin-top: 0px;
				    font-family: "Roboto Slab",palatino,serif;
				    color: #444444;
				    font-weight: 300;
				    letter-spacing: -.2px;
				}
				.wrapper.mains p {
				    font-size: 18px;
				    font-weight: 300;
				    line-height: 22px;
				    font-family: Roboto,arial,sans-serif;
				    color: #444444;
				}
				.site-width {
				    margin: 0 auto;
				    width: auto;
				    padding: 0px 20px 0px 60px;
				}
				.top-section, .bootom-section {
				    background: #fff;
				}
				.top {
				    display: flex;
				    align-items: center;
				    padding: 80px 0px;
				}
				.top-left {
				    width: 55%;
				    padding-right: 50px;
				}
				ul.android-ios {
				    display: flex;
				    margin-top: 60px;
				    flex-wrap: wrap;
				}
				.wrapper.mains dd, li {
				    margin-bottom: 6px;
				}
				ul.android-ios {
				    display: flex;
				    margin-top: 60px;
				    flex-wrap: wrap;
				}
				ul.android-ios li a {
				    text-decoration: none;
				    font-size: 21px;
				    padding: 10px 20px;
				    font-family: "Roboto Slab",palatino,serif;
				}
				ul.woo-app-page li:nth-of-type(1) a {
				    color: #000!important;
				    background: #fff!important;
				    border: 1px solid #000!important;
				}
				ul.android-ios li:nth-of-type(2) a {
				    color: #000;
				    background: #fff;
				    border: 1px solid #000;
				    margin-left: 15px;
				}
				ul.android-ios li:nth-of-type(3) a {
				    color: #fff;
				    background: #e7803e;
				    border: 1px solid #e7803e;
				    margin-left: 0px;
				}
				ul.android-ios li:nth-of-type(3) {
				    margin-top: 35px;
				}
				ul.android-ios li:nth-of-type(1) a {
				    color: #fff;
				    background: #e7803e;
				    border: 1px solid #e7803e;
				}
	        </style>
		<div class="main">
		    <div class="wrapper mains">

		        <div class="top-section">
		            <div class="site-width">
		                <div class="top">
		                    <div class="top-left">

		                        <h1 class="main-h">Woocommerce Mobile App for Android  and iOS</h1>
		                        <p>Your WooCommerce store will be converted into an app. Connect to your WooCommerce store sync with your store Products.</p>
		                        <ul class="android-ios woo-app-page">
		                            <li><a target="_blank" href="https://play.google.com/store/apps/details?id=com.phoeniixx.wooapp">Download Android App Demo</a></li>
		                            <li><a target="_blank" href="https://itunes.apple.com/in/app/woocommerce-app-by-phoeniixx/id1435904750?mt=8">Download iOS App Demo</a></li>
		                            <li>
		                                <a target="_blank" href="https://phoeniixx.com/woo-app/">Buy Now</a></li>
		                        </ul>
		                    </div>

		                    <div class="top-right-image">

		                        <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/App-1-2.png">

		                    </div>
		                </div>
		            </div>
		        </div>

		        <div class="middle-section light-grey">
		            <div class="site-width">
		                <div class="top">
		                    <div class="top-left">
		                        <h1 class="main-h">Woocommerce Admin App for Android and iOS</h1>
		                        <p>Admin app for WooCommmerce is an amazing app which helps the administrator to manage all his woocommerce store work from mobile. It lets you see Sales, Orders , customer details , reports and charts. It Lets you edit and update the Products.Just download this app and connect your WooCommerce store.</p>

		                        <ul class="android-ios">
		                            <li><a target="_blank" href="https://play.google.com/store/apps/details?id=com.phoeniixx.wooadmin">Download Android</a></li>
		                            <li><a target="_blank" href="https://itunes.apple.com/in/app/woocommerce-admin/id1451481017?mt=8">Download iOS</a></li>
		                        </ul>

		                    </div>

		                    <div class="top-right-image">
		                        <img src="/wp-content/plugins/advanced-sequential-order-number-for-woocommerce/admin/images/App-2-3.png">

		                    </div>
		                </div>
		            </div>
		        </div>

		    </div>

		</div>
	</form>	
<?php  }else{?>
 	<!-- How to install (tab 1) -->
	<form method="post" id="" action enctype="multipart/form-data">
		    <style>
				        .site-width {
				    margin: 0 auto;
				    width: 100%;
				}
				.main-wrapper.free .top-button {
				    padding-top: 30px;
				    padding-bottom: 20px;
				}
				.main-wrapper.free ul.two-button {
				    display: block;
				    justify-content: center;
				    line-height: 60px;
				}
				.main-wrapper.free ul.two-button li:nth-of-type(1) a {
				    color: #fff;
				    background: #e7803e;
				    border: 1px solid #e7803e;
				}
				.main-wrapper.free ul.two-button li:nth-of-type(2) a {
				    color: #000;
				    background: #fff;
				    border: 1px solid #000;
				    margin-left: 5px;
				}
				.main-wrapper.free ul.two-button li a {
				    text-decoration: none;
				    font-size: 18px;
				    padding: 10px 20px;
				    font-family: "Roboto Slab",palatino,serif;
				}
				h3.instruction {
				    font-size: 30px;
				    margin-bottom: 35px;
				    margin-top: 40px;
				}
		    </style>
			<div class="main-wrapper free">
			    <div class="site-width">
			        <div class="top-button bottom-button">
			        <h3 class="instruction">INSTRUCTION TO INSTALL PLUGIN</h3>
			            <ul class="two-button">
			                <li><a target="_blank" href="https://phoeniixx.com/wp-content/uploads/2020/02/Advanced-Sequential-Order-Number-for-woocommerce-free.pdf">DOCUMENTATION</a></li>
			            </ul>

			            <h3 class="instruction">FREE VERSION LIVE DEMO</h3>
			            <ul class="two-button">
			                <li><a target="_blank" href="https://ordersequential.phoeniixxdemo.com/wp-admin/">FREE VERSION LIVE</a></li>
			                
			            </ul>

			        </div>
			    </div>
			</div>
	</form>	
<?php	}

	} 
	/**
	 * Set the _order_number field for the newly created order
	 *
	 * @param int $ordernumber_id post identifier
	 * @param \WP_Post $post post object
	 */
	
	function phoen_asonfw_prefix_suffix($ordernumber_id){
		global $wpdb;
		
		// Get Data by ID
		
		$order_prefix = get_option( 'wc_settings_order_number_order_prefix');
		$order_suffix = get_option('wc_settings_order_number_order_suffix');
		$counter_type = get_option('wc_settings_order_number_counter');
		$order_format = get_option('wc_settings_order_number_order_format');
		$order_number_width = get_option('wc_settings_order_number_width');
		$start_order_number = get_option('wc_settings_order_number_start_order_number');
		
		// Order Date create suffixx
		$order = wc_get_order( $ordernumber_id );
		$order_date = $order->get_date_created();
		$date_suffix = $order_date->date($date);
		
		// Order Date create suffixx
		$order_date_pre = $order->get_date_created();
		$date_prefix = $order_date->date($date_pre);

		
		// Fix Counter type order number Sequential Or Random
		if($counter_type == 'sequential'){
			
			// Default Start order number
			$result = $start_order_number; 
			
			// Get Order Number Create from wpdb by ID & Date
			$table_prefix = $wpdb->prefix;
			$query     = "SELECT ID FROM {$table_prefix}posts WHERE post_date LIKE '%".$date_created."%' AND post_type='shop_order' ORDER BY ID ";
			$result  += @count($wpdb->get_results( $query ));
		}else {
			$result = $ordernumber_id;
		}

		// Width of order number
		$numlength = mb_strlen($result);
		if($order_number_width <= $numlength){
			$result;
		}elseif($order_number_width > $numlength){
			$num_padded = sprintf("%0".$order_number_width."d", $result);
			$result = $num_padded;
		}


		$new_order_id = str_replace('{prefix}',$order_prefix,$order_format);
		$new_order_id = str_replace('{suffix}',$order_suffix,$new_order_id);
		$new_order_id = str_replace('{order_number}',$result,$new_order_id);
		
		update_post_meta($ordernumber_id,'new_order_id',$new_order_id);
	}

	function phoen_asonfw_change_woocommerce_order_number($ordernumber_id) {
		global $wpdb;
		// Get Data by ID        
		$new_order_id = get_post_meta($ordernumber_id,'new_order_id',true);
		
		if($new_order_id){
			return $new_order_id;
		}

		return $ordernumber_id;
				
	}
			
	/**
	 * Save all the admin setting data.
	 *
	 * @since    1.0.0
	 */
	public static function phoen_asonfw_add_settings_tab( $settings_tabs ) {
        $settings_tabs['settings_tab_order_number'] = __( 'Order Number', 'phoen-asonfw' );
        return $settings_tabs;
    }

	public static function phoen_asonfw_settings_tab (){

		woocommerce_admin_fields( self::phoen_asonfw_get_settings() );

	}
	public static function phoen_asonfw_update_settings() {

        woocommerce_update_options( self::phoen_asonfw_get_settings() );
    }

    public static function phoen_asonfw_get_settings() {
 						
    $settings = array(
            'section_title' => array(
                'name'     => __( 'Order Number', 'phoen-asonfw' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wc_settings_order_number_section_title'
            ),
            'enable_plugin' => array(
            	'name' => __( 'Enable Plugin', 'phoen-asonfw' ),
                'type' => 'checkbox',
                'default'=>'yes',
                'desc' => __( 'Enable', 'phoen-asonfw' ),
                'id'   => 'wc_settings_order_number_enable_plugin'
            ),
            'counter' => array(
            	'name' => __( 'Counter Type', 'phoen-asonfw' ),
                'type' => 'select',
                'desc_tip' => __('This is order Choose counter type','phoen-asonfw'),
                'desc' => __( 'Choose counter type.', 'phoen-asonfw' ),
                'id'   => 'wc_settings_order_number_counter',
                'options' => array(
                			'sequential'=>__('Sequential','phoen-asonfw'),
                			'random'=>__('Random','phoen-asonfw')
            				),
                'default'=>'Sequential',
            ),
            'order_format' => array(
                'name' => __( 'Order Number Format', 'phoen-asonfw' ),
                'type' => 'text',
                'default'=>'{prefix}{order_number}{suffix}',
                'desc_tip' =>__('This is order number format, feel the format like Sample format that given below as like you want.','phoen-asonfw'),
                'desc' => __( 'Sample format : {prefix}{suffix}{order_number}.', 'phoen-asonfw' ),
                'id'   => 'wc_settings_order_number_order_format',
            ),
            'order_number_width' => array(
            	'name' => __( 'Order Number Width', 'phoen-asonfw' ),
                'type' => 'number',
                'custom_attributes' => array(
		            'step' => '1',
		            'min' => '0'
       			 ),
                'min' => '0',
                'default'=>'3',
                'desc_tip' => __('This is Order Number Width,E.g. set to 4 to have order number displayed as 0001 instead of 1.','phoen-asonfw'),
                'desc' => __( 'Fill Order Number Width E.g. set to 4 to have order number displayed as 0001.', 'phoen-asonfw' ),
                'id'   => 'wc_settings_order_number_width',    
            ),
            'start_order_number' => array(
                'name' => __( 'Start From Order Number', 'phoen-asonfw' ),
				'type' => 'number',
				'default' => '1',
                'custom_attributes' => array(
		            'step' => '1',
		            'min' => '1'
       			),
                'default'=>'1',
                'desc_tip' => __( 'The starting number for the incrementing portion of the order numbers, unless there is an existing order with a higher number.', 'phoen-asonfw' ),
                'desc' => __( 'Sample Order Number : #phoen-101-07012020.', 'phoen-asonfw' ),
                'id'   => 'wc_settings_order_number_start_order_number'
            ),
            'order_prefix' => array(
                'name' => __( 'Order Number Prefix', 'phoen-asonfw' ),
                'type' => 'text',
                'default'=>'phoen-',
                'desc_tip' => __( 'Set a text to be used as prefix in order number. Leave it blank if no prefix has to be used.', 'phoen-asonfw' ),
                'desc' => __( 'This is prefix order number- E.g. phoen- or PHOEN-.', 'phoen-asonfw' ),
                'id'   => 'wc_settings_order_number_order_prefix'
            ),
            
           	'order_suffix' => array(
                'name' => __( 'Order Number Suffix', 'phoen-asonfw' ),
                'type' => 'text',
                'default'=>'',
                'desc_tip' => __( 'Set a text to be used as suffix in order number. Leave it blank if no suffix has to be used.', 'phoen-asonfw' ),
                'desc' => __( 'This is suffix order number E.g. order- Or ORDER- etc.', 'phoen-asonfw' ),
                'id'   => 'wc_settings_order_number_order_suffix'
            ),
           
            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wc_settings_order_number_section_end'
            )
        );
		   // $orderNum = get_option( 'wc_settings_order_number_order');
   		// 	echo $orderNum;
        return apply_filters( 'wc_settings_tabs_order_number_settings', $settings );
    }
}
