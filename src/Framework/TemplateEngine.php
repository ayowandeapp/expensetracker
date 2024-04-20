<?php

declare(strict_types=1);

namespace Framework;

/*

output buffering - for storing content in memeory to prevent it from being sent to browser immediately



*/

class TemplateEngine
{
    private array $globalTemplateData = [];

    public function __construct(private string $basePath)
    {
    }
    public function render(string $template, array $data = [])
    {
        extract($data, EXTR_SKIP); //this will create individual variables for each array key name
        extract($this->globalTemplateData, EXTR_SKIP);

        ob_start(); //store content in an output buffer

        include $this->resolve($template); //show the page, the include as access to the $data array

        $output = ob_get_contents();

        ob_end_clean();

        echo ($output);

        // return $output;
    }

    public function resolve(string $path)
    {
        return "{$this->basePath}/{$path}";
    }

    public function addGlobal(string $key, mixed $value)
    {
        $this->globalTemplateData[$key] = $value;
    }
}
