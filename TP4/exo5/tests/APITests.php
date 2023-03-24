<?php
    require_once('config.php'); // constants: _API_URL
    class APITests extends \PHPUnit_Framework_TestCase
    {
        public function testPOST()
        {
        $client = new Client(_API_URL, array(
            'request.options' => array(
            'exceptions' => false,
        )
        ));
        $data = array(
            'Login' => 'bob',
            'Mail' => 'bob@leponge.fr'
        );
        $request = $client->post('/api/programmers', null, json_encode($data));
        $response = $request->send();
        
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));
        $data = json_decode($response->getBody(true), true);
        $this->assertArrayHasKey('id', $data);
    }
}