<?php
namespace Modules\MQTT\Device;

use App\Helpers\SettingManager;

class Device
{

    public function __construct($device){
        $this->device = $device;
    }

    public function create()
    {
        $id = $this->device->id;

        //All device types get this
        SettingManager::register('commandtopic', '', 'string', 'device-'.$id);

        switch ($this->device->type) {
            case "light":
                SettingManager::register('brightnesstopic', '', 'string', 'device-'.$id);
                SettingManager::register('colortopic', '', 'string', 'device-'.$id);
                SettingManager::register('effecttopic', '', 'string', 'device-'.$id);
                SettingManager::register('colortemptopic', '', 'string', 'device-'.$id);
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
