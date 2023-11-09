<?php

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\Chat\templates\tchat.latte */
final class Templated2a7b1b7c6 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\Chat\\templates\\tchat.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<div id="messages" style="width: 300px; height: 500px; border: 1px solid grey; overflow-y: auto">
';
		foreach ($messages as $message) /* line 2 */ {
			echo '        <span>';
			echo LR\Filters::escapeHtmlText($message . 'author') /* line 3 */;
			echo '</span> - ';
			echo LR\Filters::escapeHtmlText($message . 'content') /* line 3 */;
			echo '<br>
';

		}

		echo '</div>

<form>
    <input type="text" name="message" id="message" placeholder="Votre message"/>
    <input type="submit" value="envoyer"/>
    <p>Envoyer un message global : <code>Message</code></p>
    <p> Envoyer aux membres d\'un groupe : <code>/g GroupeName Message</code></p>
    <p>Envoyer à un User : <code>/u Username Message</code></p>
    <p>/groupe add GroupeName UserName</p>
</form>';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['message' => '2'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}
}
