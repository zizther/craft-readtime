# Read Time plugin for Craft CMS 3

Calculate the estimated read time for content.

## Installation

#### Requirements

This plugin requires Craft CMS 3.0.0, or later.

#### Composer

1. Open your terminal and go to your Craft project:

```bash
cd /path/to/project
```

2. Then tell Composer to load the plugin:

```bash
composer require zizther/craft-readtime
```

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Read Time.

## Configuration

The average user read speed is set at 200 words per minute by default, this can be changed in the plugin settings.

## Using the Filter

The `|readTime` filter returns an accurate value in minutes for how long it takes the average user to read the provided content. The value provided can be a string or an array of values.

## Usage
By default it will only output an int or float.
Any value < 1 will output a float, another > 1 will output a

```twig
{{ entry.field | readTime }}`

Returns: 0.38, 3, 12
```

You can also specify the identifier word to use. The plural word is automatic.
Any value < 1 will output with `< 1`, not a float.
```twig
{{ entry.field | readTime('min') }}

Returns: < 1 min, 1 min or 12 mins
```

You can also call it as a function
`{{ readTime(entry.fieldHandle, 'min') }}`

## Overriding Plugin Settings

If you create a [config file](https://docs.craftcms.com/v3/configuration.html) in your `config` folder called `read-time.php`, you can override the plugin’s settings in the Control Panel. Since that config file is fully [multi-environment](https://docs.craftcms.com/v3/configuration.html) aware, this is a handy way to have different settings across multiple environments.

Here’s what that config file might look like along with a list of all of the possible values you can override.

```php
<?php

return [
    'wordsPerMinute' => 200
];
```
