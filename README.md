# Read Time - Craft CMS

An estimated read time Twig filter for Craft CMS.

This plugin counts the words in any field and returns the length of time it will take to read based on 200 (default) words per minute.

##Installation

1. Move the `readtime` directory to `craft/plugins` directory.
2. Install readtime under Craft Admin › Settings › Plugins.

##Usage
`{{ entry.field | readTime }}`

You can also specify the words per minute
`{{ entry.field | readTime(215) }}`

##License

This work is licenced under the MIT license.