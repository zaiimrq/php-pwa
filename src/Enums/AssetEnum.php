<?php
namespace Zmrq\PWA\Enums;
enum AssetEnum: string {
    case Manifest = 'manifest.json';
    case ServiceWorker = 'sw.js';
    case Icon = 'logo.png';
    case OfflinePage = 'offline.html';

    public static function toArray(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
