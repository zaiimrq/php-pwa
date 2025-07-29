<?php

declare(strict_types=1);

namespace Zmrq\PWA;

use Exception;
use Zmrq\PWA\Enums\AssetEnum;
use Zmrq\PWA\ValueObjects\Manifest;
use Zmrq\PWA\Exceptions\InactivePwaException;

class Pwa
{
    public static bool $enabled = false;
    public static ?string $dir = null;

    public static function enable(?string $dir = 'pwa'): Manifest
    {
        try {
            self::$dir ??= $dir;
            $absolutePath = getcwd() . DIRECTORY_SEPARATOR . self::$dir;
            if (!is_dir($absolutePath)) {
                mkdir($absolutePath, 0755, true);
                self::moveResources();
            }
            self::$enabled = true;
        } catch (Exception $e) {
            echo "Failed to enable PWA: " . $e->getMessage();
            exit;
        }

        return new Manifest();
    }

    private static function moveResources(): void
    {
        $assets = AssetEnum::toArray();
        foreach ($assets as $asset) {
            $source = __DIR__ . '/../res/' . $asset;
            $destination = self::$dir . '/' . $asset;
            if (!file_exists($destination)) {
                copy($source, $destination);
            }
        }
    }

    public static function renderMetaTags(): string
    {
        if (!self::$enabled) throw new InactivePwaException();

        $manifestUrl = self::$dir . '/' . AssetEnum::Manifest->value;
        $themeColor = (new Manifest())->themeColor;
        $icon = self::$dir . '/' . AssetEnum::Icon->value;
        return <<<HTML
            <link rel="manifest" href="{$manifestUrl}">
            <meta name="theme-color" content="{$themeColor}">
            <link rel="apple-touch-icon" href="{$icon}">
        HTML;
    }

    public static function renderServiceWorker(): string
    {
        if (!self::$enabled) throw new InactivePwaException();

        $serviceWorkerUrl = basename(self::$dir) . '/' . AssetEnum::ServiceWorker->value;

        return <<<HTML
            <script>
                if ('serviceWorker' in navigator) {
                    window.addEventListener('load', function() {
                        navigator.serviceWorker.register('{$serviceWorkerUrl}')
                            .then(function(registration) {
                                console.log('Service Worker registered with scope:', registration.scope);
                            })
                            .catch(function(error) {
                                console.error('Service Worker registration failed:', error);
                            });
                    });
                }
            </script>
        HTML;
    }
}
