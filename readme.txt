=== Solo ===
Contributors: dartiss
Donate link: https://artiss.blog/donate
Tags: result, search, single, solo, title
Requires at least: 4.6
Tested up to: 5.7
Requires PHP: 5.3
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

🔍 Instantly display a single search result.

== Description ==

You know when you search for something on a site and it finds just one result? You then have to click into it to display it. That's annoying. It's also adding an extra page load which is not necessary.

And what about if you search for an exact match for a title and, well, it serves it up along with a number of other possible results. Hey, why didn't you just show me the one that I typed the name of in exactly? Well, you can do that too. Cool, eh?

This plugin simply removes this middle step - if your search returns one result or you type in the name of a title, it will be shown in all its post/page (delete as appropriate) glory. As well as a quicker answer for your visitor, removing this improves your site's sustainability (okay, just a little... but every little helps, right?).

The code also passes WordPress and WordPress VIP coding standards. Because you're worth it.

Thanks to my co-worker [Kailey](https://profiles.wordpress.org/trepmal/) for [the original code](https://trepmal.com/2011/04/22/redirect-when-search-query-only-returns-one-match/), which I've been happily using on my own site for many years. I thought it was time to share the ♥️.

Iconography is courtesy of the very talented [Janki Rathod](https://www.fiverr.com/jankirathore).

👉 Please visit the [Github page](https://github.com/dartiss/solo "Github") for the latest code development, planned enhancements and known issues 👈

== Installation ==

Solo can be found and installed via the Plugin menu within WordPress administration (Plugins -> Add New). Alternatively, it can be downloaded from WordPress.org and installed manually...

1. Upload the entire `solo-search` folder to your `wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress administration.

It's now ready to go. By default, not all features are active - head to Settings -> General -> Solo for all the options.

== Frequently Asked Questions ==

= Why do you have to switch on the "exact match" option? =

Because, if you're using pretty generic titles (e.g. "Twitter") then you may not want this behavior.

Let me explain.

On my own site (artiss.blog - always a good read. Never dull. Please subscribe), I often use short, single names for pages. "About", "Blog", that kind of thing. For my posts, however, I use something long and descriptive. For example, "See what the stars of The Banana Splits look like now. Number 3 will amaze you". For this reason, I have exact matching switched off for pages but on for posts - if someone types in that post title than they are very welcome to have it served straight up to them.

= For the "exact match" feature, it only works for posts and pages. Can I add additional taxonomies? =

What kind of monster are you?

But, seriously, not at the moment. But if this interests you, please let me know!

== Screenshots ==

1. The settings that are available

== Changelog ==

I use semantic versioning, with the first release being 0.1.

= 1.0 =
* Enhancement: You didn't ask for it, but you got it anyway - the search will now display content if you search for an exact match on the title
* Enhancement: Settings now allow you to turn each of the options on and off, to your likely. You can switch them all of, if you want, although that's a waste of an active plugin, if we're being honest
* Enhancement: Added a link in the plugin meta so you can go straight to the settings. Because I care
* Maintenance: Various tweaks and fiddles, some of which may even be legal

= 0.2 =
* Bug: Fixed text domain

= 0.1 =
* Initial release

== Upgrade Notice ==

= 1.0 =
* 100% more features. 100% more settings. 0% bugs (I can hope, right?)