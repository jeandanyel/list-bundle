# Custom DataProvider

By default, the system is designed to work with Doctrine entities, and the EntityDataProvider service is responsible for providing data according to your list configurations.

However, there may be cases where some lists are not directly tied to entities or if you need to list other types of data. In such cases, creating a custom `DataProvider` can be very useful, especially if the data comes from an external source (such as an API, a database, a file, etc.). This allows you to manage and render data from any source, making your list more flexible and adaptable to various use cases.

## Create a custom `DataProvider`

To create a custom `DataProvider`, simply create a service that implements the [`DataProviderInterface`](../src/Provider/DataProviderInterface.php). You need to implement two methods: `getData`, which retrieves and returns an array of sorted, filtered, and paginated data according to the list configuration, and `getTotal`, which returns the total number of items, excluding pagination.

```php
namespace App\Provider;

use App\Api\CoinGeckoApi;
use Jeandanyel\ListBundle\List\ListInterface;
use Jeandanyel\ListBundle\Provider\DataProviderInterface;

class CryptocurrencyDataProvider implements DataProviderInterface
{
    public function __construct(private CoinGeckoApi $coinGeckoApi) {}

    public function getData(ListInterface $list): mixed
    {
        $columns = $list->getColumns();

        // Generate request parameters based on the configurations of the list and its columns (e.g., filters, sorting, pagination, etc.)
        $parameters = [/* ... */];

        // Fetch data from an external API, e.g., get cryptocurrencies from the CoinGecko's API.
        return $this->coinGeckoApi->getCoinsList($parameters);
    }

    public function getTotal(ListInterface $list): int
    {
        // Return the total number of items available, not considering pagination
    }
}
```

## Configure a list to use a custom `DataProvider`

Once your custom `DataProvider` is implemented, you can use it in your list configurations by setting the `data_provider` option to your custom service. 

```php
<?php

namespace App\List;

use Jeandanyel\ListBundle\List\AbstractListType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CryptocurrencyListType extends AbstractListType
{
    public function __construct(private CryptocurrencyDataProvider $cryptocurrencyDataProvider) {}

    // ...

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_provider' => $this->cryptocurrencyDataProvider,
            // ...
        ]);
    }
}
```