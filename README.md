# Test project for Symfony

## Description

This project is a case study for typical web projects written in PHP using the Symfony framework.
The main idea is to create a common architecture that is both easy to extend and easy to test.

## Usage

To try out the functionality, you have to adapt the settings in the ```SolrGateway.php``` file.
The array variable ```$config``` must point to a running Solr server containing data of the FWB project (http://fwb-online.de).

Then run in the project main directory:

```docker-compose up```

This will update all composer dependencies and start a web server on port 8888.
The only route that is implemented is:

```http://localhost:8888/lemma/some-id```

The 'some-id' must be a valid lemma ID. The first one is currently 'a.h1.2n'. You can also use wildcards to find out valid IDs. For example, '.../lemma/imbis*' will cause an exception, in which some valid IDs will be listed.

## Testing

One important issue in this project is testing with PHPUnit. All tests can be executed inside a Docker container.
In the project main directory, run the command:

```docker-compose run command php bin/phpunit --coverage-html=/app/var/log/coverage```

This will execute the command ```php bin/phpunit``` inside the container named 'command'. 
The --coverage-... part is optional and will generate HTML files with statistics on the test coverage in the <project-dir>/var/log/coverage/ directory.

## Used Composer commands (for future reference)

All the commands were executed inside a Docker container, like so:

```docker-compose run command composer require ...```

The commands:

```composer create-project symfony/skeleton symfony-test```

```composer require annotations```

```composer require twig```

```composer require profiler --dev```

```composer require solarium/solarium``` (^4.0.0-rc.1)

```composer require --dev symfony/phpunit-bridge```

```composer require --dev browser-kit```

```composer require --dev css-selector```
