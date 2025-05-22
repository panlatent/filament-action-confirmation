# Prompt the user to enter the specified text before performing sensitive operations.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/panlatent/filament-action-confirmation.svg?style=flat-square)](https://packagist.org/packages/panlatent/filament-action-confirmation)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/panlatent/filament-action-confirmation/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/panlatent/filament-action-confirmation/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/panlatent/filament-action-confirmation/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/panlatent/filament-action-confirmation/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/panlatent/filament-action-confirmation.svg?style=flat-square)](https://packagist.org/packages/panlatent/filament-action-confirmation)

Require users to perform input validation before executing an action.

## Installation

You can install the package via composer:

```bash
composer require panlatent/filament-action-confirmation
```

## Usage

Directly use the `DeleteAction` and other actions provided by the plugin.

```php
use Panlatent\Filament\ActionConfirmation\Tables\Actions\DeleteAction;

public static function table(Table $table): Table
{
    return $table
       ->actions([
             DeleteAction::make()
                    ->confirmInput('name'),
        ]));
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [panlatent](https://github.com/panlatent)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
