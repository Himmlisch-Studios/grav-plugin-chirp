# Chirp Plugin

The **Chirp** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). 

With Chirp you can embed Tweets with the `[tweet]` shortcode and customize the template as your theme needs.

**This plugin requires [Shortcode Core](https://github.com/getgrav/grav-plugin-shortcode-core) to work.**

## Installation

Installing the Chirp plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install chirp

This will install the Chirp plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/chirp`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `chirp`. You can find these files on [GitHub](https://github.com/himmlisch-studios/grav-plugin-chirp) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/chirp
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/himmlisch-studios/grav-plugin-chirp/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/chirp/chirp.yaml` to `user/config/plugins/chirp.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
built_in_css: true # Set to `false` to use custom CSS
```

Note that if you use the Admin Plugin, a file with your configuration named chirp.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Usage

You can insert a tweet passing an URL through the property.

```
[tweet url="https://twitter.com/jack/status/20"][/tweet]
```

Or inside the tags.

```
[tweet]https://twitter.com/jack/status/20[/tweet]
```

Or just use the ID.

```
[tweet]20[/tweet]
```

## Need a website?

[Himmlisch Web](https://web.himmlisch.com.mx) is a software development agency ready to help your business grow.  [Contact us!](https://himmlisch.com.mx/contact)
