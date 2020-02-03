<?php

/**
 * Cards.php
 * php version 7.2.0
 *
 * @category Class
 * @package  Xendit
 * @author   Ellen <ellen@xendit.co>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://api.xendit.co
 */

namespace Xendit;

/**
 * Class Cards
 *
 * @category Class
 * @package  Xendit
 * @author   Ellen <ellen@xendit.co>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://api.xendit.co
 */
class Cards
{
    use ApiOperations\Request;
    use ApiOperations\Retrieve;
    use ApiOperations\Create;

    /**
     * Instantiate base URL
     *
     * @return string
     */
    public static function classUrl()
    {
        return "/credit_card_charges";
    }

    /**
     * Capture charge, see https://xendit.github.io/apireference/?bash#capture-charge
     * for more details
     *
     * @param string $id      charge ID
     * @param array  $params  user parameters
     * @param array  $headers user headers
     *
     * @return array [
     *  'created' => string,
     *  'status' => string,
     *  'business_id' => string,
     *  'authorized_amount' => int,
     *  'external_id' => string,
     *  'merchant_id' => string,
     *  'merchant_reference_code' => string,
     *  'card_type' => string,
     *  'masked_card_number' => string,
     *  'charge_type' => string,
     *  'card_brand' => string,
     *  'bank_reconciliation_id' => string,
     *  'capture_amount' => int,
     *  'descriptor' => string,
     *  'id' => string
     * ]
     * @throws Exceptions\ApiExceptions
     */
    public static function capture($id, $params = [], $headers = [])
    {
        $url = self::classUrl() . '/' . $id . '/capture';
        $requiredParams = ['amount'];

        self::validateParams($params, $requiredParams);

        return static::_request('POST', $url, $params, $headers);
    }

    /**
     * Instantiate required params for Create
     *
     * @return array
     */
    public static function createReqParams()
    {
        return ['token_id', 'external_id', 'amount'];
    }

    /**
     * Reverse authorized charge
     *
     * @param string $id      charge ID
     * @param array  $params  user params
     * @param array  $headers user headers
     *
     * @return array [
     *  'created' => string,
     *  'credit_card_charge_id' => string,
     *  'external_id' => string,
     *  'business_id' => string,
     *  'amount' => int,
     *  'status' => string,
     *  'id' => string
     * ]
     * @throws Exceptions\ApiExceptions
     */
    public static function reverseAuthorization($id, $params = [], $headers = [])
    {
        $url = self::classUrl() . '/' . $id . '/auth_reversal';
        $requiredParams = ['external_id'];

        self::validateParams($params, $requiredParams);

        return static::_request('POST', $url, $params, $headers);
    }

    /**
     * Create refund, see https://xendit.github.io/apireference/?bash#capture-charge
     * for more details
     *
     * @param string $id      charge ID
     * @param array  $params  user parameters
     * @param array  $headers user headers
     *
     * @return array [
     *  'updated' => string,
     *  'created' => string,
     *  'credit_card_charge_id' => string,
     *  'user_id' => string,
     *  'amount' => int,
     *  'external_id' => string,
     *  'status' => string,
     *  'fee_refund_amount' => int,
     *  'id' => string
     * ]
     * @throws Exceptions\ApiExceptions
     */
    public static function createRefund($id, $params = [], $headers = [])
    {
        $url = self::classUrl() . '/' . $id . '/refunds';
        $requiredParams = ['amount', 'external_id'];

        self::validateParams($params, $requiredParams);

        return static::_request('POST', $url, $params, $headers);
    }
}