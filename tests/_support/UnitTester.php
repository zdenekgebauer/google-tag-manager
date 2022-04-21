<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class UnitTester extends \Codeception\Actor
{
    use _generated\UnitTesterActions;

    /**
     * Define custom actions here
     */

    public function grabJsonFromDataLayer(string $dataLayer): stdClass
    {
        $dataLayer = str_replace('window.dataLayer.push({"ecommerce":null});', '', $dataLayer);
        $dataLayer = ltrim($dataLayer, 'window.dataLayer.push(');
        $dataLayer = rtrim($dataLayer, ');');
        return json_decode($dataLayer, false, 512, JSON_THROW_ON_ERROR);
    }
}
