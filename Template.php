<?php


final class Template {
	public function __construct(string $template, array $content = [], int $code = 200) {
		$this->template = $template;
		$this->content = $content;
		$this->code = $code;
	}

	public function resolve_template() {
		extract($this->content);
		require "../templates/{$this->template}";
	}
}