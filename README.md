# Ical

Want to create online calendars so that you can display them on an iPhone's calendar app or in Google Calendar? This can be done by generating calendars in the iCalendar format (RFC 5545), a textual format that can be loaded by different applications.

## Installation

Via Composer:

```bash
composer require micro-spaceless/ical
```

### Config
Publish the config to change the default settings :

```bash
php artisan vendor:publish --provider="MicroSpaceless\Providers\IcalServiceProvider" --tag=config
```

### Migrations

Package does not require any migrations


## Integration

## Usage

## Security

If you discover any security related issues, please email ed.arm.2000@gmail.com instead of using the issue tracker.
