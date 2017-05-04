# Installing COD with composer

Drupal currently [does not support](https://www.drupal.org/node/2715441) installation of profile dependencies,
so you must use `wikimedia/composer-merge-plugin`:

```
composer require wikimedia/composer-merge-plugin
```

## Resources

- [Merging additional composer.json files](https://www.drupal.org/node/2822349)
- [Support for distributions](https://www.drupal.org/node/2715441)