# ODAM Fonts
### Adds legible fonts and background color selector to TwentySeventeen.

The name of this plugin is the name of the client that paid for having those functions in TwentySeventeen.

## Fonts
The plugin uses 4 Google Fonts: *Alegreya Sans*, *Atkinson Hyperlegible*, *Atkinson Hyperlegible Next*, *Atkinson Hyperlegible Mono* and *Lexend Deca*.
You can add your preferred fonts using a filter linke this:
```php
add_filter( 'odam-fonts' , function( $list ) {
	$list[] = 'Roboto';
	return $list;
});
```

## Loading font locally
This plugin works well with [Local Google Fonts](https://wordpress.org/plugins/local-google-fonts/) plugin.
