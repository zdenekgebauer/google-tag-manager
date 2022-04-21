# Google Tag Manager 

Data Layer generator 

![](https://github.com/zdenekgebauer/google-tag-manager/workflows/build/badge.svg)

## Installation

`composer require zdenekgebauer/google-tag-manager`

## Usage

### Simple event 
```php
$event = new EventShare();
$event->method = 'Twitter';
$event->contentType = 'image';
$event->itemId = 'C_12345';

echo ((new DataLayer($event))->render());  // window.dataLayer.push({"event":"share","content_type":"image","item_id":"C_12345"});
```

### Ecommerce event with items
```php
$event = new EventPurchase();
$event->transactionId = '1234';
$event->value = '9.99';
$event->currency = 'USD';

$item = new Item('SKU12', 'Some gadget', 9.99, 1);
$item->brand = 'Acme';
$item->category = 'Cool Gadgets';
$event->addItem($item);

echo ((new DataLayer($event))->render());
```

### Custom content 
```php
class MyDataLayerContent extends DataLayerContent
{
    public ?string $requiredProperty = null;
    public ?string $optionalProperty = null;
    
    public function __construct()
    {
        $this->requiredProperties = ['requiredProperty'];
    }
        
    /**
     * @throws Exception
     */
    public function assertValid(): void
    {
        parent::assertValid(); // check required properties
        // .... some additional check        
    }
    
    public function jsonSerialize(): stdClass
    {
        $result = new stdClass();
        $result->required_property = $this->requiredProperty;
        Utils::addProperty($result, 'optional', $this->optionalProperty);
        return $result;
    }
}

$content = new MyDataLayerContent();
$content->requiredProperty = 'some';
echo ((new DataLayer($content))->render());  // window.dataLayer.push({"required_property":"some"});
```

## Official documentation  
[Google Analytics 4 events] https://developers.google.com/analytics/devguides/collection/ga4/reference/events

[Google Analytics 4 events for ecommerce] https://developers.google.com/analytics/devguides/collection/ga4/ecommerce?client_type=gtm

## Licence
Released under the [WTFPL license](copying.txt) http://www.wtfpl.net/about/.
