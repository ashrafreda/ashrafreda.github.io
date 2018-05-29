<?php
session_start();

require_once('php/simple-php-captcha/simple-php-captcha.php');
require_once('php/php-mailer/PHPMailerAutoload.php');

// Step 1 - Enter your email address below.
$email = 'you@domain.com';

// If the e-mail is not working, change the debug option to 2 | $debug = 2;
$debug = 0;

if(isset($_POST['emailSent'])) {

	$subject = $_POST['subject'];

	// Step 2 - If you don't want a "captcha" verification, remove that IF.
	if (strtolower($_POST['captcha']) == strtolower($_SESSION['captcha']['code'])) {

		// Step 3 - Configure the fields list that you want to receive on the email.
		$fields = array(
			0 => array(
				'text' => 'Name',
				'val' => $_POST['name']
			),
			1 => array(
				'text' => 'Email address',
				'val' => $_POST['email']
			),
			2 => array(
				'text' => 'Message',
				'val' => $_POST['message']
			),
			3 => array(
				'text' => 'Checkboxes',
				'val' => implode($_POST['checkboxes'], ", ")
			),
			4 => array(
				'text' => 'Radios',
				'val' => $_POST['radios']
			)
		);

		$message = '';

		foreach($fields as $field) {
			$message .= $field['text'].": " . htmlspecialchars($field['val'], ENT_QUOTES) . "<br>\n";
		}

		$mail = new PHPMailer(true);

		try {

			$mail->SMTPDebug = $debug;                            // Debug Mode

			// Step 3 (Optional) - If you don't receive the email, try to configure the parameters below:

			//$mail->IsSMTP();                                         // Set mailer to use SMTP
			//$mail->Host = 'mail.yourserver.com';				       // Specify main and backup server
			//$mail->SMTPAuth = true;                                  // Enable SMTP authentication
			//$mail->Username = 'user@example.com';                    // SMTP username
			//$mail->Password = 'secret';                              // SMTP password
			//$mail->SMTPSecure = 'tls';                               // Enable encryption, 'ssl' also accepted
			//$mail->Port = 587;   								       // TCP port to connect to

			$mail->AddAddress($email);	 						       // Add a recipient

			//$mail->AddAddress('person2@domain.com', 'Person 2');     // Add another recipient
			//$mail->AddCC('person3@domain.com', 'Person 3');          // Add a "Cc" address. 
			//$mail->AddBCC('person4@domain.com', 'Person 4');         // Add a "Bcc" address. 

			$mail->SetFrom($email, $_POST['name']);
			$mail->AddReplyTo($_POST['email'], $_POST['name']);

			$mail->IsHTML(true);                                  // Set email format to HTML

			$mail->CharSet = 'UTF-8';

			$mail->Subject = $subject;
			$mail->Body    = $message;

			// Step 4 - If you don't want to attach any files, remove that code below
			if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
				$mail->AddAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
			}

			$mail->Send();

			$arrResult = array ('response'=>'success');

		} catch (phpmailerException $e) {
			$arrResult = array ('response'=>'error','errorMessage'=>$e->errorMessage());
		} catch (Exception $e) {
			$arrResult = array ('response'=>'error','errorMessage'=>$e->getMessage());
		}

	} else {

		$arrResult = array ('response'=>'captchaError');

	}

}
?>
<!DOCTYPE html>
<!-- devcode: !production --><html><!-- endcode --><!-- devcode: production --><html><!-- endcode -->
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Contact Us Advanced | Porto - Responsive HTML5 Template 6.0.0</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/animate/animate.min.css">
		<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">
		
		<!-- Demo CSS -->


		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css"> 

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.min.js"></script>

	</head>
	<body>

		<div class="body">
			<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 55, 'stickySetTop': '-55px', 'stickyChangeLogo': true}">
				<div class="header-body">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="index.html">
											<img alt="Porto" width="111" height="54" data-sticky-width="82" data-sticky-height="40" data-sticky-top="33" src="img/logo.png">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row pt-3">
									<nav class="header-nav-top">
										<ul class="nav nav-pills">
											<li class="nav-item d-none d-sm-block">
												<a class="nav-link" href="about-us.html"><i class="fa fa-angle-right"></i> About Us</a>
											</li>
											<li class="nav-item d-none d-sm-block">
												<a class="nav-link" href="contact-us.html"><i class="fa fa-angle-right"></i> Contact Us</a>
											</li>
											<li class="nav-item">
												<span class="ws-nowrap"><i class="fa fa-phone"></i> (123) 456-789</span>
											</li>
										</ul>
									</nav>
									<div class="header-search d-none d-md-block">
										<form id="searchForm" action="page-search-results.html" method="get">
											<div class="input-group">
												<input type="text" class="form-control" name="q" id="q" placeholder="Search..." required>
												<span class="input-group-btn">
													<button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
												</span>
											</div>
										</form>
									</div>
								</div>
								<div class="header-row">
									<div class="header-nav">
										<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle" href="index.html">
															Home
														</a>
														<ul class="dropdown-menu">
															<li>
																<a class="dropdown-item" href="index.html">
																	Landing Page
																</a>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="index-classic.html">Classic</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="index-classic.html" data-thumb-preview="img/previews/preview-classic.jpg">Classic - Original</a></li>
																	<li><a class="dropdown-item" href="index-classic-color.html" data-thumb-preview="img/previews/preview-classic-color.jpg">Classic - Color</a></li>
																	<li><a class="dropdown-item" href="index-classic-light.html" data-thumb-preview="img/previews/preview-classic-light.jpg">Classic - Light</a></li>
																	<li><a class="dropdown-item" href="index-classic-video.html" data-thumb-preview="img/previews/preview-classic-video.jpg">Classic - Video</a></li>
																	<li><a class="dropdown-item" href="index-classic-video-light.html" data-thumb-preview="img/previews/preview-classic-video-light.jpg">Classic - Video - Light</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="index-corporate.html">Corporate <span class="tip tip-dark">hot</span></a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="index-corporate.html" data-thumb-preview="img/previews/preview-corporate.jpg">Corporate - Version 1</a></li>
																	<li><a class="dropdown-item" href="index-corporate-2.html" data-thumb-preview="img/previews/preview-corporate-version2.jpg">Corporate - Version 2</a></li>
																	<li><a class="dropdown-item" href="index-corporate-3.html" data-thumb-preview="img/previews/preview-corporate-version3.jpg">Corporate - Version 3</a></li>
																	<li><a class="dropdown-item" href="index-corporate-4.html" data-thumb-preview="img/previews/preview-corporate-version4.jpg">Corporate - Version 4</a></li>
																	<li><a class="dropdown-item" href="index-corporate-5.html" data-thumb-preview="img/previews/preview-corporate-version5.jpg">Corporate - Version 5</a></li>
																	<li><a class="dropdown-item" href="index-corporate-6.html" data-thumb-preview="img/previews/preview-corporate-version6.jpg">Corporate - Version 6</a></li>
																	<li><a class="dropdown-item" href="index-corporate-7.html" data-thumb-preview="img/previews/preview-corporate-version7.jpg">Corporate - Version 7</a></li>
																	<li><a class="dropdown-item" href="index-corporate-8.html" data-thumb-preview="img/previews/preview-corporate-version8.jpg">Corporate - Version 8</a></li>
																	<li><a class="dropdown-item" href="index-corporate-hosting.html" data-thumb-preview="img/previews/preview-corporate-hosting.jpg">Corporate - Hosting</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">One Page</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="index-one-page.html" data-thumb-preview="img/previews/preview-one-page.jpg">One Page Original</a></li>
																</ul>
															</li>
														</ul>
													</li>
													<li class="">
														<a class="nav-link" href="demos.html">
															Demos
														</a>
													</li>
													<li class="dropdown dropdown-mega">
														<a class="dropdown-item dropdown-toggle" href="#">
															Shortcodes
														</a>
														<ul class="dropdown-menu">
															<li>
																<div class="dropdown-mega-content">
																	<div class="row">
																		<div class="col-lg-3">
																			<span class="dropdown-mega-sub-title">Shortcodes 1</span>
																			<ul class="dropdown-mega-sub-nav">
																				<li><a class="dropdown-item" href="shortcodes-accordions.html">Accordions</a></li>
																				<li><a class="dropdown-item" href="shortcodes-toggles.html">Toggles</a></li>
																				<li><a class="dropdown-item" href="shortcodes-tabs.html">Tabs</a></li>
																				<li><a class="dropdown-item" href="shortcodes-icons.html">Icons</a></li>
																				<li><a class="dropdown-item" href="shortcodes-icon-boxes.html">Icon Boxes</a></li>
																				<li><a class="dropdown-item" href="shortcodes-carousels.html">Carousels</a></li>
																				<li><a class="dropdown-item" href="shortcodes-modals.html">Modals</a></li>
																				<li><a class="dropdown-item" href="shortcodes-lightboxes.html">Lightboxes</a></li>
																			</ul>
																		</div>
																		<div class="col-lg-3">
																			<span class="dropdown-mega-sub-title">Shortcodes 2</span>
																			<ul class="dropdown-mega-sub-nav">
																				<li><a class="dropdown-item" href="shortcodes-buttons.html">Buttons</a></li>
																				<li><a class="dropdown-item" href="shortcodes-badges.html">Badges</a></li>
																				<li><a class="dropdown-item" href="shortcodes-lists.html">Lists</a></li>
																				<li><a class="dropdown-item" href="shortcodes-image-gallery.html">Image Gallery</a></li>
																				<li><a class="dropdown-item" href="shortcodes-image-frames.html">Image Frames</a></li>
																				<li><a class="dropdown-item" href="shortcodes-testimonials.html">Testimonials</a></li>
																				<li><a class="dropdown-item" href="shortcodes-blockquotes.html">Blockquotes</a></li>
																				<li><a class="dropdown-item" href="shortcodes-word-rotator.html">Word Rotator</a></li>
																			</ul>
																		</div>
																		<div class="col-lg-3">
																			<span class="dropdown-mega-sub-title">Shortcodes 3</span>
																			<ul class="dropdown-mega-sub-nav">
																				<li><a class="dropdown-item" href="shortcodes-call-to-action.html">Call to Action</a></li>
																				<li><a class="dropdown-item" href="shortcodes-pricing-tables.html">Pricing Tables</a></li>
																				<li><a class="dropdown-item" href="shortcodes-tables.html">Tables</a></li>
																				<li><a class="dropdown-item" href="shortcodes-progressbars.html">Progress Bars</a></li>
																				<li><a class="dropdown-item" href="shortcodes-counters.html">Counters</a></li>
																				<li><a class="dropdown-item" href="shortcodes-sections-parallax.html">Sections &amp; Parallax</a></li>
																				<li><a class="dropdown-item" href="shortcodes-tooltips-popovers.html">Tooltips &amp; Popovers</a></li>
																				<li><a class="dropdown-item" href="shortcodes-sticky-elements.html">Sticky Elements</a></li>
																			</ul>
																		</div>
																		<div class="col-lg-3">
																			<span class="dropdown-mega-sub-title">Shortcodes 4</span>
																			<ul class="dropdown-mega-sub-nav">
																				<li><a class="dropdown-item" href="shortcodes-headings.html">Headings</a></li>
																				<li><a class="dropdown-item" href="shortcodes-dividers.html">Dividers</a></li>
																				<li><a class="dropdown-item" href="shortcodes-animations.html">Animations</a></li>
																				<li><a class="dropdown-item" href="shortcodes-medias.html">Medias</a></li>
																				<li><a class="dropdown-item" href="shortcodes-maps.html">Maps</a></li>
																				<li><a class="dropdown-item" href="shortcodes-arrows.html">Arrows</a></li>
																				<li><a class="dropdown-item" href="shortcodes-alerts.html">Alerts</a></li>
																				<li><a class="dropdown-item" href="shortcodes-posts.html">Posts</a></li>
																			</ul>
																		</div>
																	</div>
																</div>
															</li>
														</ul>
													</li>
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle" href="#">
															Features
														</a>
													
														<ul class="dropdown-menu">
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Headers</a>
																<ul class="dropdown-menu">
																	<li class="dropdown-submenu">
																		<a class="dropdown-item" href="#">Default</a>
																		<ul class="dropdown-menu">
																			<li><a class="dropdown-item" href="index-classic.html">Default</a></li>
																			<li><a class="dropdown-item" href="index-header-language-dropdown.html">Default + Language Dropdown</a></li>
																			<li><a class="dropdown-item" href="index-header-big-logo.html">Default + Big Logo</a></li>
																		</ul>
																	</li>
																	<li class="dropdown-submenu">
																		<a class="dropdown-item" href="#">Flat</a>
																		<ul class="dropdown-menu">
																			<li><a class="dropdown-item" href="index-header-flat.html">Flat</a></li>
																			<li><a class="dropdown-item" href="index-header-flat-top-bar.html">Flat + Top Bar</a></li>
																			<li><a class="dropdown-item" href="index-header-flat-colored-top-bar.html">Flat + Colored Top Bar</a></li>
																			<li><a class="dropdown-item" href="index-header-flat-top-bar-search.html">Flat + Top Bar with Search</a></li>
																		</ul>
																	</li>
																	<li><a class="dropdown-item" href="index-header-center.html">Center</a></li>
																	<li><a class="dropdown-item" href="index-header-below-slider.html">Below Slider</a></li>
																	<li><a class="dropdown-item" href="index-header-full-video.html">Full Video</a></li>
																	<li><a class="dropdown-item" href="index-header-narrow.html">Narrow</a></li>
																	<li><a class="dropdown-item" href="index-header-always-sticky.html">Always Sticky</a></li>
																	<li class="dropdown-submenu">
																		<a class="dropdown-item" href="#">Transparent</a>
																		<ul class="dropdown-menu">
																			<li><a class="dropdown-item" href="index-header-transparent.html">Transparent</a></li>
																			<li><a class="dropdown-item" href="index-header-transparent-bottom-border.html">Transparent - Bottom Border</a></li>
																			<li><a class="dropdown-item" href="index-header-semi-transparent.html">Semi Transparent</a></li>
																			<li><a class="dropdown-item" href="index-header-semi-transparent-light.html">Semi Transparent - Light</a></li>
																		</ul>
																	</li>
																	<li><a class="dropdown-item" href="index-header-full-width.html">Full-Width</a></li>
																	<li class="dropdown-submenu">
																		<a class="dropdown-item" href="#">Navbar</a>
																		<ul class="dropdown-menu">
																			<li><a class="dropdown-item" href="index-header-navbar.html">Navbar</a></li>
																			<li><a class="dropdown-item" href="index-header-navbar-extra-info.html">Navbar + Extra Info</a></li>
																		</ul>
																	</li>
																	<li class="dropdown-submenu">
																		<a class="dropdown-item" href="#">Side Header</a>
																		<ul class="dropdown-menu">
																			<li><a class="dropdown-item" href="index-header-side-header-left.html">Side Header Left</a></li>
																			<li><a class="dropdown-item" href="index-header-side-header-right.html">Side Header Right</a></li>
																			<li><a class="dropdown-item" href="index-header-side-header-semi-transparent.html">Side Header Semi Transparent</a></li>
																		</ul>
																	</li>
																	<li><a class="dropdown-item" href="index-header-signin.html">Sign In / Sign Up</a></li>
																	<li><a class="dropdown-item" href="index-header-logged.html">Logged</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Navigations</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="index-classic.html">Default</a></li>
																	<li><a class="dropdown-item" href="index-navigation-stripe.html">Stripe</a></li>
																	<li><a class="dropdown-item" href="index-navigation-top-line.html">Top Line</a></li>
																	<li><a class="dropdown-item" href="index-navigation-dark-dropdown.html">Dark Dropdown</a></li>
																	<li><a class="dropdown-item" href="index-navigation-colors.html">Colors</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Footers</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="index-classic.html#footer">Default</a></li>
																	<li><a class="dropdown-item" href="index-footer-advanced.html#footer">Advanced</a></li>
																	<li><a class="dropdown-item" href="index-footer-simple.html#footer">Simple</a></li>
																	<li><a class="dropdown-item" href="index-footer-light.html#footer">Light</a></li>
																	<li><a class="dropdown-item" href="index-footer-light-narrow.html#footer">Light Narrow</a></li>
																	<li class="dropdown-submenu">
																		<a class="dropdown-item" href="#">Colors</a>
																		<ul class="dropdown-menu">
																			<li><a class="dropdown-item" href="index-footer-color-primary.html#footer">Primary Color</a></li>
																			<li><a class="dropdown-item" href="index-footer-color-secondary.html#footer">Secondary Color</a></li>
																			<li><a class="dropdown-item" href="index-footer-color-tertiary.html#footer">Tertiary Color</a></li>
																			<li><a class="dropdown-item" href="index-footer-color-quaternary.html#footer">Quaternary Color</a></li>
																		</ul>
																	</li>
																	<li><a class="dropdown-item" href="index-footer-latest-work.html#footer">Latest Work</a></li>
																	<li><a class="dropdown-item" href="index-footer-contact-form.html#footer">Contact Form</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Page Headers</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="index-page-header-default.html">Default</a></li>
																	<li class="dropdown-submenu">
																		<a class="dropdown-item" href="#">Colors</a>
																		<ul class="dropdown-menu">
																			<li><a class="dropdown-item" href="index-page-header-color-primary.html">Primary Color</a></li>
																			<li><a class="dropdown-item" href="index-page-header-color-secondary.html">Secondary Color</a></li>
																			<li><a class="dropdown-item" href="index-page-header-color-tertiary.html">Tertiary Color</a></li>
																			<li><a class="dropdown-item" href="index-page-header-color-quaternary.html">Quaternary Color</a></li>
																		</ul>
																	</li>
																	<li><a class="dropdown-item" href="index-page-header-light.html">Light</a></li>
																	<li><a class="dropdown-item" href="index-page-header-light-reverse.html">Light - Reverse</a></li>
																	<li><a class="dropdown-item" href="index-page-header-custom-background.html">Custom Background</a></li>
																	<li><a class="dropdown-item" href="index-page-header-parallax.html">Parallax</a></li>
																	<li><a class="dropdown-item" href="index-page-header-center.html">Center</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Admin Extension <span class="tip tip-dark">hot</span> <em class="not-included">(Not Included)</em></a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="feature-admin-forms-basic.html">Forms Basic</a></li>
																	<li><a class="dropdown-item" href="feature-admin-forms-advanced.html">Forms Advanced</a></li>
																	<li><a class="dropdown-item" href="feature-admin-forms-wizard.html">Forms Wizard</a></li>
																	<li><a class="dropdown-item" href="feature-admin-forms-code-editor.html">Code Editor</a></li>
																	<li><a class="dropdown-item" href="feature-admin-tables-advanced.html">Tables Advanced</a></li>
																	<li><a class="dropdown-item" href="feature-admin-tables-responsive.html">Tables Responsive</a></li>
																	<li><a class="dropdown-item" href="feature-admin-tables-editable.html">Tables Editable</a></li>
																	<li><a class="dropdown-item" href="feature-admin-tables-ajax.html">Tables Ajax</a></li>
																	<li><a class="dropdown-item" href="feature-admin-charts.html">Charts</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Sliders</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="index-classic.html">Revolution Slider</a></li>
																	<li><a class="dropdown-item" href="index-slider-nivo.html">Nivo Slider</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Layout Options</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="feature-layout-boxed.html">Boxed</a></li>
																	<li><a class="dropdown-item" href="feature-layout-dark.html">Dark</a></li>
																	<li><a class="dropdown-item" href="feature-layout-rtl.html">RTL</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Extra</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="feature-typography.html">Typography</a></li>
																	<li><a class="dropdown-item" href="feature-grid-system.html">Grid System</a></li>
																	<li><a class="dropdown-item" href="feature-page-loading.html">Page Loading</a></li>
																	<li><a class="dropdown-item" href="feature-lazy-load.html">Lazy Load</a></li>
																</ul>
															</li>
														</ul>
													</li>
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle" href="#">
															Pages
														</a>
														<ul class="dropdown-menu">
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">About Us</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="about-us.html">About Us</a></li>
																	<li><a class="dropdown-item" href="about-us-basic.html">About Us - Basic</a></li>
																	<li><a class="dropdown-item" href="about-me.html">About Me</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Shop</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="shop-full-width.html">Shop - Full Width</a></li>
																	<li><a class="dropdown-item" href="shop-sidebar.html">Shop - Sidebar</a></li>
																	<li><a class="dropdown-item" href="shop-product-full-width.html">Shop - Product Full Width</a></li>
																	<li><a class="dropdown-item" href="shop-product-sidebar.html">Shop - Product Sidebar</a></li>
																	<li><a class="dropdown-item" href="shop-cart.html">Shop - Cart</a></li>
																	<li><a class="dropdown-item" href="shop-login.html">Shop - Login</a></li>
																	<li><a class="dropdown-item" href="shop-checkout.html">Shop - Checkout</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Blog</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="blog-full-width.html">Blog Full Width</a></li>
																	<li><a class="dropdown-item" href="blog-large-image.html">Blog Large Image</a></li>
																	<li><a class="dropdown-item" href="blog-medium-image.html">Blog Medium Image</a></li>
																	<li><a class="dropdown-item" href="blog-timeline.html">Blog Timeline</a></li>
																	<li><a class="dropdown-item" href="blog-post.html">Single Post</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Layouts</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="page-full-width.html">Full Width</a></li>
																	<li><a class="dropdown-item" href="page-left-sidebar.html">Left Sidebar</a></li>
																	<li><a class="dropdown-item" href="page-right-sidebar.html">Right Sidebar</a></li>
																	<li><a class="dropdown-item" href="page-left-and-right-sidebars.html">Left and Right Sidebars</a></li>
																	<li><a class="dropdown-item" href="page-sticky-sidebar.html">Sticky Sidebar</a></li>
																	<li><a class="dropdown-item" href="page-secondary-navbar.html">Secondary Navbar</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Extra</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="page-404.html">404 Error</a></li>
																	<li><a class="dropdown-item" href="page-coming-soon.html">Coming Soon</a></li>
																	<li><a class="dropdown-item" href="page-maintenance-mode.html">Maintenance Mode</a></li>
																	<li><a class="dropdown-item" href="sitemap.html">Sitemap</a></li>
																</ul>
															</li>
															<li><a class="dropdown-item" href="page-custom-header.html">Custom Header</a></li>
															<li><a class="dropdown-item" href="page-team.html">Team</a></li>
															<li><a class="dropdown-item" href="page-services.html">Services</a></li>
															<li><a class="dropdown-item" href="page-careers.html">Careers</a></li>
															<li><a class="dropdown-item" href="page-our-office.html">Our Office</a></li>
															<li><a class="dropdown-item" href="page-faq.html">FAQ</a></li>
															<li><a class="dropdown-item" href="page-login.html">Login / Register</a></li>
														</ul>
													</li>
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle" href="#">
															Portfolio
														</a>
														<ul class="dropdown-menu">
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Single Project</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="portfolio-single-small-slider.html">Small Slider</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-wide-slider.html">Wide Slider</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-full-width-slider.html">Full Width Slider</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-gallery.html">Gallery</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-carousel.html">Carousel</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-medias.html">Medias</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-full-width-video.html">Full Width Video</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-masonry-images.html">Masonry Images</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-left-sidebar.html">Left Sidebar</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-right-sidebar.html">Right Sidebar</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-left-and-right-sidebars.html">Left and Right Sidebars</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-sticky-sidebar.html">Sticky Sidebar</a></li>
																	<li><a class="dropdown-item" href="portfolio-single-extended.html">Extended</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Grid Layouts</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="portfolio-grid-1-column.html">1 Column</a></li>
																	<li><a class="dropdown-item" href="portfolio-grid-2-columns.html">2 Columns</a></li>
																	<li><a class="dropdown-item" href="portfolio-grid-3-columns.html">3 Columns</a></li>
																	<li><a class="dropdown-item" href="portfolio-grid-4-columns.html">4 Columns</a></li>
																	<li><a class="dropdown-item" href="portfolio-grid-5-columns.html">5 Columns</a></li>
																	<li><a class="dropdown-item" href="portfolio-grid-6-columns.html">6 Columns</a></li>
																	<li><a class="dropdown-item" href="portfolio-grid-no-margins.html">No Margins</a></li>
																	<li><a class="dropdown-item" href="portfolio-grid-full-width.html">Full Width</a></li>
																	<li><a class="dropdown-item" href="portfolio-grid-full-width-no-margins.html">Full Width No Margins</a></li>
																	<li><a class="dropdown-item" href="portfolio-grid-1-column-title-and-description.html">Title and Description</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Masonry Layouts</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="portfolio-masonry-2-columns.html">2 Columns</a></li>
																	<li><a class="dropdown-item" href="portfolio-masonry-3-columns.html">3 Columns</a></li>
																	<li><a class="dropdown-item" href="portfolio-masonry-4-columns.html">4 Columns</a></li>
																	<li><a class="dropdown-item" href="portfolio-masonry-5-columns.html">5 Columns</a></li>
																	<li><a class="dropdown-item" href="portfolio-masonry-6-columns.html">6 Columns</a></li>
																	<li><a class="dropdown-item" href="portfolio-masonry-no-margins.html">No Margins</a></li>
																	<li><a class="dropdown-item" href="portfolio-masonry-full-width.html">Full Width</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Sidebar Layouts</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="portfolio-sidebar-left.html">Left Sidebar</a></li>
																	<li><a class="dropdown-item" href="portfolio-sidebar-right.html">Right Sidebar</a></li>
																	<li><a class="dropdown-item" href="portfolio-sidebar-left-and-right.html">Left and Right Sidebars</a></li>
																	<li><a class="dropdown-item" href="portfolio-sidebar-sticky.html">Sticky Sidebar</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Ajax</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="portfolio-ajax-page.html">Ajax on Page</a></li>
																	<li><a class="dropdown-item" href="portfolio-ajax-modal.html">Ajax on Modal</a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a class="dropdown-item" href="#">Extra</a>
																<ul class="dropdown-menu">
																	<li><a class="dropdown-item" href="portfolio-extra-timeline.html">Timeline</a></li>
																	<li><a class="dropdown-item" href="portfolio-extra-lightbox.html">Lightbox</a></li>
																	<li><a class="dropdown-item" href="portfolio-extra-load-more.html">Load More</a></li>
																	<li><a class="dropdown-item" href="portfolio-extra-infinite-scroll.html">Infinite Scroll</a></li>
																	<li><a class="dropdown-item" href="portfolio-extra-pagination.html">Pagination</a></li>
																	<li><a class="dropdown-item" href="portfolio-extra-combination-filters.html">Combination Filters</a></li>
																</ul>
															</li>
														</ul>
													</li>
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle active" href="#">
															Contact Us
														</a>
														<ul class="dropdown-menu">
															<li><a class="dropdown-item" href="contact-us.html">Contact Us - Basic</a></li>
															<li><a class="dropdown-item" href="contact-us-advanced.php">Contact Us - Advanced</a></li>
														</ul>
													</li>
												</ul>
											</nav>
										</div>
										<ul class="header-social-icons social-icons d-none d-sm-block">
											<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
											<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
											<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
										</ul>
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
											<i class="fa fa-bars"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col">
								<ul class="breadcrumb">
									<li><a href="#">Home</a></li>
									<li class="active">Contact Us</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h1>Contact Us Advanced</h1>
							</div>
						</div>
					</div>
				</section>

				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
				<div id="googlemaps" class="google-map"></div>

				<div class="container">

					<div class="row mt-5 pt-2">
						<div class="col-md-6">

							<div class="offset-anchor" id="contact-sent"></div>

							<?php
							if (isset($arrResult)) {
								if($arrResult['response'] == 'success') {
								?>
								<div class="alert alert-success" id="contactSuccess">
									<strong>Success!</strong> Your message has been sent to us.
								</div>
								<?php
								} else if($arrResult['response'] == 'error') {
								?>
								<div class="alert alert-danger" id="contactError">
									<strong>Error!</strong> There was an error sending your message.
									<span class="font-size-xs mt-2 d-block" id="mailErrorMessage"><?php echo $arrResult['errorMessage'];?></span>
								</div>
								<?php
								} else if($arrResult['response'] == 'captchaError') {
								?>
								<div class="alert alert-danger" id="contactError">
									<strong>Error!</strong> Verification failed.
								</div>
								<?php
								}
							}
							?>

							<h2 class="mb-3"><strong>Contact</strong> Us</h2>

							<form id="contactFormAdvanced" action="<?php echo basename($_SERVER['PHP_SELF']); ?>#contact-sent" method="POST" enctype="multipart/form-data">
								<input type="hidden" value="true" name="emailSent" id="emailSent">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label>Your name *</label>
										<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
									</div>
									<div class="form-group col-md-6">
										<label>Your email address *</label>
										<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<label>Subject</label>
										<select data-msg-required="Please enter the subject." class="form-control" name="subject" id="subject" required>
											<option value="">...</option>
											<option value="Option 1">Option 1</option>
											<option value="Option 2">Option 2</option>
											<option value="Option 3">Option 3</option>
											<option value="Option 4">Option 4</option>
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<p class="mb-2">Checkboxes</p>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" name="checkboxes[]" type="checkbox" data-msg-required="Please select at least one option." id="inlineCheckbox1" value="option1"> 1
											</label>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" name="checkboxes[]" type="checkbox" data-msg-required="Please select at least one option." id="inlineCheckbox1" value="option2"> 2
											</label>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" name="checkboxes[]" type="checkbox" data-msg-required="Please select at least one option." id="inlineCheckbox1" value="option3"> 3
											</label>
										</div>
									</div>
									<div class="form-group col-md-6">
										<p class="mb-2">Radios</p>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="radios" data-msg-required="Please select at least one option." id="inlineRadio1" value="option1"> 1
											</label>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="radios" data-msg-required="Please select at least one option." id="inlineRadio2" value="option2"> 2
											</label>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="radios" data-msg-required="Please select at least one option." id="inlineRadio3" value="option3"> 3
											</label>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<label>Attachment</label>
										<input class="d-block" type="file" name="attachment" id="attachment">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12 mb-4">
										<label>Message *</label>
										<textarea maxlength="5000" data-msg-required="Please enter your message." rows="6" class="form-control" name="message" id="message" required></textarea>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12 mb-0">
										<label>Human Verification *</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-4">
										<div class="captcha form-control">
											<div class="captcha-image">
												<?php
												$_SESSION['captcha'] = simple_php_captcha(array(
													'min_length' => 6,
													'max_length' => 6,
													'min_font_size' => 22,
													'max_font_size' => 22,
													'angle_max' => 3
												));

												$_SESSION['captchaCode'] = $_SESSION['captcha']['code'];

												echo '<img id="captcha-image" src="' . "php/simple-php-captcha/simple-php-captcha.php/" . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
												?>
											</div>
											<div class="captcha-refresh">
												<a href="#" id="refreshCaptcha"><i class="fa fa-refresh"></i></a>
											</div>
										</div>
									</div>
									<div class="form-group col-md-8">
										<input type="text" value="" maxlength="6" data-msg-captcha="Wrong verification code." data-msg-required="Please enter the verification code." placeholder="Type the verification code." class="form-control form-control-lg captcha-input" name="captcha" id="captcha" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<hr>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<input type="submit" id="contactFormSubmit" value="Send Message" class="btn btn-primary btn-lg pull-right" data-loading-text="Loading...">
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-6">

							<h4 class="heading-primary">Get in <strong>Touch</strong></h4>
							<p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat urna arcu, vel molestie nunc commodo non. Nullam vestibulum odio vitae fermentum rutrum.</p>

							<p>Mauris lobortis nulla ut aliquet interdum. Donec commodo ac elit sed placerat. Mauris rhoncus est ac sodales gravida. In eros felis, elementum aliquam nisi vel, pellentesque faucibus nulla.</p>

							<hr>

							<h4 class="heading-primary">The <strong>Office</strong></h4>
							<ul class="list list-icons list-icons-style-3 mt-4">
								<li><i class="fa fa-map-marker"></i> <strong>Address:</strong> 1234 Street Name, City Name, United States</li>
								<li><i class="fa fa-phone"></i> <strong>Phone:</strong> (123) 456-789</li>
								<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:mail@example.com">mail@example.com</a></li>
							</ul>

							<div class="row lightbox mt-4" data-plugin-options="{'delegate': 'a', 'type': 'image', 'gallery': {'enabled': true}}">
								<div class="col-md-4 mb-4 mb-md-0">
									<a class="img-thumbnail d-block" href="img/office/our-office-1.jpg" data-plugin-options="{'type':'image'}">
										<img class="img-fluid" src="img/office/our-office-1.jpg" alt="Office">
										<span class="zoom">
											<i class="fa fa-search"></i>
										</span>
									</a>
								</div>
								<div class="col-md-4 mb-4 mb-md-0">
									<a class="img-thumbnail d-block" href="img/office/our-office-2.jpg" data-plugin-options="{'type':'image'}">
										<img class="img-fluid" src="img/office/our-office-2.jpg" alt="Office">
										<span class="zoom">
											<i class="fa fa-search"></i>
										</span>
									</a>
								</div>
								<div class="col-md-4">
									<a class="img-thumbnail d-block" href="img/office/our-office-3.jpg" data-plugin-options="{'type':'image'}">
										<img class="img-fluid" src="img/office/our-office-3.jpg" alt="Office">
										<span class="zoom">
											<i class="fa fa-search"></i>
										</span>
									</a>
								</div>
							</div>

							<hr>

							<h4 class="heading-primary">Business <strong>Hours</strong></h4>
							<ul class="list list-icons list-dark mt-4">
								<li><i class="fa fa-clock-o"></i> Monday - Friday - 9am to 5pm</li>
								<li><i class="fa fa-clock-o"></i> Saturday - 9am to 2pm</li>
								<li><i class="fa fa-clock-o"></i> Sunday - Closed</li>
							</ul>

						</div>
					</div>

				</div>

			</div>

			<footer id="footer">
				<div class="container">
					<div class="row">
						<div class="footer-ribbon">
							<span>Get in Touch</span>
						</div>
						<div class="col-lg-3">
							<div class="newsletter">
								<h4>Newsletter</h4>
								<p>Keep up on our always evolving product features and technology. Enter your e-mail and subscribe to our newsletter.</p>
			
								<div class="alert alert-success d-none" id="newsletterSuccess">
									<strong>Success!</strong> You've been added to our email list.
								</div>
			
								<div class="alert alert-danger d-none" id="newsletterError"></div>
			
								<form id="newsletterForm" action="php/newsletter-subscribe.php" method="POST">
									<div class="input-group">
										<input class="form-control form-control-sm" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
										<span class="input-group-btn">
											<button class="btn btn-light" type="submit">Go!</button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-3">
							<h4>Latest Tweets</h4>
							<div id="tweet" class="twitter" data-plugin-tweets data-plugin-options="{'username': '', 'count': 2}">
								<p>Please wait...</p>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="contact-details">
								<h4>Contact Us</h4>
								<ul class="contact">
									<li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong> 1234 Street Name, City Name, United States</p></li>
									<li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> (123) 456-789</p></li>
									<li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:mail@example.com">mail@example.com</a></p></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-2">
							<h4>Follow Us</h4>
							<ul class="social-icons">
								<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
								<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
								<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-lg-1">
								<a href="index.html" class="logo">
									<img alt="Porto Website Template" class="img-fluid" src="img/logo-footer.png">
								</a>
							</div>
							<div class="col-lg-7">
								<p>© Copyright 2017. All Rights Reserved.</p>
							</div>
							<div class="col-lg-4">
								<nav id="sub-menu">
									<ul>
										<li><a href="page-faq.html">FAQ's</a></li>
										<li><a href="sitemap.html">Sitemap</a></li>
										<li><a href="contact-us.html">Contact</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/jquery.appear/jquery.appear.min.js"></script>
		<script src="vendor/jquery.easing/jquery.easing.min.js"></script>
		<script src="vendor/jquery-cookie/jquery-cookie.min.js"></script>
		<script src="vendor/popper/umd/popper.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/common/common.min.js"></script>
		<script src="vendor/jquery.validation/jquery.validation.min.js"></script>
		<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
		<script src="vendor/jquery.gmap/jquery.gmap.min.js"></script>
		<script src="vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
		<script src="vendor/isotope/jquery.isotope.min.js"></script>
		<script src="vendor/owl.carousel/owl.carousel.min.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="vendor/vide/vide.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>

		<!-- Current Page Vendor and Views -->
		<script src="js/views/view.contact.js"></script>
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
		<script>

			/*
			Map Settings

				Find the Latitude and Longitude of your address:
					- http://universimmedia.pagesperso-orange.fr/geo/loc.htm
					- http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

			*/

			// Map Markers
			var mapMarkers = [{
				address: "217 Summit Boulevard, Birmingham, AL 35243",
				html: "<strong>Alabama Office</strong><br>217 Summit Boulevard, Birmingham, AL 35243<br><br><a href='#' onclick='mapCenterAt({latitude: 33.44792, longitude: -86.72963, zoom: 16}, event)'>[+] zoom here</a>",
				icon: {
					image: "img/pin.png",
					iconsize: [26, 46],
					iconanchor: [12, 46]
				}
			},{
				address: "645 E. Shaw Avenue, Fresno, CA 93710",
				html: "<strong>California Office</strong><br>645 E. Shaw Avenue, Fresno, CA 93710<br><br><a href='#' onclick='mapCenterAt({latitude: 36.80948, longitude: -119.77598, zoom: 16}, event)'>[+] zoom here</a>",
				icon: {
					image: "img/pin.png",
					iconsize: [26, 46],
					iconanchor: [12, 46]
				}
			},{
				address: "New York, NY 10017",
				html: "<strong>New York Office</strong><br>New York, NY 10017<br><br><a href='#' onclick='mapCenterAt({latitude: 40.75198, longitude: -73.96978, zoom: 16}, event)'>[+] zoom here</a>",
				icon: {
					image: "img/pin.png",
					iconsize: [26, 46],
					iconanchor: [12, 46]
				}
			}];

			// Map Initial Location
			var initLatitude = 37.09024;
			var initLongitude = -95.71289;

			// Map Extended Settings
			var mapSettings = {
				controls: {
					panControl: true,
					zoomControl: true,
					mapTypeControl: true,
					scaleControl: true,
					streetViewControl: true,
					overviewMapControl: true
				},
				scrollwheel: false,
				markers: mapMarkers,
				latitude: initLatitude,
				longitude: initLongitude,
				zoom: 5
			};

			var map = $('#googlemaps').gMap(mapSettings),
				mapRef = $('#googlemaps').data('gMap.reference');

			// Map Center At
			var mapCenterAt = function(options, e) {
				e.preventDefault();
				$('#googlemaps').gMap("centerAt", options);
			}

			// Styles from https://snazzymaps.com/
			var styles = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];

			var styledMap = new google.maps.StyledMapType(styles, {
				name: 'Styled Map'
			});

			mapRef.mapTypes.set('map_style', styledMap);
			mapRef.setMapTypeId('map_style');

		</script>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->

	</body>
</html>
