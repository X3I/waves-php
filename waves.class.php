<?php

Class Waves {

    private $node;

    public function __construct($node) {
        $this->node       = $node;
        $this->firstAsset = '236967'; // The first block that contained an Asset
    }

    /**
     * Send request using curl
     * @param  string $endpoint
     * @param  string $type
     * @return string
     */

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

    /**
     * Get blockchain height
     * @return string
     */

    public function blockHeight() {
        $data = $this->request('/blocks/height');
        return $data;
    }

    /**
     * Check whether address is valid or not
     * @param  string $args
     * @return string
     */

    public function validateAddress($args) {
        $data = $this->request('/addresses/validate/' . $args);
        return $data;
    }

    /**
     * Account's balance
     * @param  string $args
     * @return string
     */

    public function addressBalance($args) {
        $data = $this->request('/addresses/balance/' . $args);
        return $data;
    }

    /**
     * Account's balances for all assets
     * @param  string $args
     * @return string
     */

    public function assetBalance($args) {
        $data = $this->request('/assets/balance/' . $args);
        return $data;
    }

    /**
     * Get info for a transaction id
     * @param  string $args
     * @return string
     */

    public function txInfo($args) {
        $data = $this->request('/transactions/info/' . $args);
        return $data;
    }

    /**
     * Get latest transactions for an address
     * @param  array $args
     * @return string
     */

    public function txLatest($args) {
        $data = $this->request('/transactions/address/' . $args['address'] . '/' . $args['limit']);
        return $data;
    }

    /**
     * Get unconfirmed transactions
     * @return string
     */

    public function txUnconfirmed() {
        $data = $this->request('/transactions/unconfirmed/');
        return $data;
    }

    /**
     * Get number of unconfirmed transactions in the UTX pool
     * @return string
     */

    public function txUnconfirmedSize() {
        $data = $this->request('/transactions/unconfirmed/size');
        return $data;
    }

    /**
     * Get transaction that is in the UTX
     * @param  string $args
     * @return string
     */

    public function txUnconfirmedInfo($args) {
        $data = $this->request('/transactions/unconfirmed/info/' . $args);
        return $data;
    }

    /**
     * Get block at specified heights
     * @param  array $args
     * @return string
     */

    public function getBlocks($args) {
        $data = $this->request('/blocks/seq/' . $args['start'] . '/' . $args['end']);
        return $data;
    }

    /**
     * Get genesis block data
     * @return string
     */

    public function getBlocksFirst() {
        $data = $this->request('/blocks/first/');
        return $data;
    }

    /**
     * Get last block data
     * @return string
     */

    public function getBlocksLast() {
        $data = $this->request('/blocks/last/');
        return $data;
    }

    /**
     * Full peer list
     * @return string
     */

    public function getPeers() {
        $data = $this->request('/peers/all');
        return $data;
    }

    /**
     * Connected peers list
     * @return string
     */

    public function getPeersConnected() {
        $data = $this->request('/peers/connected');
        return $data;
    }

    /**
     * Blacklisted peers list
     * @return string
     */

    public function getPeersBlacklisted() {
        $data = $this->request('/peers/blacklisted');
        return $data;
    }

    /**
     * Suspended peers list
     * @return string
     */

    public function getPeersSuspended() {
        $data = $this->request('/peers/suspended');
        return $data;
    }
}

?>

