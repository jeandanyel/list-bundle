
# List options

The following table summarizes the available options for the `ListType` and their descriptions:


| Option                    | Description                                                                                              | Type                         | Default             |
|---------------------------|----------------------------------------------------------------------------------------------------------|------------------------------|---------------------|
| `list_class`                | The list library class (e.g., `GridJsList::class`). This defines which library is used to render the list. | `string`                       | `GridJsList::class`    |
| `entity_class`              | The entity class used for the list (e.g., `Article::class` ).                                                | `string`                       | `null`                |
| `data`                      | The data passed to the list, can be a custom array. This option is ignored if `fetch_data_from_request` is `true`. | `array`                      | `null`                |
| `data_provider`             | The service that provides data to the list. This option is ignored if `data` is not `null`. | [`DataProviderInterface`](../src/Provider/DataProviderInterface.php)        | [`EntityDataProvider`](../src/Provider/EntityDataProvider.php)  |
| `query_builder`             | A callable function or query builder for customizing the Doctrine query. This is used by [`EntityDataProvider`](../src/Provider/EntityDataProvider.php). | `callable`                   | `null`                |
| `fetch_data_from_request`   | Indicates whether data is fetched from the request. If `true`, the `data` option is ignored. | `bool`                         | `false`                |
| `request_handler`            | Used when `fetch_data_from_request` is `true`. It manages the request for a list library. | [`RequestHandlerInterface`](../src/Handler/RequestHandlerInterface.php)    | The default value depends on the list library being used (e.g., [`GridJsRequestHandler`](../src/Handler/GridJsRequestHandler.php) for [`GridJsList`](../src/List/GridJsList.php)).                |
| `pagination`                | Enable or disable pagination for the list.                                                              | `bool`                         | `true`                |
| `pagination_page`           | The current page for pagination.                                                                        | `int`                          | `1`                    |
| `pagination_limit`           | The maximum number of items per page in pagination.                                                     | `int`                           | `20`                  |
