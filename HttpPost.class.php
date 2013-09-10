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


/**
 * HttpPost allows us to construct and send a POST request to
 * another web server
 * 
 * @author Tony Gaitatzis
 */
class HttpPost {
	public $url;
	public $postString;
	public $httpResponse;
	
	public $ch;
	
	/**
	 * Constructs an HttpPost object and initializes CURL
	 *
	 * @param url the url to be accessed
	 */
	public function __construct($url) {
		$this->url = $url;
		$this->ch = curl_init( $this->url );
		curl_setopt( $this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $this->ch, CURLOPT_HEADER, 0);
		curl_setopt( $this->ch, CURLOPT_RETURNTRANSFER, 1);
	}
	
	/**
	 * shut down CURL before destroying the HttpPost object
	 */
	public function __destruct() {
		curl_close($this->ch);
	}
	
	/**
	 * Convert an incoming associative array into a POST string
	 * for use with our HTTP POST
	 *
	 * @param params an associative array of data pairs
	 */
	public function setPostData($params) {
		$this->postString = http_build_query($params);
		curl_setopt( $this->ch, CURLOPT_POST, 1);
		curl_setopt( $this->ch, CURLOPT_POSTFIELDS, $this->postString);
	}
	
	/**
	 * Make the POST request to the server
	 */
	public function send() {
		$this->httpResponse = curl_exec( $this->ch );
	}
	/**
	 * Read the HTTP Response returned by the server
	 */
	public function getResponse() {
		return $this->httpResponse;
	}
	
}

?>
