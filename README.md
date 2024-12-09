# White Label | The Change

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Version](https://img.shields.io/badge/version-1.0.1-brightgreen)

## Description

**White Label | The Change** is a ready-made template for creating your own cryptocurrency exchange. The project is designed with a focus on ease of integration and simple configuration, allowing you to quickly launch an exchange with minimal effort.

## Features

- **Ready-made Website:** Fully prepared interface for cryptocurrency exchange.
- **Easy Setup:** Connect your API key and configure the main parameters through configuration files.
- **Customization:** Ability to change the logo, color palette, footer, header, contacts, and language.
- **Language Extension Support:** Easily add new language packs.
- **No Database Required:** All data is processed through the API, simplifying the project architecture.

## Technology Stack

- **Programming Languages:** JavaScript, jQuery, PHP, HTML, CSS
- **Frameworks and Libraries:**
  - **PHP:** Symfony for translations, Bramus Router for routing, Composer for dependency management, Endroid QR-Code for QR code generation

## Prerequisites/Requirements

- PHP 8.2 or greater

### Usage Steps

## Installation

Use XAMPP 5.6 for this project. You can download it from [here](https://www.apachefriends.org/download.html).

## Usage

### Obtaining an API Key

1. Register or log in to your account at [thechange.ltd](https://thechange.ltd/profile/api).
2. Contact technical support to obtain an API key.

### Connecting the API Key

1. Open the `/config.php` file.
2. Insert your API key into the appropriate field.

### Website Customization

- **Changing the Logo:**
  - Replace the `/assets/icon.svg` file with your own logo.

- **Changing the Website Color Palette:**
  - In the `/assets/style/variables.css` file, you will find all the color variables and their descriptions.

- **Modifying the Footer and Header:**
  - Edit the corresponding entries in the `/config.php` file. All possible path options are located in `footer_menu`.

- **Configuring Contacts:**
  - In the `/config.php` file, you can also add your contacts, change the icon, and fill colors in the `contacts` entry.

- **Adding Languages:**
  1. Navigate to the `/translations` folder and add a new folder with the name of the language you want to add.
  2. Add all the necessary files to the newly created folder, following the example of existing folders like `/translations/en` or `/translations/ru`.
  3. Translate the files into your desired language and add an image with the same name as the language folder in `/assets/images/lang/`.
  4. To apply the translation files from the created folder, add your language to the `supported_languages` entry in `/config.php`.

## API

API documentation is available at: [API Documentation](https://thechange.ltd/docs/)

## Contacts

If you have any questions or suggestions, contact us:

- **Email:** support@thechange.ltd
- **Telegram:** [@thechange_sup](https://t.me/thechange_sup)

## Additional Materials

- **White Label:** Additional information can be found in [White Label](https://thechange.ltd/profile/white-label) after registering or logging into the website.

## License

This project is released under the MIT public license. See the enclosed `LICENSE` for details.