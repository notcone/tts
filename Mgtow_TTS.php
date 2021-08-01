<?php

use Aws\Credentials\Credentials;
use Aws\Polly\PollyClient;

class Mgtow_TTS
{
    public static $accessKeys = [];

    private $filePath;
    private $message;
    private $voice = 'Salli';
    private $quality = 'neural';
    private $region = 'eu-west-2';

    private function getRandomAccessKey()
    {
        $key = array_rand(self::$accessKeys);
        return self::$accessKeys[$key];
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
        return $this;
    }

    public function setVoice($voice)
    {
        $this->voice = $voice;
        return $this;
    }

    public function setQuality($quality)
    {
        $allowedValues = ['standard', 'neural'];
        if (!in_array($quality, $allowedValues))
            throw new \Exception('Invalid quality value');
        $this->quality = $quality;
        return $this;
    }

    public function setAmazonRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    public function handle()
    {
        $accesKey = $this->getRandomAccessKey();
        $awsAccessKeyId = $accesKey['awsAccessKeyId'];
        $awsSecretKey = $accesKey['awsSecretKey'];

        $credentials = new Credentials($awsAccessKeyId, $awsSecretKey);
        $client = new PollyClient([
            'version' => '2016-06-10',
            'credentials' => $credentials,
            'region' => $this->region,
        ]);
        $result = $client->synthesizeSpeech([
            'OutputFormat' => 'mp3',
            'Text' => $this->message,
            'TextType' => 'text',
            'VoiceId' => $this->voice,
            'Engine' => $this->quality,
        ]);
        $response = $result->get('AudioStream')->getContents();

        file_put_contents($this->filePath, $response);

        return 0;
    }
}
