# list-bundle

The ListBundle provides a flexible solution for generating and customizing lists.

While it is designed to work seamlessly with Doctrine entities, it can also handle and list any type of data, giving you the flexibility to adapt it to your specific needs.

The system is built to integrate with nearly any list library, though currently, only [GridJS.io](https://www.gridjs.io) is supported. The list builder is heavily inspired by Symfony's form builder, providing a familiar and flexible structure.

This bundle is actively under development, with the next feature being the addition of filters and search functionality. Contributions to the project are welcome 🥳.

- [Installation](docs/installation.md)
    - [Install list library dependencies](docs/installation.md#install-list-library-dependencies)
- [Build a list](docs/build-a-list.md)
    - [Create a list type class](docs/build-a-list.md#create-a-list-type-class)
    - [Create a list in a controller](docs/build-a-list.md#create-a-list-in-a-controller)
    - [Render a list in a Twig template](docs/build-a-list.md#render-a-list-in-a-twig-template)
- [ListType options](docs/list-type-options.md)
- [Custom DataProvider](docs/custom-data-provider.md)
    - [Create a custom `DataProvider`](docs/custom-data-provider.md#create-a-custom-dataprovider)
    - [Configure a list to use a custom `DataProvider`](docs/custom-data-provider.md#configure-a-list-to-use-a-custom-dataprovider)

