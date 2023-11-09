<?php

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\Chat\public/../templates/home.latte */
final class Template59fc1c85b6 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\Chat\\public/../templates/home.latte';

	public const Blocks = [
		['title' => 'blockTitle', 'content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		echo "\n";
		$this->renderBlock('title', get_defined_vars()) /* line 3 */;
		echo '

';
		$this->renderBlock('content', get_defined_vars()) /* line 5 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		$this->parentName = '@layout.latte';
		return get_defined_vars();
	}


	/** {block title} on line 3 */
	public function blockTitle(array $ʟ_args): void
	{
		echo ' Home ';
	}


	/** {block content} on line 5 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '    <div>
        <h1>Bienvenue sur le TChat</h1>

';
		if (null === $user) /* line 9 */ {
			echo '
            <form action=\'/login\' method=\'POST\'>
                <label for="username">username :</label>
                <input type="text" name="username" id="username">
                <label for="pwd">Password :</label>
                <input type="password" name="pwd" id="pwd" value="Sup3rS3cret!">
                <input type="submit" value="login" >
            </form>
            <a href="/register">Create an account</a>

';
		} else /* line 20 */ {
			$this->createTemplate('tchat.latte', $this->params, 'include')->renderToContentType('html') /* line 21 */;
		}
		echo '

    </div>
';
	}
}
