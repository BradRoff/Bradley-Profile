<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your reCAPTCHA secret key
    $recaptcha_secret = '6Lf3OT8qAAAAAKs8WuLcGt8B8RClQo2U-hZyBwIl';  
    $recaptcha_response = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);

    // Verify the reCAPTCHA response
    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response";
    $response = @file_get_contents($recaptcha_url);

    if ($response === FALSE) {
        echo 'Error verifying reCAPTCHA. Please try again.';
        exit;
    }

    $response_keys = json_decode($response, true);

    // Check if reCAPTCHA was successfully verified
    if (intval($response_keys["success"]) !== 1) {
        echo 'reCAPTCHA verification failed. Please complete the reCAPTCHA.';
        exit;
    }

    /*
     Collect and sanitize input data. 
     */
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Assign sanitized data to array postData for expected output
    $postData = [
        'name' => $name,
        'email' => $email,
        'message' => $message
    ];

    /*
    Using and initializing cURL session (client URL) 
    curl_init: encrypted URL to send data
    curl_setopt: set various options
    CURLOPT_RETURNTRANSFER: ensures output is returned as a string
    CURLOPT_POST: ensures that the POST method is being used
    CURLOPT_POSTFIELDS: sets sanitized array fields using http_build_query()
    to encode the array into a URL-encoded string.
    */
    // Initialize cURL
    $ch = curl_init('3d6b734796a308f3c4f8a3666d08a29a');
    if ($ch === FALSE) {
        echo 'Failed to initialize cURL session.';
        exit;
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

    // Execute the cURL request
    $curl_response = curl_exec($ch);

    if ($curl_response === FALSE) {
        echo 'Error during cURL request: ' . curl_error($ch);
        curl_close($ch);
        exit;
    }

    // Close cURL session
    curl_close($ch);

    // Check if the response contains data, thus the message has been sent. 
    if ($curl_response) {
        echo 'Thank you for your message. It has been sent.';
    } else {
        echo 'Error sending message.';
    }
} else {
    echo 'Invalid request.';
}
?>
