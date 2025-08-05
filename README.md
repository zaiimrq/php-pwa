<h1 align="center">PHP-PWA</h1>
<p align="center"><em>Effortlessly Enable Seamless, Offline-Ready Web Experiences</em></p>

<p align="center">
    <img src="https://img.shields.io/badge/last%20commit-today-brightgreen" alt="Last Commit">
    <img src="https://img.shields.io/badge/PHP-62.6%25-blue" alt="PHP">
    <img src="https://img.shields.io/badge/Languages-3-informational" alt="Languages">
</p>

---

## ✨ Overview

**PHP-PWA** is a lightweight library that enables your native PHP applications to become Progressive Web Apps (PWAs) without requiring any additional PHP or JavaScript frameworks. With PHP-PWA, your web app can work offline, load faster, and feel like a native application—all with simple integration into your existing PHP codebase.

---

## 🚀 Features

- ⚡ Instant offline support via Service Worker
- 🔄 Automatic generation of PWA manifest file (`manifest.json`)
- 🧩 Easy integration with native PHP applications (no framework required)
- 📦 Composer-friendly package structure
- 🛡️ No dependency on any PHP framework

---

## 🛠️ Technology Stack

Built with:

![JSON](https://img.shields.io/badge/-JSON-black?logo=json&logoColor=white)
![Composer](https://img.shields.io/badge/-Composer-brown?logo=composer&logoColor=white)
![PHP](https://img.shields.io/badge/-PHP-777BB4?logo=php&logoColor=white)

---

## 📦 Installation

Install via Composer:

```bash
composer require zmrq/php-pwa
```

---

## ⚙️ Usage

1. **Enable PWA in your application's root:**
    ```php
    <?php
        use Zmrq\PWA\Pwa;

        // The 'dir' parameter is the public root directory for PWA assets, default is 'pwa'.
        Pwa::enable(dir: 'pwa');

        // This returns an instance of the manifest class, allowing you to configure the manifest.
        $manifest = Pwa::enable(dir: 'pwa')
                        ->name('PHP PWA')
                        ->shortName('PWA')
                        ->startUrl('/');
    ?>
    ```

2. **Add the following script to your HTML `<head>`:**
    ```php
        <?= Pwa::renderMetaTags()
    ```

3. **Add the following script before the closing `</body>` tag:**
    ```php

        <?= Pwa::renderServiceWorker() ?>
    ```

---

## 📁 Example Directory Structure

```
/public
    /pwa
        ├── logo.png
        ├── offline.html
        ├── manifest.json
        └── sw.js
    ├── index.php
```
---

## 🖼️ Offline Page Preview

Below is a preview of the offline page as shown by `offline.png`:

<img src="offline.png" alt="Offline Page Preview">

---

## 🤝 Contributing

Contributions are welcome! Please fork this repository and submit a pull request.

---

## 📄 License

Licensed under the [MIT License](LICENSE).

---
