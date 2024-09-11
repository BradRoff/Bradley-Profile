<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /*
     Collect and sanitize input data. 
     */
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // assign sanitized data to array postData for expected output
    $postData = [
        'name' => $name,
        'email' => $email,
        'message' => $message
    ];

    /*
    using and initializing cURL session (client URL) 
    curl_init: encrypted url to send data
    curl_setopt: set varios options
    CURLOPT_RETURNTRANSFER: ensures outuput is returend as a string
    CURLOPT_POST: ensures that the post method is being used
    CURLOPT_POSTFIELDS: setts sanitized aray fields using http_build_query()
    to encode the array into a URL encoded string.
    */
    // Initialize cURL

    $ch = curl_init('3d6b734796a308f3c4f8a3666d08a29a');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

    // Execute and closes to free resorces
    $response = curl_exec($ch);
    curl_close($ch);

    // Check the response contains data, thus message has been sent. 
    if ($response) {
        echo 'Thank you for your message. It has been sent.';
    } else {
        echo 'Error sending message.';
    }
} else {
    echo 'Invalid request.';
}
?>