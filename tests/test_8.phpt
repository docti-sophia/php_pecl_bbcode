--TEST--
BBCODE Advanced Test
--FILE--
<?php
if (!extension_loaded('bbcode')){
        if (!dl('bbcode.so')){
                die ('bbcode not loadable');
        }
}
$arrayBBCode=array(
    ''=>         array('type'=>BBCODE_TYPE_ROOT,  'childs'=>'!i'),
    'i'=>        array('type'=>BBCODE_TYPE_NOARG, 'open_tag'=>'<i>',
                    'close_tag'=>'</i>', 'childs'=>'b'),
    'url'=>      array('type'=>BBCODE_TYPE_OPTARG,
                    'open_tag'=>'<a href="{PARAM}">', 'close_tag'=>'</a>',
                    'default_arg'=>'{CONTENT}'
                    'childs'=>'bi'),
    'img'=>      array('type'=>BBCODE_TYPE_NOARG,
                    'open_tag'=>'<img src="', 'close_tag'=>'" />',
                    'childs'=>''),
    'b'=>        array('type'=>BBCODE_TYPE_NOARG, 'open_tag'=>'<b>',
                    'close_tag'=>'</b>'),
);
$text=<<<EOF
[b]Bold Text[/b]
[i]Italic Text[/i]
[url]http://www.php.net/[/url]
[url=http://pecl.php.net/][b]Content Text[/b][/url]
[img]http://static.php.net/www.php.net/images/php.gif[/img]
[url=http://www.php.net/]
[img]http://static.php.net/www.php.net/images/php.gif[/img]
[/url]
EOF;
$BBHandler=bbcode_create($arrayBBCode);
echo bbcode_parse($BBHandler,$text);
--EXPECT--
<b>Bold Text</b>
<i>Italic Text</i>
<a href="http://www.php.net/">http://www.php.net/</a>
<a href="http://pecl.php.net/"><b>Content Text</b></a>
<img src="http://static.php.net/www.php.net/images/php.gif" />
<a href="http://www.php.net/">
[img]http://static.php.net/www.php.net/images/php.gif[/img]
</a>
