=== Verb ===
Theme URI: http://themes.okaythemes.com/verb
Description: Verb is a super neat WordPress theme for squares.
Author: Mike McAlister / Okay Themes
Author URI: http://okaythemes.com
Version: 1.4
Tags: white, gray, white, two-columns, flexible-width, custom-background, custom-colors, custom-menu, editor-style, featured-images, theme-options, translation-ready, photoblogging, threaded-comments
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html



===Recommended Plugins===

Verb uses a few plugins to provide extra functionality to the theme.

* **Contact Form 7** - This plugin creates a fully functional contact form for your site. You can install it directly from your dashboard in the Plugins menu, or grab it from the WordPress.org plugin repository.
* Log in and navigate to Plugins -> Add New.
* Type "Contact Form 7" into the Search input and click the "Search Widgets" button.
* Locate Contact Form 7 in the list of search results and click "Install Now".
* Click the "Activate Plugin" link at the bottom of the install screen.
* There will now be a Contact menu item on the WordPress admin menu. See below for more instructions on using this plugin with the theme.


* **Okay Toolkit** - This plugin provides the Portfolio section (via a custom post type) and several social media widgets including Twitter, Dribbble, Flickr and social media icons. Once installed and enabled, you can find the social media widgets in your Widgets section. You can install it directly from your dashboard in the Plugins menu, or grab it from the WordPress.org plugin repository.
* Log in and navigate to Plugins -> Add New.
* Type "Okay Toolkit" into the Search input and click the "Search Widgets" button.
* Locate the Okay Toolkit in the list of search results and click "Install Now".
* Click the "Activate Plugin" link at the bottom of the install screen.
* Navigate to Settings -> Okay Toolkit to modify the plugin's settings. The widgets will be available in Appearance -> Widgets.



===Menu Setup===

WordPress menus can be found under Appearence -> Menus.

* You'll need to create at least one new menu for the header. Verb also supports a custom menu, which you could use in the widget area. Click the **+** to add a new menu.

* Now, on the left hand side, select the pages you would like to have added to the menu. You can then click "Add to Menu" and they will show up on the right side of the page. You can drag the pages around to arrange them the way you'd like.

* Create a drop menu by dragging menu items under and to the right of another menu item.

* **Save the menu when finished**.

* Now that you have the menu created, you need to assign it in the Theme Locations window located on the left. From the drop down menu, select the appropriate menu for the header and save.



===Contact Page===

The Contact Page uses the Contact Form 7 plugin, which can grab for free on the WordPress plugin repository. See installation instructions above. Once installed, you'll see there is a **Contact** link in the left hand sidebar of your WordPress admin.

* If you haven't already, create a new page called Contact.

