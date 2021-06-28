<?php
namespace Modules\MQTT\Properties\toggle;

use App\PropertyTypes\toggle\toggle;

/**
 * Class Example
 * @package App\PropertyTypes\toggle
 */
class MQTT extends toggle
{
    public $supportedAttributes = ["connected"];

    public function __construct($meta){
        $this->meta = $meta;
        $this->features = $this->getFeatures($this);
        $this->settings = $meta['settings'];

        $this->mqttConnected = false;

        // MQTT Host Settings
        $host = $this->settings['integration']['simplehome.integrations.MQTT.host'];
        $port = 1883;
        $username = $this->settings['integration']['simplehome.integrations.MQTT.username'];
        $password = $this->settings['integration']['simplehome.integrations.MQTT.password'];
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

    //API (GET): http://localhost/api/v2/device/(hostname)/state/(value)
    public function state($value){ 
        //This is where you control the light

        //This is how you notify Simple Home of the state change
        $this->MQTT->publish($this->settings['device']['commandtopic'], $value);
        $this->setState('state', $value);
    }
}
