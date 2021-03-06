<?php
namespace Modules\MQTT\Properties\toggle;

use App\PropertyTypes\toggle\toggle;
use App\Helpers\SettingManager;

/**
 * Class MQTT
 * @package App\PropertyTypes\toggle
 */
class MQTT extends toggle
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

        //Create MQTT Connection
        $this->MQTT = new \Modules\MQTT\phpMQTT($host, $port, $clientID);
        if($this->MQTT){
            if($this->MQTT->connect(true, $will, $username, $password)){
                $this->mqttConnected = true;
            }
        }
        $this->setAttributes('connected', (int)$this->mqttConnected);
    }

    // API (GET): http://localhost/api/v2/device/(hostname)/state/(value)
    public function state($value){
        // This is where you control the light
        $topic = SettingManager::get('commandtopic', 'device-'.$this->meta['device']->id)['value'];
        $this->MQTT->publish($topic, $value);

        // This is how you notify Simple Home of the state change
        $this->setState('state', $value);
    }
}
