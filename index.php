<!-- PHP INCLUDES -->

<?php

    include "connect.php";
    include 'Includes/functions/functions.php';
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";


    //Getting website settings

    $stmt_web_settings = $con->prepare("SELECT * FROM website_settings");
    $stmt_web_settings->execute();
    $web_settings = $stmt_web_settings->fetchAll();

    $restaurant_name = "";
    $restaurant_email = "";
    $restaurant_address = "";
    $restaurant_phonenumber = "";

    foreach ($web_settings as $option)
    {
        if($option['option_name'] == 'restaurant_name')
        {
            $restaurant_name = $option['option_value'];
        }

        elseif($option['option_name'] == 'restaurant_email')
        {
            $restaurant_email = $option['option_value'];
        }

        elseif($option['option_name'] == 'restaurant_phonenumber')
        {
            $restaurant_phonenumber = $option['option_value'];
        }
        elseif($option['option_name'] == 'restaurant_address')
        {
            $restaurant_address = $option['option_value'];
        }
    }

?>

	<!-- HOME SECTION -->

	<section class="home-section" id="home">
		<div class="container">
			<div class="row" style="flex-wrap: nowrap;">
				<div class="col-md-6 home-left-section">
					<div style="padding: 100px 0px; color: white;">
						<h1>
							KAMP LILIM.
						</h1>
						<h2>
							TARA KAMP TAYO!
						</h2>
						<hr>
						<p>
							Flavors that Ignite Adventure 
						</p>
						<div style="display: flex;">
							<a href="order_food.php" target="_blank" class="bttn_style_1" style="margin-right: 10px; display: flex;justify-content: center;align-items: center;">
								Order Now
								<i class="fas fa-angle-left"></i>
							</a>
							<a href="login.php" target="_blank" class="bttn_style_2" style="display: flex;justify-content: center;align-items: center;">
								Reserve Table
								<i class="fas fa-angle-left"></i>
							</a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>

	<!-- OUR QUALITIES SECTION -->

	<section class="our_qualities" style="padding:100px 0px;">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/2.png" >
	                    <div class="caption">
	                        <h3>
							Myka Abad
	                        </h3>
	                        <p>
							Ambience is cozy and insta-worthy! Their pizza is really really good huhu. Must try!
	                        </p>
	                    </div>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/1.png" >
	                    <div class="caption">
	                        <h3>
	                            Jachelle Anne Matuto
	                        </h3>
	                        <p>
							Ang cutie ng place! Ang ganda rin ng customer service nila + food is really good! Babalik-balikan. <3
	                        </p>
	                    </div>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/5.png" >
	                    <div class="caption">
	                        <h3>
	                            Queen Valerie Lawaan
	                        </h3>
	                        <p>
							Recommended dating spot! Ganda ng place and yung food and drinks nila is ok din. Ganda ng ambience, very comfy!
	                        </p>
	                    </div>
	                </div>
				</div>
			</div>
		</div>
	</section>

	<!-- OUR MENUS SECTION -->

	<section class="our_menus" id="menus">
		<div class="container">
			<h2 style="text-align: center;margin-bottom: 30px">DISCOVER OUR MENUS</h2>
			<div class="menus_tabs">
				<div class="menus_tabs_picker">
					<ul style="text-align: center;margin-bottom: 70px">
						<?php

	                        $stmt = $con->prepare("Select * from menu_categories");
	                        $stmt->execute();
	                        $rows = $stmt->fetchAll();
	                        $count = $stmt->rowCount();

	                        $x = 0;

	                        foreach($rows as $row)
	                        {
	                        	if($x == 0)
	                        	{
	                        		echo "<li class = 'menu_category_name tab_category_links active_category' onclick=showCategoryMenus(event,'".str_replace(' ', '', $row['category_name'])."')>";
	                        			echo $row['category_name'];
	                        		echo "</li>";

	                        	}
	                        	else
	                        	{
	                        		echo "<li class = 'menu_category_name tab_category_links' onclick=showCategoryMenus(event,'".str_replace(' ', '', $row['category_name'])."')>";
	                        			echo $row['category_name'];
	                        		echo "</li>";
	                        	}

	                        	$x++;
	                     		
	                        }
						?>
					</ul>
				</div>

				<div class="menus_tab">
					<?php
                
                        $stmt = $con->prepare("Select * from menu_categories");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        $count = $stmt->rowCount();

                        $i = 0;

                        foreach($rows as $row) 
                        {

                            if($i == 0)
                            {

                                echo '<div class="menu_item  tab_category_content" id="'.str_replace(' ', '', $row['category_name']).'" style=display:block>';

                                    $stmt_menus = $con->prepare("Select * from menus where category_id = ?");
                                    $stmt_menus->execute(array($row['category_id']));
                                    $rows_menus = $stmt_menus->fetchAll();

                                    if($stmt_menus->rowCount() == 0)
                                    {
                                        echo "<div style='margin:auto'>No Available Menus for this category!</div>";
                                    }

                                    echo "<div class='row'>";
	                                    foreach($rows_menus as $menu)
	                                    {
	                                        ?>

	                                            <div class="col-md-4 col-lg-3 menu-column">
	                                                <div class="thumbnail" style="cursor:pointer">
	                                                    <?php $source = "admin/Uploads/images/".$menu['menu_image']; ?>

	                                                    <div class="menu-image">
													        <div class="image-preview">
													            <div style="background-image: url('<?php echo $source; ?>');"></div>
													        </div>
													    </div>
														                                                    
	                                                    <div class="caption">
	                                                        <h5>
	                                                            <?php echo $menu['menu_name'];?>
	                                                        </h5>
	                                                        <p>
	                                                            <?php echo $menu['menu_description']; ?>
	                                                        </p>
	                                                        <span class="menu_price">
	                                                        	<?php echo "PHP".$menu['menu_price']; ?>
	                                                        </span>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                        <?php
	                                    }
	                                echo "</div>";

                                echo '</div>';

                            }

                            else
                            {

                                echo '<div class="menus_categories  tab_category_content" id="'.str_replace(' ', '', $row['category_name']).'">';

                                    $stmt_menus = $con->prepare("Select * from menus where category_id = ?");
                                    $stmt_menus->execute(array($row['category_id']));
                                    $rows_menus = $stmt_menus->fetchAll();

                                    if($stmt_menus->rowCount() == 0)
                                    {
                                        echo "<div class = 'no_menus_div'>No Available Menus for this category!</div>";
                                    }

                                    echo "<div class='row'>";
	                                    foreach($rows_menus as $menu)
	                                    {
	                                        ?>

	                                            <div class="col-md-4 col-lg-3 menu-column">
	                                                <div class="thumbnail" style="cursor:pointer">
	                                                	<?php $source = "admin/Uploads/images/".$menu['menu_image']; ?>
	                                                    <div class="menu-image">
													        <div class="image-preview">
													            <div style="background-image: url('<?php echo $source; ?>');"></div>
													        </div>
													    </div>
	                                                    <div class="caption">
	                                                        <h5>
	                                                            <?php echo $menu['menu_name'];?>
	                                                        </h5>
	                                                        <p>
	                                                            <?php echo $menu['menu_description']; ?>
	                                                        </p>
	                                                        <span class="menu_price">
	                                                        	<?php echo "PHP".$menu['menu_price']; ?>
	                                                        </span>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                        <?php
	                                    }
	                               	echo "</div>";

                                echo '</div>';

                            }

                            $i++;
                            
                        }
                    
                        echo "</div>";
                
                    ?>
				</div>
			</div>
		</div>
	</section>

	<!-- CONTACT US SECTION -->

	<section class="contact-section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 sm-padding">
                    <div class="contact-info">
                        <h2>
                            Get in touch with us & 
                            <br>send us message today!
                        </h2>
                        <p>
                            Saasbiz is a different kind of architecture practice. Founded by LoganCee in 1991, we’re an employee-owned firm pursuing a democratic design process that values everyone’s input.
                        </p>
                        <h3>
                            <?php echo $restaurant_address; ?>
                        </h3>
                        <h4>
                            <span>Email:</span> 
                            <?php echo $restaurant_email; ?>
                            <br> 
                            <span>Phone:</span> 
                            <?php echo $restaurant_phonenumber; ?>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6 sm-padding">
                    <div class="contact-form">
                        <div id="contact_ajax_form" class="contactForm">
                            <div class="form-group colum-row row">
                                <div class="col-sm-6">
                                    <input type="text" id="contact_name" name="name" oninput="document.getElementById('invalid-name').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Name">
                                    <div class="invalid-feedback" id="invalid-name" style="display: block">
                                    	
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" id="contact_email" name="email" oninput="document.getElementById('invalid-email').innerHTML = ''" class="form-control" placeholder="Email">
                                    <div class="invalid-feedback" id="invalid-email" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" id="contact_subject" name="subject" oninput="document.getElementById('invalid-subject').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Subject">
                                    <div class="invalid-feedback" id="invalid-subject" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="contact_message" name="message" oninput="document.getElementById('invalid-message').innerHTML = ''" cols="30" rows="5" class="form-control message" placeholder="Message"></textarea>
                                    <div class="invalid-feedback" id="invalid-message" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button id="contact_send" class="bttn_style_2">Send Message</button>
                                </div>
                            </div>
                            <div id="sending_load" style="display: none;">Sending...</div>
                            <div id="contact_status_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<!-- OUR QUALITIES SECTION -->
	
	<section class="our_qualities_v2">
		<div class="container">
			<div class="row">
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_1">
						<div class="text_inside_quality">
							<h5>Quality Foods</h5>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_2">
						<div class="text_inside_quality">
							<h5>Cozy Ambiance</h5>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_3">
						<div class="text_inside_quality">
							<h5>Original Recipes</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- WIDGET SECTION / FOOTER -->

    <section class="widget_section" style="background-color: #222227;padding: 100px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <img src="Design/kamp lilim logo light.png" alt="Restaurant Logo" style="width: 150px;margin-bottom: 20px;">
                        <p>
                           The first and only camping theme cafe and restaurant here in the Philippines
                        </p>
                        <ul class="widget_social">
                            <li><a href="https://www.facebook.com/profile.php?id=100084700457434" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook fa-2x"></i></a></li>
                            <li><a href="https://l.facebook.com/l.php?u=https%3A%2F%2Finstagram.com%2Fkamplilim%3Figshid%3DMzRlODBiNWFlZA%253D%253D%26fbclid%3DIwAR2dCuY2PcZvMSOKa4W6oxUPDfadIfBvLqorqRKxN3pWWyAwXbD-MDmnJyk&h=AT2hzp231Jnrc7RSSdEBGRIbwSSH0LmJ_ZDcZ4Iz7EAp9wkmNVms4jSKTCFX8vXxGBsiYq4xCy-HYOwdVjOuMH7Qhb77KULhZO5fl2csZNqr3zTh8rOrarLlwNldUZvGhE5Vvg" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                           
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                     <div class="footer_widget">
                        <h3>Headquarters</h3>
                        <p>
                            <?php echo $restaurant_address; ?>
                        </p>
                        <p>
                            <?php echo $restaurant_email; ?>
                            <br>
                            <?php echo $restaurant_phonenumber; ?>   
                        </p>
                     </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>
                            Opening Hours
                        </h3>
                        <ul class="opening_time">
                            <li>Monday - Sunday 08:30am - 10:00pm</li>
            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>Subscribe to our contents</h3>
                        <div class="subscribe_form">
                            <form action="#" class="subscribe_form" novalidate="true">
                                <input type="email" name="EMAIL" id="subs-email" class="form_input" placeholder="Email Address...">
                                <button type="submit" class="submit">SUBSCRIBE</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER BOTTOM  -->

    <?php include "Includes/templates/footer.php"; ?>

    <script type="text/javascript">

	    $(document).ready(function()
	    {
	        $('#contact_send').click(function()
	        {
	            var contact_name = $('#contact_name').val();
	            var contact_email = $('#contact_email').val();
	            var contact_subject = $('#contact_subject').val();
	            var contact_message = $('#contact_message').val();

	            var flag = 0;

	            if($.trim(contact_name) == "")
	            {
	            	$('#invalid-name').text('This is a required field!');
	            	flag = 1;
	            }
	            else
	            {
	            	if(contact_name.length < 5)
	            	{
	            		$('#invalid-name').text('Length is less than 5 letters!');
	            		flag = 1;
	            	}
	            }

	            if(!ValidateEmail(contact_email))
	            {
	            	$('#invalid-email').text('Invalid e-mail!');
	            	flag = 1;
	            }

	            if($.trim(contact_subject) == "")
	            {
	            	$('#invalid-subject').text('This is a required field!');
	            	flag = 1;
	            }

	            if($.trim(contact_message) == "")
	            {
	            	$('#invalid-message').text('This is a required field!');
	            	flag = 1;
	            }

	            if(flag == 0)
	            {
	            	$('#sending_load').show();

		            $.ajax({
		                url: "Includes/php-files-ajax/contact.php",
		                type: "POST",
		                data:{contact_name:contact_name, contact_email:contact_email, contact_subject:contact_subject, contact_message:contact_message},
		                success: function (data) 
		                {
		                	$('#contact_status_message').html(data);
		                },
		                beforeSend: function()
		                {
					        $('#sending_load').show();
					    },
					    complete: function()
					    {
					        $('#sending_load').hide();
					    },
		                error: function(xhr, status, error) 
		                {
		                    alert("Internal ERROR has occured, please, try later!");
		                }
		            });
	            }
	            
	        });
	    }); 
	    
	</script>