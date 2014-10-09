</center>

		<h1>
			There's zero risk for the first 30 days. Get over 200 great leads for free.</strong>
		</h1>
		<p>
			Like you, I know there are a ton of businesses who will benefit from working with me. That's why I'm making it a no-brainer by offering you a full refund if you're not completely blown away in the first thirty days.
		</p>

	<p><strong>So what happens if I don't like it?</strong>
	</p>
	<p>
		No worries. There's a 30-day 100% satisfaction guarantee. Enjoy my leads for a full month, and if you don't like the service for any reason, send me an email and I'll give you a refund. I don't want your money if you're not 100% blown away by my service.
	</p>

	<p><strong>"How many leads will be sent, and how often?"</strong></p>
		<p>
			I usually send 8-10 leads per day. Sometimes more, <strong>but the whole point of Workshop is that I send fewer, better leads.</strong> I never send a lead just to hit a quota. In fact, Workshop's value is equally about the leads I don't send as it is about the ones I do. The thousands of leads I eliminate from your life completely make the handful I do send more important.
		</p>
		<!--<p>
			The fact is, you don't need all that many leads to make a lot of money; you just need the right leads. If you're looking for hundreds of freelance leads in your inbox every day, than Workshop isn’t the right service for you. On the other hand if you're looking for the best leads, it is.
		</p>-->
	<!--<p>
		<strong>"Wait. Can’t I just find these leads myself for free?"</strong>
	</p>

	<p>
		No. Sure some leads are available for free online, but your time is worth money. Of course, you could find the leads yourself, but why haven't you? Committing to finding leads day-in and day-out is tough. The truth is, you’d rather wait for work to fall into your lap, than find even one qualified prospect to email this week.
	</p>-->
	<!--<p>
		<strong>
			"Will you be any good at finding leads <em>for me?"</em>
		</strong>
	</p>
		<p>
			<em>I look over every single lead, personally, to make sure they meet a strict criteria:</em> they MUST be freelance leads, not full-time work. They MUST be remote, and open to freelancers anywhere. They MUST be quality projects: no budgets below $1,000. And, preferably, there must be an email attached to the lead.
		</p>
		<p>
			Workshop members think the leads I pick out reply at a higher rate, but the truth is they also have an unfair advantage over you. Job boards no longer suck up all their time, so they're actually better at contacting leads because they no longer teeter-totter between work overload and an empty checking account. Some have landed huge projects, or even full-time remote dream jobs. All have saved the most precious resource: time.
		</p>-->

			<p>
		<strong>
			"Do you send my specific type of lead?"
		</strong>
	</p>
		<p>
			Right now Workshop is mostly focused on web design and development. However, we have a steady amount of other leads coming in like illustration, logo design, and other stuff. The best way to find out if Workshop has what you need is to sign up and see for yourself. I can also send you a sample email if you give me your email address using the form in the lower right corner of this page.
		</p>



		<p>
			<strong>"How long have you been doing this, does it work?"</strong>
		</p>
		<p>
			I started doing this with select consultancies in November, 2013. Since then I've helped hundreds land work. Some have even made hundreds of thousands of dollars from my leads. Now, I focus on Workshop full-time, which wouldn't be possible if it didn't produce massive results for my customers.
		</p>

<!--


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
<p>PS: If Workshop isn’t a good fit for you right now, you can always <a href="./weekly">read my weekly newsletter</a> for free.</p>-->

</section>
</section>




<section class="mid-wrap" id="read-testimonial">

<center><h1>People who try Workshop love it.</h1></center>

		<?php

		$testimonial_posts = get_posts(array(
			'numberposts' => 30,
			'post_type' => 'testimonial',
			'orderby' => 'rand',
		));



		if($testimonial_posts)
		{



			echo '<ul>';

			foreach($testimonial_posts as $post)
			{

				echo '<div class="testimonial-box"><p>' . get_field('testimonial') . '</p><span class="quote-arrow"></span></div>' . '<p class="center">
					<img src="' . get_field('profile_photo') . '" class="testimonial-img"> – ' . get_field('testimonial_name') . ', ' . get_field('job_title') . ', <img src="' . get_field('logo') . '" style="width:20px; border-radius:3px; vertical-align: -2px;"> ' . get_field('business_name') . '</p>';
			}

			echo '</ul>';
		}

		?>
</section>


</div>

