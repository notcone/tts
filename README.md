# TextToSpeech

You need composer with autoloader to use this code. 

Install `aws/aws-sdk-php` using composer
`composer require aws/aws-sdk-php`
**OR**
add `"aws/aws-sdk-php": "^3.185"` to the require block of your composer.json

You can use one or multiple AWS keys

How to use:


```php
Mgtow_TTS::$accessKeys = [
    [
        'awsAccessKeyId' => 'XXXXXXXXXXXXXXXXXXXX',
        'awsSecretKey' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    ],
    [
        'awsAccessKeyId' => 'XXXXXXXXXXXXXXXXXXXX',
        'awsSecretKey' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    ],
];

return (new Mgtow_TTS())
    ->setMessage('Test message')
    ->setVoice('Salli')
    ->setQuality('neural')
    ->setFilePath(__DIR__ . '/tts.mp3')
    ->setAmazonRegion('eu-west-2')
    ->handle();
```
