    protected function Response($name)
    {
        $ResponseTemplate = str_replace(
            [
                '{{a}}',
                '{{b}}',
                '{{c}}'
            ],
            [

            ],
            $this->getStub('Response')
        );

        file_put_contents(app_path("/Http/Responses/{$name}Response.php"), $ResponseTemplate);
    }