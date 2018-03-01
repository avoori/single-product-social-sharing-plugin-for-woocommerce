## Single Product Social Sharing Plugin for Woocommerce

This is a minimal social sharing solution that allows you to automatically insert social media sharing buttons at the bottom of your Woocommerce single product summary area. 

> <i>Tags: wordpress, wocommerce, social, sharing, simple, customizer, clean, CSS, PHP, avoori, capsula group.</i>

[![INSERT YOUR GRAPHIC HERE](https://image.prntscr.com/image/u0d6bxAgSqS0nCslgZqw2w.png)]()

### Table of Contents

> Please follow the table of contents.

* [Installation](#installation)
  * [Automatic](#automatic)
  * [Manual](#manual)
* [Features / Screenshots](#features)
* [FAQ](#faq)
* [Contributing](#contributing)
* [Modification Examples](#modifications)
  * [How to change the blocks background color with CSS](#how-to-change-the-blocks-background-color-with-css)
  * [How to change the blocks background hover color with CSS](#how-to-change-the-blocks-background-hover-color-with-css)
  * [How to remove the blocks background and use a border instead with CSS](#how-to-remove-the-blocks-background-and-use-a-border-instead-with-css)
* [Support](#support)
* [License](#license)
* [Professional Version](#professional-version)

---

### Installation

#### Automatic:
1. Go to your Wordpress backend --> Plugins --> Add New.
2. Search for: Single Product Social Sharing Plugin for Woocommerce > or download the plugin from the repository and upload it manually.
3. Choose install and activate the plugin.

#### Manual:
1. Download the plugin from the repository or directly from wordpress.org
2. Upload the plugin folder into the wp-content/plugins/ directory of your WordPress site.
3. Go to your Wordpress backend --> Plugins --> Activate Single Product Social Sharing Plugin for Woocommerce

> Single Product Social Sharing Plugin for Woocommerce will add a new customizer section called “Product Social Sharing”. Here you are able to configure all the plugin settings.

### Features


![Recordit GIF](http://g.recordit.co/kWJFgJd4pD.gif)

### FAQ

- **Where can I change the plugin settings?**
    - The plugin creates a section in the Wordpress customizer so you can edit the settings in live view.
- **How can I change the plugin colors?**
    - Please follow the modification examples.
- **How can I have more options in the customizer instead of writing more code?**
    - We have a pro version available with many additional settings, please follow the link below.

### Contributing

If you would like to contribute to this project or have any requests, please create a new issue and we will try to help.

### Modifications

We've created these modifications to help you speed up develpment and customize the product to your needs.
Additional options and settings are available directly in the customizer in the pro version.

##### How to change the blocks background color with CSS
> Change the first class to represent the relevant button.
```css
.avoo-social-share-fb > a > i {background-color: #3b5998 !important;}
```

##### How to change the blocks background hover color with CSS
> Change the first class to represent the relevant button.
```css
.avoo-social-share-fb > a > i:hover {background-color: #3b5998 !important;}
```

##### How to remove the blocks background and use a border instead with CSS
> Change the first class to represent the relevant button. Notice you need to provide 2 color options as the button is now transparent. Change the border curvature, with the last setting as required.
```css
.avoo-social-share-fb > a >i {
    background-color: transparent !important;
    border: 2px solid;
    line-height: 38px !important;
    border-color: #3b5998 !important;
    color: #3b5998 !important;
    border-radius: 8px;
}
```

### Support

If you need any help or you would like to contribute to the project feel free to open an issue and we will try to help.
You may also reach our development team directly by contacting us in one of following ways:

- Website at <a href="https://capsula.group/plugin_development" target="_blank">capsula.group/plugin_development</a>
- Twitter at <a href="https://twitter.com" target="_blank">@capsulagroup</a>
- Facebook at <a href="https://facebook.com" target="_blank">facebook.com/capsulagroup</a>
- LinkedIn at <a href="https://linkedin.com" target="_blank">linkedin.com/capsulagroup</a>

### License

- This is an open source project under the GPLV3 license. 
- Feel free to use it on as many projects (personal and commercial) as you would like, contribute, share!

---


### Professional Version

The professional version of the plugin adds many more options to the customizer settings:
Title Styling:
- Title Text Heading (H1,H2,H3)
- Title Text Color
- Title Text Margins (px)
Single background color on hover for all share buttons:
- Single Background Hover Color For All Buttons
Change default spacing between icons:
- Button Margins (px)
Share button design options (Settings for each button):
- Button Background Color
- Button Background Hover Color
- Button Border Color
- Button Border Hover Color
- Button Border Roundness
- Button Icon Size
- Button Icon Height
- Button Icon Color

> The professional version is available <a href="https://capsula.group/plugins/single-product-social-sharing-plugin-for-woocommerce" target="_blank">here</a>

---
