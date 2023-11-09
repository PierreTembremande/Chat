<?php

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\Chat\public/../templates/register.latte */
final class Templatec822261a22 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\Chat\\public/../templates/register.latte';

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
		echo ' Register ';
	}


	/** {block content} on line 5 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '    <div>
        <h1>Créer un compte sur le TChat</h1>

';
		if (isset($error)) /* line 9 */ {
			echo '        <p style="color:blue">';
			echo LR\Filters::escapeHtmlText($error) /* line 9 */;
			echo '</p>
';
		}
		echo '
        <form method="POST">
            <label for="username">Username :</label>
            <input type="text" name="username" id="username">
            <label for="pwd">Password :</label>
            <input type="password" name="pwd" id="pwd">
            <input type="submit" value="Username" >
        </form>

        <a href="/">Revenir à l\'accueil</a>
    </div>
';
	}
}
