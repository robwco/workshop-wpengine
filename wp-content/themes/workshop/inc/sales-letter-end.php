

	<p><strong>What happens if I don't like it?</strong>
	</p>
	<p>
		<span class="guarantee">30-DAY</span> 100% Satisfaction Guarantee. Enjoy my leads for a full month, and if you don't like the service for any reason, send me an email and I'll issue you a refund. I don't want your money if you're not 100% blown away by my service.
	</p>
	<p>
		<strong>Who are you?</strong>
	</p>

	<img style="border-radius: 50px; float: left; margin-right: 20px; height: 75px; width: 75px; display: inline-block;" src="../images/marketing/robert-williams-profile.jpg" alt="">

	<p>I’m Robert Williams, an experienced freelancer who knows exactly which prospects will be an asset to your business. I’ve worked with startups, ad agencies, and small and large businesses.
	</p>
	<p style="margin-bottom:2em;">
		I made Workshop because I wished something like it was available for me, and I'm excited to share it with you. I've been featured in places like the University of California San Diego, Wired, Copyhackers, Gizmodo, Bidsketch, and the Dieline. I'd like to help lower your blood pressure by providing you a great service. See you inside!
	</p>
</div>

<section class="small-wrap">
<center>
	<h2>What members have to say about Workshop</h2>
</center>

		<?php

		$testimonial_posts = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'testimonial',
		));



		if($testimonial_posts)
		{



			echo '<ul>';

			foreach($testimonial_posts as $post)
			{

				echo '<div class="testimonial-box"><p>' . get_field('testimonial') . '			</p><span class="quote-arrow"></span></div>' . '<p class="center">
					<img src="' . get_field('profile_photo') . '" class="testimonial-img"> – ' . get_field('testimonial_name') . ', ' . get_field('job_title') . ', <img src="' . get_field('logo') . '" style="width:20px; border-radius:3px; vertical-align: -2px;"> ' . get_field('business_name') . '</p>';
			}

			echo '</ul>';
		}

		?>
</section>

</section>

</div>

