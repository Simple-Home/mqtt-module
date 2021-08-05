<?php
namespace Modules\MQTT\Device;

use App\Helpers\SettingManager;
use App\Models\Property;

class Device
{

    public function __construct($device){
        $this->device = $device;
    }

    public function create()
    {
        $id = $this->device->id;

        //All device types get this
        SettingManager::register('commandtopic', 'device/state', 'string', 'device-'.$id);

        switch ($this->device->type) {
            case "light":
                SettingManager::register('brightnesstopic', 'device/brightness', 'string', 'device-'.$id);
                SettingManager::register('colortopic', 'device/color', 'string', 'device-'.$id);
                SettingManager::register('effecttopic', 'device/effect', 'string', 'device-'.$id);
                SettingManager::register('colortemptopic', 'device/temp', 'string', 'device-'.$id);

                //Create Properties, this is a rough draft I will clean this up
                //State
                $property = new Property;
                $property->feature = "state";
                $property->icon = "fas fa-power-off";
                $property->nick_name = "On/Off";
                $property->room_id = 1;
                $property->device_id = (int)$this->device->id;
                $property->history = 1;
                $property->save();

                //Brightness
                $property = new Property;
                $property->feature = "brightness";
                $property->icon = "fas fa-sun";
                $property->nick_name = "Brightness";
                $property->room_id = 1;
                $property->device_id = (int)$this->device->id;
                $property->history = 1;
                $property->save();

                //Color
                $property = new Property;
                $property->feature = "color";
                $property->icon = "fas fa-palette";
                $property->nick_name = "Color";
                $property->room_id = 1;
                $property->device_id = (int)$this->device->id;
                $property->history = 1;
                $property->save();

                //Color Temp
                $property = new Property;
                $property->feature = "colortemp";
                $property->icon = "fas fa-robot";
                $property->nick_name = "Color Temp";
                $property->room_id = 1;
                $property->device_id = (int)$this->device->id;
                $property->history = 1;
                $property->save();

                //Effect
                $property = new Property;
                $property->feature = "effect";
                $property->icon = "fas fa-robot";
                $property->nick_name = "Effect";
                $property->room_id = 1;
                $property->device_id = (int)$this->device->id;
                $property->history = 1;
                $property->save();
                break;
            case "toggle":
                break;
            case "speaker":
                break;
        }
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
