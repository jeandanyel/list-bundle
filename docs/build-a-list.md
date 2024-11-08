# Build a list

The system is designed to work seamlessly with Doctrine entities. It uses a [`ListBuilder`](../src/Builder/ListBuilder.php), inspired by Symfony's Form Builder, to create configurable list columns, sorting, and filtering.

Suppose we have an entity `Article` with the fields `title`, `user`, and `createdAt`:

```php
namespace App\Entity;

class Article
{
    // ...

    private string $title;

    private User $user;

    private \DateTime $createdAt;

    // ...
}

```

## Create a list type class

Create a list type by extending the [`AbstractListType`](../src/List/AbstractListType.php) class.
In the `buildList` method, use the `add` method of the `ListBuilder` to add and configure the list columns.
Then, in the `configureOptions` method, set the `entity_class` option to the appropriate entity class (e.g., `Article::class`).

```php
namespace App\List;

use App\Entity\Article;
use Jeandanyel\ListBundle\Builder\ListBuilderInterface;
use Jeandanyel\ListBundle\Column\DateColumnType;
use Jeandanyel\ListBundle\Column\TextColumnType;
use Jeandanyel\ListBundle\List\AbstractListType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleListType extends AbstractListType
{
    public function buildList(ListBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextColumnType::class, [
                'label' => 'Title',
            ])
            ->add('user.name', TextColumnType::class, [
                'label' => 'Author',
            ])
            ->add('createdAt', DateColumnType::class, [
                'label' => 'Date',
                'format' => 'Y-m-d H:i:s',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entity_class' => Article::class,
        ]);
    }
}
```

> [!NOTE]
> Note that the `entity_class` option is optional. You can use the
> `data` option to pass custom data directly to the list, or configure
> the `data_provider` option to specify a service that provides data
> from a different source.
> 
> Refer to the [list of available options](./list-type-options.md) for further configuration of your list type.

## Create a list in a controller

To create a list, use the `create` method of the [`ListFactory`](../src/Factory/ListFactory.php) service, passing the list type as an argument (e.g., `ArticleListType::class`). 
Then, call the `createView` method to generate the view data and pass it to your Twig template.

```php
namespace App\Controller;

use App\List\ArticleListType;
use Jeandanyel\ListBundle\Factory\ListFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    public function list(ListFactoryInterface $listFactory): Response
    {
        $list = $listFactory->create(ArticleListType::class);

        // ...

        return $this->render('article/list.html.twig', [
            'list' => $list->createView(),
        ]);
    }
}

```

## Render a list in a Twig template

Finally, in your Twig template, use the `list` function to render the list.

```twig
{{ list(list) }}
```