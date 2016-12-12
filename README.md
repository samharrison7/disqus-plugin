# Disqus Plugin for PyroCMS

This plugin provides a simple way to display Disqus comments on pages, posts or pretty much wherever you want.

## Installation

Simply copy the plugin's files to `addons/{site-ref}/samharrison/disqus-plugin`.

## Setup

Firstly, make sure you've registered your website with Disqus. Check out their
[Quickstart Guide](https://help.disqus.com/customer/portal/articles/466182-quick-start-guide) for more information.

Whilst registering, you'll be able to specify a "forum shortname" for your website. Before using the plugin, you must 
set this shortname in the Plugin section of the Settings module. If you don't set a shortname, the Disqus comments
won't load.

## Usage

The simplest way to display comments is to add

```
{{ disqus()|raw }}
```

to a template (e.g., you theme's layout files, or a post/page type's layout field). Disqus takes the page's unique
identifier as being the page URL and the title as being whatever is in the `title` attribute. However, it is recommended
to define your own unique identifier as using a URL can be unreliable (e.g., if you change domains or the page's slug).
You can do so by providing it as a parameter for the plugin. For example, if you are using the plugin on a post's
template:

```
{{ disqus(post.id)|raw }}
```

Or, on a page's template:

```
{{ disqus(page.id)|raw }}
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

To display comments, a `<div>` with `id="disqus-thread"` is required where the comments should be displayed on the page.
The `{{ disqus()|raw }}` plugin above includes this wherever in the template it is used. If you wish to output only
the Javascript so that you have more control over where and how the `<div id="disqus-thread">` is display, you can
use the `{{ disqus_script()|raw }}` plugin.

For example, this might be useful is you want to add custom classes to the `<div>`, or to place it in a template where
it isn't so easy to get the page or post's ID:

```
<div id="disqus-thread" class="your-custom-class"></div>
{{ disqus_script() }}
```