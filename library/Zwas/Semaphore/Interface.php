<?php

interface Zwas_Semaphore_Interface {
    /**
     * Gets the content from the session
     */
    public static function getValue();
    
    /**
     * Deletes the namespace from the session
     */
    public static function destroy();
}