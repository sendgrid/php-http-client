<?php
class Response {

  function __construct($status_code = null, $response_body = null, $response_headers = null){
    $this->_status_code = $status_code;
    $this->_response_body = $response_body;
    $this->_response_headers = $response_headers;
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
}

class Client {

  function __construct($host, $request_headers = null, $version = null, $url_path = null){
    /*
      @param host: Base URL for the api. (e.g. https://api.sendgrid.com)
      @type host:  string

      @param request_headers: A dictionary of the headers you want applied on all calls
      @type request_headers: dictionary

      @param version: The version number of the API.
      @type integer:
    */

    $this->host = $host;
    $this->request_headers = ($request_headers ? $request_headers : []);
    $this->_version = $version;
    # _url_path keeps track of the dynamically built url
    $this->_url_path = ($url_path ? $url_path : []);
    # These are the supported HTTP verbs
    $this->_methods = ['delete', 'get', 'patch', 'post', 'put'];
  }

  /**
    * Takes the method chained call and adds to the url path.
    *   @param name: The name of the method call
    *   @type name: string
    */
  private function _build_client($name = null) {
    if($name != null){
        array_push($this->_url_path, $name);
    }
    $url_path = $this->_url_path;
    $this->_url_path = [];
    return new Client($this->host, $this->request_headers, $this->_version, $url_path);
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

    $url = '/'.implode('/', $this->_url_path);

    if (isset($query_params)) {
      $url_values = http_build_query($query_params);
      $url = sprintf('%s?%s', $url, $url_values);
    }
    
    if (null != $this->_get_version()) {
      $url = $this->_build_versioned_url($url);
    } else {
      $url = sprintf('%s%s', $this->host, $url);;
    }

    return $url;
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
  private function _make_request($method, $url, $request_body = null, $request_headers = null) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, 1);
    switch($method){
        case 'get':
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
          break;
        case 'post':
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
          $request_body = json_encode($request_body);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $request_body);
          $content_length = array('Content-Length: ' . strlen($request_body));
          $this->request_headers = array_merge($this->request_headers, $content_length);
          break;
        case 'patch':
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
          $request_body = json_encode($request_body);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $request_body);
          $content_length = array('Content-Length: ' . strlen($request_body));
          $this->request_headers = array_merge($this->request_headers, $content_length);
          break;
        case 'put':
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
          $request_body = json_encode($request_body);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $request_body);
          $content_length = array('Content-Length: ' . strlen($request_body));
          $this->request_headers = array_merge($this->request_headers, $content_length);
          break;
        case 'delete':
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
          break;
        default:
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
          break;
    }
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    if(isset($request_headers)){
        $this->request_headers = array_merge($this->request_headers, $request_headers);
    }
    curl_setopt($curl, CURLOPT_HTTPHEADER, $this->request_headers);
    $curl_response = curl_exec($curl);
    $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $response_header = substr($curl_response, 0, $header_size);
    $response_body = substr($curl_response, $header_size);
    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return new Response($status_code, $response_body, $response_header);
  }

  /**
    * Add variable values to the URL
    * (e.g. /your/api/{variable_value}/call)
    */
  public function _($name){
    return $this->_build_client($name);
  }

  /**
    * Dynamically add method calls to the url, then call a method.
    * (e.g. client.name.name.method())
    */
  public function __call($name, $args){
      
    if($name == 'version'){
        return version($name);
    }
    
    if (in_array($name, $this->_methods)) {
        $request_body = ($args ? $args[0] : null);
        $query_params = ((count($args) >= 2) ? $args[1] : null);
        $url = $this->_build_url($query_params);
        $request_headers = ((count($args) == 3) ? $args[2] : null);
        return $this->_make_request($name, $url, $request_body, $request_headers);
    }
    
    return $this->_($name);
  }

  /**
   * Add the version to the path
   */
  public function version($version) {
      $this->_version = $version;
      return $this->_(null);
  }

  private function _get_version() {
    return $this->_version;
  }

}
?>
