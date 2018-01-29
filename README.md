# Read Time - Craft CMS

An estimated read time Twig filter for Craft CMS.

This plugin counts the words in any field and returns the length of time it will take to read based on 200 (default) words per minute.
This plugin only outputs the result in minutes.

## Installation

1. Move the `readtime` directory to `craft/plugins` directory.
2. Install readtime under Craft Admin › Settings › Plugins.

## Usage
By default it will only output a int or float. If you require an identifier word, such as `min` or `minutes`, you can use the first param to do that.

`{{ entry.field | readTime }}`

Will output

`12`

You can also specify the identifier word to use. The plural word is automatic.
`{{ entry.field | readTime('min') }}`

Will output

`< 1 min`, `1 min` or `12 mins`

You can also specify the words per minute
`{{ entry.field | readTime('min', 215) }}`

## License

This work is licensed under the MIT license.
