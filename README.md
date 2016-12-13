# Disqus Plugin for PyroCMS

This plugin provides a simple way to display Disqus comments on pages, posts or pretty much wherever you want.

## Installation

Simply copy the plugin's files to `addons/{site-ref}/samharrison/disqus-plugin` (or ask your administrator if you don't
have access to your site's files).

Alternative, you can use Composer:

```
composer require samharrison/disqus-plugin
```

## Setup

Firstly, make sure you've registered your website with Disqus. Check out their
[Quickstart Guide](https://help.disqus.com/customer/portal/articles/466182-quick-start-guide) for more information.

Whilst registering, you'll be able to specify a "forum shortname" for your website. Before using the plugin, you must 
set this shortname in the Plugin section of the Settings module. If you don't set a shortname, the Disqus comments
won't load.

## Usage

The simplest way to display comments is to add

```
{{ disqus() }}
```

to a template (e.g., you theme's layout files, or a post/page type's layout field). Disqus takes the page's unique
identifier as being the page URL and the title as being whatever is in the `title` attribute. However, it is recommended
to define your own unique identifier as using a URL can be unreliable (e.g., if you change domains or the page's slug).
You can do so by providing it as a parameter for the plugin. For example, if you are using the plugin on a post's
template:

```
{{ disqus(post.id) }}
```

Or, on a page's template:

```
{{ disqus(page.id) }}
```

You can also prevent Disqus using the `<title>` attribute by specifying a title as the second parameter:

```
{{ disqus(
    post.id,
    post.title
}}
```

More on Disqus' configuration variable can be found in the
[Disqus documentation](https://help.disqus.com/customer/portal/articles/472098-javascript-configuration-variables).


### Output the Javascript only

To display comments, a `<div>` with `id="disqus_thread"` is required where the comments should be displayed on the page.
The `{{ disqus() }}` plugin above includes this wherever in the template it is used. If you wish to output only
the Javascript so that you have more control over where and how the `<div id="disqus_thread">` is display, you can
use the `{{ disqus_script() }}` plugin.

For example, this might be useful is you want to add custom classes to the `<div>`, or to place it in a template where
it isn't so easy to get the page or post's ID:

```
<div id="disqus_thread" class="your-custom-class"></div>
{{ disqus_script() }}
```

`disqus_script()` supports the same options as `disqus()`.


## Use case: Post comments that can be disabled

This plugin makes adding Disqus comments to a post super easy, even if you don't have access to your site's theme files.
Here's an example of how to add Disqus comments to a post, with an option on each post as to whether you want the
comments displayed or not.

Firstly, install the plugin as above and ensure you've set your forum shortname in the Settings module. Now, let's
create a boolean (true/false) field type by going to the Field section in the Posts module, adding a new field and
selecting "Boolean" as the field type:

![add_field](https://cloud.githubusercontent.com/assets/3359948/21137512/afe834cc-c121-11e6-948e-42ff534c9ea4.png)

Name the field whatever you like (e.g., "Display Disqus comments?") and set the slug to "enable_disqus". Now assign this
field to a particular page type in the Types section of the Posts module, by selecting "Assignments" on the page type
you want (e.g., Default) and then "Assign Fields". Select the field you just created by the name you gave it, and fill
in any details you wish on the field assignment form.

Now we can edit the page type's layout to show the Disqus comments: Select the "Edit" button of the page type you've
just assigned the new field to, and add the following code to the bottom of the Post Layout field:

```
{% if post.enable_disqus %}
    {{ disqus(post.id) }}
{% endif %}
```

Depending on how your site is set up, the Post Layout might now look something like this:

![post_layout](https://cloud.githubusercontent.com/assets/3359948/21154989/48326f22-c168-11e6-818b-0d9b508f433a.png)

When you create a new post of this type, you can now select if you want Disqus comments to be displayed or not, and if
you opt to display them, the comments will be embedded at the bottom of your blog post:

![post](https://cloud.githubusercontent.com/assets/3359948/21137509/afe2a4ee-c121-11e6-820b-629951ebadbc.png)



