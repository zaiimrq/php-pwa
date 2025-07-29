<?php

namespace Zmrq\PWA\ValueObjects;

use Exception;
use Zmrq\PWA\Pwa;
use Zmrq\PWA\Enums\AssetEnum;
use Zmrq\PWA\Exceptions\InactivePwaException;

final class Manifest
{
    private string $name = 'PHP PWA';
    private string $shortName = 'PWA';
    private string $startUrl = '/';
    private string $display = 'fullscreen';
    private string $backgroundColor = '#ffffff';
    private string $themeColor = '#000000';
    private string $description = 'A Progressive Web Application setup for php native.';

    public function __get(string $property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        throw new \InvalidArgumentException("Property {$property} does not exist.");
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function shortName(string $shortName): self
    {
        $this->shortName = $shortName;
        return $this;
    }
    public function startUrl(string $startUrl): self
    {
        $this->startUrl = $startUrl;
        return $this;
    }

    public function display(string $display): self
    {
        $this->display = $display;
        return $this;
    }

    public function backgroundColor(string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    public function themeColor(string $themeColor): self
    {
        $this->themeColor = $themeColor;
        return $this;
    }
    public function description(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'short_name' => $this->shortName,
            'start_url' => $this->startUrl,
            'display' => $this->display,
            'background_color' => $this->backgroundColor,
            'theme_color' => $this->themeColor,
            'description' => $this->description,
            'icons' => [
                [
                    'src' => 'logo.png',
                    'sizes' => '512x512',
                    'type' => 'image/png'
                ]
            ]
        ];
    }

    public function save(): void
    {
        if (!Pwa::$enabled) {
            throw new InactivePwaException();
        }

        if (!is_writable(Pwa::$dir)) {
            throw new Exception("Directory " . Pwa::$dir . " is not writable.");
        }
        file_put_contents(
            Pwa::$dir . DIRECTORY_SEPARATOR . AssetEnum::Manifest->value,
            json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }
}
