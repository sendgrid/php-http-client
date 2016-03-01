<?php
class Client {

  function __construct($host, $request_headers= [], $version=null){
    /*
      @param host: Base URL for the api. (e.g. https://api.sendgrid.com)
      @type host:  string

      @param request_headers: A dictionary of the headers you want applied on all calls
      @type request_headers: dictionary

      @param version: The version number of the API.
      @type integer:
    */

    $this->host = $host;
    $this->request_headers = $request_headers;
    $this->version = $version;

    # _count and _url_path keep track of the dynamically built url
    $this->_count = 0;
    $this->_methods = ['delete', 'get', 'patch', 'post', 'put'];
    $this->_url_path = {};
    $this->_status_code = null;
    $this->_response_body = null;
    $this->_response_headers = null;
    $this->_response = null;
  }

  /*
    Resets the URL builder, so you can make a fresh new dynamic call.
  */
  private function _reset(self) {
    $this->_count = 0
    $this->_url_path = {}
    $this->_response = None
  }

  /**
    * Takes the method chained call and adds to the url path.
    *   @param name: The name of the method call
    *   @type name: string
    */
  private function _add_to_url_path($name) {
    $this->_url_path[$this->_count] = $name;
    $this->_count += 1;
  }

  /**
    *   Subclass this function for your own needs.
    *    Or just pass the version as part of the URL
    *    (e.g. client._('/v3'))
    * @param url: URI portion of the full URL being requested
    * @type url: string
    * @return: string
   */
  private function _build_versioned_url($url) {
    return sprintf("%s/v%d%s", $this->host, $this->_get_version(), $url);
  }

  /**
   * Build the final URL to be passed
   * @param query_params: A dictionary of all the query parameters
   * @type query_params: dictionary
   * @return:
   */
  private function _build_url($query_params = null) {

    $url = '';
    $count = 0;

    while ($count < count($this->_url_path)) {
      $url += sprintf("/%s", $this->_url_path[$count]);
      $count+=1;
    }

    if (isset($query_params)) {
      $url_values = urlencode(asort($query_params));
      $url = sprintf('%s?%s', $url, $url_values);
    }

    if (null != $this->_get_version()) {
      $url = $this->_build_versioned_url($url);
    } else {
      $url = $this->host + url;
    }

    return $url;
  }

  /**
   * Build the API call's response
   * :param response: The response object from the API call from urllib
   * :type response: urllib.Request object
   */
  private function _set_response($response) {

    // @todo fix this to handle the response from guzzle

    $this->_status_code = "";
    $this->_response_body = "";
    $this->_response_headers = "";
  }
  /**
   * Build the headers for the request
   * @param request_headers: headers to set for the API call
   * @type response: dict
   * @return:
   */
  private function _set_headers($request_headers) {
    $this->request_headers = array_merge($this->request_headers, $request_headers);
  }

  /**
   * Make the API call and return the response. This is separated into it's own function, so we can mock it easily for testing.
   * @param opener:
   * @type opener:
   * @param request: url payload to request
   * @type request: urllib.Request object
   * @return:
   */
  private function _make_request($request) {
      //@todo make the call using guzzle, and fix the return value

      return null;
  }

  /**
    * Add variable values to the URL
    * (e.g. /your/api/{variable_value}/call)
    */
  public function _($value){
    $this->_add_to_url_path($value);
    return $this;
  }

  /**
    * Dynamically add method calls to the url, then call a method.
    * (e.g. client.name.name.method())
    */
  public function __call($name, $args){

    // @todo handle args

    if (in_array($name, $this->_methods)) {
        $this->_make_request();
        return $this;
    }

    $this->_cache[$this->_count] = $name;
    $this->_count = $this->_count + 1;
    return $this;
  }

  /**
   * @return: integer, status code of API call
   */
  public function status_code() {
    return $this->_status_code;
  }

  /**
   * @return: response from the API
   */
  public function response_body() {
    return $this->_response_body;
  }

  /**
   * @return: dict of response headers
   */
  public function response_headers() {
    return $this->_response_headers;
  }

  /**
   * Add the version to the path
   */
  public function version($version) {
      $this->_version = $version;
      return $this;
  }

  private function _get_version() {
    return $this->_version;
  }

}
?>
