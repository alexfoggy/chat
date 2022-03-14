<?php

// Generating user token
if (!function_exists('generateToken')) {

    function generateToken()
    {
        return str_replace(['=', '==', '+', '/'], '', base64_encode(random_bytes(32)));
    }
}


// Update status
if (!function_exists('updateStatus')) {

    function updateStatus($object, $column_name, $status)
    {
        return $object->update([$column_name => $status]);
    }
}
