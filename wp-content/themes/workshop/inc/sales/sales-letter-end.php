</center>

	<p><strong>So what happens if I don't like it?</strong>
	</p>
	<p>
		No worries. There's a 30-day 100% satisfaction guarantee. Enjoy my leads for a full month, and if you don't like the service for any reason, send me an email and I'll issue you a refund. I don't want your money if you're not 100% blown away by my service.
	</p>
	<p><strong>Who are you?</strong>
	</p>
	<p>My name is Robert Williams. I'm an experienced freelancer who knows exactly which prospects will be an asset to your business. I’ve worked with startups, ad agencies, and small and large businesses.
	</p>
	<p style="margin-bottom:2em;">
		I made Workshop because I wished something like it was available for me, and I'm excited to share it with you. I've written and spoken at places like the University of California San Diego, Wired, Copyhackers, Gizmodo, Bidsketch, and the Dieline. I'd like to help you lower your blood pressure by providing you a great service.
		</P>
	<p>
		Do you still have questions? Totally cool. I would love to hear from you. Just <a href="MAILTO:robert@letsworkshop.com">send me a note</a> and I'll email you back, usually within a few hours.	Thank you so much for reading this and I hope you have a great day.
	</p>
		<p>
			<img style="border-radius: 50px; height: 50px; width: 50px; vertical-align: -1em; margin-right: .5em;" src="/images/marketing/robert-williams-profile.jpg" alt=""> &mdash; Robert Williams
		
	</p>
<p>PS: If Workshop isn’t a good fit for you right now, you can always <a href="./weekly">read my weekly newsletter</a> for free.</p>

</section>
</section>

<section class="mid-wrap">
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


</div>