* Go to the Contact menu on the left admin menu to configure your contact form. By default they give you a simple form with Name, Email, Subject and Message. To keep things simple, I suggest using the default form. Otherwise, to customize this form even further, check out the Contact Form 7 docs page [here](http://contactform7.com/blog/2009/11/02/getting-started-with-contact-form-7/).

* After you've configured and saved your contact form in the Contact menu, you will be given a small shortcode like this: **[contact-form 1 "Contact form 1"]**. Copy this shortcode. We'll use this to add the form to our Contact page.

* Now head back to your Contact page. Paste the Contact 7 shortcode that you copied into the body of the post. Update the post. You should now see the form on the contact page.



===Blocks Page===

Verb comes with a [Blocks page template](http://cl.ly/M428), which can be used as a portfolio page for images. I recommend using it on the Homepage, although you can use it on whichever page you like. Follow the steps below to setup the Blocks page. I'll go over how to populate the Blocks page below.

* Create a new page called Blocks (or your own title).

* On the right hand side of the page under the [Page Attributes window](http://cl.ly/M5jc), apply the Blocks page template.

* The Blocks page doesn't output post content, so you won't need to add any content to this page.

* Publish the page when finished.

* If you would like to use your Blocks page as the homepage, you need to go to **Settings -> Reading** and set your Blocks page as the Front page. See this [screenshot](http://cl.ly/M4MQ) for an example.



===Blog Page===

By default, the blog will be your homepage and will show your latest posts. However, if you choose to use the Blocks page as the homepage (or any other page) instead, you need to tell WordPress which page to use as the blog.

* Create a new page called Blog. You don't have to add any content or apply any templates to this page. You just need to create the page so we can utilize it in the next couple steps. Publish the page.

* Go to **Settings -> Reading** on the admin menu. Set your newly created Blog page as the Posts page. See this [screenshot](http://cl.ly/M4MQ) for an example. Click Save Changes.

* Finally you need to add this page to your menu so users can access the blog page. Just go to **Appearance -> Menus** and add your Blog page to the menu.

* Moonwalk to the refrigerator and get a soda. You've earned it.



===Archive Page===

Verb comes with an Archive page template which displays all of your latest posts, pages and categories.

* Create a page called Archives (or whatever title you'd like).

* On the right hand side of the page under the [Page Attributes window](http://cl.ly/M4Gz), apply the Custom Archive page template.

* Once finished, publish the page.

* You'll also need to add this page to your menu so users can access the Archive page. Just go to **Appearance -> Menus** and add your Archive page to the menu.



===Using the Theme Customizer===

Verb is customizable via the WordPress customizer. Here, you can set a custom background image, upload a logo and set your link/accent color.

* To access the theme customizer, click **Appearance -> Customize** in the WordPress admin menu.

* You should now be in a live preview of Verb, with the customizer on the left.

* You can use the various menus to set the site title, description, and background color/image. Verb specific styling is in the Verb Styling menu. Here you can add a logo, set an accent color (which will be your link color and accent background color on various elements. You can also set the Blocks page [title and subtitle](http://cl.ly/M428).

* When you're finished making changes, click **Save & Publish** to save the settings.

* Check out your site to confirm your changes.



===Widgets===

Add widgets to the Sidebar Widgets pane to see them in the sidebar of the theme. You can add text widgets, the Twitter widget, custom menus, etc. here just like I did on the demo. Or don't, whatever. If you want to add Twitter, Flickr, or Dribbble widgets, you'll need to add the Okay Toolkit plugin first (see above).



===Adding Portfolio Items===

To activate the Portfolio Items section of the theme, you need to first install the Okay Toolkit plugin as outlined above. The plugin will provide the theme with the Portfolio post type, which populates the Portfolio (Blocks) page.


* Install the Okay Toolkit plugin using the steps above in the Recommended Plugins section. Once installed, activate the plugin.

* Go to **Settings -> Okay Toolkit**. At the bottom of the Okay Toolkit Options page, you'll see the **[Enable Portfolio Items](http://cl.ly/M57E)** section. Select **Enable** from the drop down and click **Save Changes**. 

* Once activated, you'll see there is now a **[Portfolio Items section](http://cl.ly/M4Ek)** on the admin menu.

Now that you've activated the Portfolio, you can start adding posts to it. It's very similar to adding images and video to the Blog section.


**Featured Image Post**

* Create a new post and add a title and description.

* Write your content and add whatever styling you want.

* On the right hand side of your page, you'll see the **Featured Image** pane. Click Set **Featured Image** and upload your image. Once uploaded, scroll down and click **Use as featured image**. Once set, you can close the image upload window.

* Once you've added the featured image and content you can publish and preview your post.


**Multiple Image Post**


* Create a new post and add a title and description.

* Click the **Add Media** button. Once the Add Media dialog opens, upload all of the images you'd like in your portfolio post. When finished uploading, you can arrange your images by selecting and dragging them into position. All of the images you've uploaded will be attached to the post and displayed stacked on the page.

* Use one of the images you've uploaded as the post's Featured Image (which will be shown on the Block template page). To do this, simply click **Set Featured Image** and click the image you'd like to use. Next, click the blue **Set Featured Image** button in the bottom right hand corner of the dialogue. See [this image](http://cl.ly/M5C5) for reference.

* Once you've added your images and content you can publish and preview your post.


**Video Post**

* Create a new post and add a title and post content.

* Next, scroll down the page a bit and look for the Custom Fields box. **If you don't see the Custom Fields box, look up towards the top of your screen and click the Screen Options drop down. Make sure Custom Fields is checked.**

* Now you can add the Custom Field. The Name is going to be **video** and the value will be your embed code. See this image for reference: [Video Custom Field](http://cl.ly/JqYH). The embed code should look something like the code below. Click Add Custom Field.

* Once you've added the custom field and content you can publish and preview your post.



===Adding a Featured Image or Video to Blog Posts===

**Featured Image Posts**

* Create a new post and add a title and description.

* Write your content and add whatever styling you want.

* On the right hand side of your page, you'll see the **Featured Image** pane. Click Set **Featured Image** and upload your image. Once uploaded, scroll down and click **Use as featured image**. Once set, you can close the image upload window.

* Once you've added the featured image and content you can publish and preview your post.


**Video Posts**

* Create a new post and add a title and post content.

* Next, scroll down the page a bit and look for the Custom Fields box. **If you don't see the Custom Fields box, look up towards the top of your screen and click the Screen Options drop down. Make sure Custom Fields is checked.**

* Now you can add the Custom Field. The Name is going to be **video** and the value will be your embed code. See this image for reference: [Video Custom Field](http://cl.ly/JqYH). The embed code should look something like the code below. Click Add Custom Field.

* Once you've added the custom field and content you can publish and preview your post.



===Post Styles===

Verb comes with a few custom element styles, which are used to easily add extra styling to your WordPress posts. To use the post styles, simply select your text and then select from the [Styles Drop Down Menu](http://cl.ly/M5Cy) which style you would like to apply. You'll be able to see the changes live, in your editor.

* **Intro Title** - As [seen on the demo](http://cl.ly/M4tf), this is a nicely styled block of text to introduce your page. Similar to blockquote styling.

* **Pull Quote** - As [seen on the demo](http://cl.ly/M5LV), you can use this to pull small quotes or small blocks of text to the right of the page. It will be styled with the color you chose as your Accent Color in the Verb Styling, or it will be red by default.

* **Highlight Text** - As [seen on the demo](http://cl.ly/M5Av), this adds a highlighted background to your inline text. Nothing fancy here, but it adds a nice touch.