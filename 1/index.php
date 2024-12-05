<?php
class Utility {
    public static function generateId() {
        return uniqid();
    }
}
echo Utility::generateId();
