<?php
class DevicesList {
    public function loadJsonData($filePath) {
        $jsonContents = file_get_contents($filePath);
        return json_decode($jsonContents, true);
    }
}
?>
