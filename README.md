## Single Product Social Sharing Plugin for Woocommerce

This is a minimal social sharing solution that allows you to automatically insert social media sharing buttons at the bottom of your Woocommerce single product summary area. 

> <i>Tags: wordpress, wocommerce, social, sharing, simple, customizer, clean, CSS, PHP, avoori, capsula group.</i>

[![INSERT YOUR GRAPHIC HERE](https://image.prntscr.com/image/u0d6bxAgSqS0nCslgZqw2w.png)]()

### Table of Contents (Optional)

> Please follow the table of contents.

* [Installation](#installation)
* [Features/Screenshots](#features)
* [FAQ](#faq)
* [Contributing](#contributing)
* [Modification Examples](#modifications)
  * [How to change the blocks background color with CSS]()    
  * [How to change the blocks background hover color with CSS](#features)
  * [How to remove the blocks background and use a border instead with CSS](#features)
* [Support](#support)
* [License](#license)
* [Pro Version](#features)

---

## Installation

<strong>Automatic:</strong>
1. Go to your Wordpress backend --> Plugins --> Add New.
2. Search for: Single Product Social Sharing Plugin for Woocommerce > or download the plugin from the repository and upload it manually.
3. Choose install and activate the plugin.

<strong>Manual:</strong>
1. Download the plugin from the repository or directly from wordpress.org
2. Upload the plugin folder into the wp-content/plugins/ directory of your WordPress site.
3. Go to your Wordpress backend --> Plugins --> Activate Single Product Social Sharing Plugin for Woocommerce

> Single Product Social Sharing Plugin for Woocommerce will add a new customizer section called “Product Social Sharing”. Here you are able to configure all the plugin settings.

## Features


![Recordit GIF](http://g.recordit.co/kWJFgJd4pD.gif)

## FAQ

- **Where can I change the plugin settings?**
    - The plugin creates a section in the Wordpress customizer so you can edit the settings in live view.
- **How can I change the plugin colors?**
    - Please follow the modification examples.
- **How can I have more options in the customizer instead of writing more code?**
    - We have a pro version available with many additional settings, please follow the link below.

## Contributing

If you would like to contribute to this project or have any requests, please create a new issue and we will try to help.

## Modifications

We've created these modifications to help you speed up develpment and customize the product to your needs.
Additional options and settings are available directly in the customizer in the pro version.

#### How to change the blocks background color with CSS
> Change the first class to represent the relevant button.
```css
.avoo-social-share-fb > a > i {background-color: #3b5998 !important;}
```

---

#### How to change the blocks background hover color with CSS
> Change the first class to represent the relevant button.
```css
.avoo-social-share-fb > a > i:hover {background-color: #3b5998 !important;}
```

---


#### How to remove the blocks background and use a border instead with CSS
```css
.woocommerce.single-product div.product .avoo-social-share-buttons > span > a >i {
    background-color: transparent !important;
    border: 2px solid;
}
.avoo-social-share-fb > a > i {
    border-color: #3b5998 !important;
    color: #3b5998 !important;
}
```

---


## Support

Reach out to me at one of the following places!

- Website at <a href="#" target="_blank">`text.com`</a>
- Twitter at <a href="#" target="_blank">`@text</a>
- Insert more social links here.

---

## License

[![License](http://img.shields.io/:license-mit-blue.svg?style=flat-square)](http://badges.mit-license.org)

- **[MIT license](http://opensource.org/licenses/mit-license.php)**
- Copyright 2015 © <a href="http://fvcproductions.com" target="_blank">FVCproductions</a>.
