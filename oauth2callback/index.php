<?
/*
 * Copyright (C) 2013 Tony Gaitatzis
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * Author: Tony Gaitatzis - http://www.linkedin.com/in/tonygaitatzis
 * This code complements the online tutorial:
 * http://20missionglass.tumblr.com/post/60787835108/programming-an-oauth2-client-app-in-php
 */

require('../config.php');
require('../HttpPost.class.php');

/**
 * the OAuth server should have brought us to this page with a $_GET['code']
 */
if(isset($_GET['code'])) {
    // try to get an access token
    $code = $_GET['code'];
    $url = 'https://accounts.google.com/o/oauth2/token';
	// this will be our POST data to send back to the OAuth server in exchange
	// for an access token
    $params = array(
        "code" => $code,
        "client_id" => $oauth2_client_id,
        "client_secret" => $oauth2_secret,
        "redirect_uri" => $oauth2_redirect,
        "grant_type" => "authorization_code"
    );
 
	// build a new HTTP POST request
    $request = new HttpPost($url);
    $request->setPostData($params);
    $request->send();

	// decode the incoming string as JSON
    $responseObj = json_decode($request->getHttpResponse());

	// Tada: we have an access token!
    echo "OAuth2 server provided access token: " . $responseObj->access_token;
}


?>
