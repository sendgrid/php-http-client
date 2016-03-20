<?php
class ConfigTest_Config extends PHPUnit_Framework_TestCase
{
    protected 
        $config,
        $base_path,
        $config_filename;
    
    protected function setUp()
    {
        $this->base_path = dirname("..");
        $this->config_filename = '.env_sample';
        $this->config = new SendGrid\Config($this->base_path, $this->config_filename);
    }
    
    public function testInitialization()
    {
        $this->assertEquals($api_key = getenv('SENDGRID_API_KEY'), "<your_sendgrid_api_key>");
        $this->assertEquals($api_key = getenv('HOST'), "<base_url_for_live_api_host>");
        $this->assertEquals($api_key = getenv('MOCK_HOST'), "<base_url_for_remote_mocked_api_host>");
        $this->assertEquals($api_key = getenv('LOCAL_HOST'), "<base_url_for_local_mocked_api_host>");
    }
}
?>