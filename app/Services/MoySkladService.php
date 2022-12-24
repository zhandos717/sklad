<?php

namespace App\Services;

use Exception;

class MoySkladService
{

    public const UNKNOWN = 0;
    public const SETTINGS_REQUIRED = 1;
    public const ACTIVATED = 100;

    public $appId;
    public $accountId;
    public $infoMessage;

    public $store;

    public $accessToken;

    public int $status = self::UNKNOWN;

    /**
     * @throws Exception
     */
    static function get(): self
    {
        $app = $GLOBALS['currentAppInstance'];
        if (!$app) {
            throw new Exception("There is no current app instance context");
        }
        return $app;
    }

    public function __construct($appId, $accountId)
    {
        $this->appId = $appId;
        $this->accountId = $accountId;
    }

    function getStatusName(): ?string
    {
        return match ($this->status) {
            self::SETTINGS_REQUIRED => 'SettingsRequired',
            self::ACTIVATED => 'Activated',
            default => null,
        };
    }

    function persist()
    {
        @mkdir('data');

        file_put_contents($this->filename(), serialize($this));
    }

    function delete()
    {
        @unlink($this->filename());
    }

    private function filename()
    {
        return self::buildFilename($this->appId, $this->accountId);
    }

    private static function buildFilename($appId, $accountId)
    {
        return  "data/$appId.$accountId.app";
    }

    static function loadApp($accountId): self
    {
        return self::load(config('moysklad.app_id'), $accountId);
    }

    static function load($appId, $accountId): self
    {
        $data = @file_get_contents(self::buildFilename($appId, $accountId));
        if ($data === false) {
            $app = new self($appId, $accountId);
        } else {
            $app = unserialize($data);
        }
        $GLOBALS['currentAppInstance'] = $app;
        return $app;
    }
}
