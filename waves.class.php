<?php

Class Waves {

	private $node;
	
	const FIRST_ASSET_BLOCK = '236967';

	public function __construct($node) {
		$this->node = $node;
	}

	public function request($endpoint, $type = '') {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $this->node . $endpoint,
			CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'
		));
		return curl_exec($curl);
		curl_close($curl);
	}

	public function blockHeight() {
		$data = $this->request('/blocks/height');
		return $data;
	}

  public function validateAddress($args) {
    $data = $this->request('/addresses/validate/' . $args);
    return $data;
  }

	public function addressBalance($args) {
		$data = $this->request('/addresses/balance/' . $args);
		return $data;
	}

	public function assetBalance($args) {
		$data = $this->request('/assets/balance/' . $args);
		return $data;
	}

  public function txInfo($args) {
    $data = $this->request('/transactions/info/' . $args);
    return $data;
  }

  public function txLatest($args) {
    $data = $this->request('/transactions/address/' . $args['address'] . '/' . $args['limit']);
    return $data;
  }

	public function getBlocks($args) {
		$data = $this->request('/blocks/seq/' . $args['start'] . '/' . $args['end']);
		return $data;
	}

  public function getNodes() {
    $data = $this->request('/peers/connected');
    return $data;
  }
}

?>
