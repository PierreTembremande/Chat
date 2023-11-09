<?php

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\Chat\templates\@layout.latte */
final class Templateb6056fbbc9 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\Chat\\templates\\@layout.latte';

	public const Blocks = [
		['title' => 'blockTitle', 'content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<html>
    <head>
        <title>Mon TChat -  ';
		$this->renderBlock('title', get_defined_vars()) /* line 3 */;
		echo '</title>
    </head>

    <body>
';
		$this->renderBlock('content', get_defined_vars()) /* line 7 */;
		echo '    </body>

</html>';
	}


	/** {block title} on line 3 */
	public function blockTitle(array $ʟ_args): void
	{
		echo ' Home ';
	}


	/** {block content} on line 7 */
	public function blockContent(array $ʟ_args): void
	{
		echo "\n";
	}
}
