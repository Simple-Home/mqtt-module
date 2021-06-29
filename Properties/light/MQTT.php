<?php
namespace Modules\MQTT\Properties\light;

use App\PropertyTypes\light\light;
use App\Helpers\SettingManager;

/**
 * Class MQTT
 * @package App\PropertyTypes\light
 */
class MQTT extends light
{
    public $supportedAttributes = ["connected"];

    public function __construct($meta){
        $this->meta = $meta;
        $this->features = $this->getFeatures($this);

        $this->mqttConnected = false;

        // MQTT Host Settings
        $host = SettingManager::get('host', 'mqtt')['value'];
        $port = SettingManager::get('port', 'mqtt')['value'];
        $username = SettingManager::get('username', 'mqtt')['value'];
        $password = SettingManager::get('password', 'mqtt')['value'];
        $will = "";
        $clientID = "SimpleHome".rand(1,100);

        // Create MQTT Connection
        $this->MQTT = new \Modules\MQTT\phpMQTT($host, $port, $clientID);
        if($this->MQTT){
            if($this->MQTT->connect(true, $will, $username, $password)){
                $this->mqttConnected = true;
            }
        }
        $this->setAttributes('connected', (int)$this->mqttConnected);
    }

    // API (GET): http://localhost/api/v2/device/(hostname)/state/(value)?color=red
    public function state($value, $args){
        if(!$this->mqttConnected) return;

        // This is where you control the light
        $topic = SettingManager::get('commandtopic', 'device-'.$this->meta['device']->id)['value'];
        $this->MQTT->publish($topic, $value);
        $this->setState('state', $value);

        if(isset($args['brightness'])){
            $topic = SettingManager::get('brightnesstopic', 'device-'.$this->meta['device']->id)['value'];
            $this->MQTT->publish($topic, $args['brightness']);
            $this->setState('brightness', $args['brightness']);
        }
        $this->MQTT->close();
    }

    // API (GET): http://localhost/api/v2/device/(hostname)/brightness/(value)
    public function brightness($value){
        if(!$this->mqttConnected) return;

        // Brightness control code here
        $topic = SettingManager::get('brightnesstopic', 'device-'.$this->meta['device']->id)['value'];
        $this->MQTT->publish($topic, $value);
        $this->setState('brightness', $value);
        $this->MQTT->close();
    }

    // API (GET): http://localhost/api/v2/device/(hostname)/color/(value)
    public function color($value){
        if(!$this->mqttConnected) return;

        // Color control code here
        $topic = SettingManager::get('colortopic', 'device-'.$this->meta['device']->id)['value'];
        $this->MQTT->publish($topic, $value);
        $this->setState('color', $value);
        $this->MQTT->close();
    }

    // API (GET): http://localhost/api/v2/device/(hostname)/effect/(value)
    public function effect($value){
        if(!$this->mqttConnected) return;

        // Effect control code here
        $topic = SettingManager::get('effecttopic', 'device-'.$this->meta['device']->id)['value'];
        $this->MQTT->publish($topic, $value);
        $this->setState('effect', $value);
        $this->MQTT->close();
    }

    // API (GET): http://localhost/api/v2/device/(hostname)/colorTemp/(value)
    public function colorTemp($value){
        if(!$this->mqttConnected) return;

        // ColorTemp control code here
        $topic = SettingManager::get('colortemptopic', 'device-'.$this->meta['device']->id)['value'];
        $this->MQTT->publish($topic, $value);
        $this->setState('colorTemp', $value);
        $this->MQTT->close();
    }
}
