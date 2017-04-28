<?php namespace NetForce\Framework\Model;


trait ValidatorModel
{
    public $validates = [];

    /**
     * Registrar eventos.
     */
    public static function bootValidatorModel()
    {
        // Validar
        self::saving(function ($model) {
            $model->validate();
        }, -100);
    }

    /**
     * Executar validacao no model.
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function validate()
    {
        // Event: before validate
        if ($this->fireModelEvent('validating') === false) {
            return false;
        }

        // Validar regras
        $this->validateRules();

        // Event: after validate
        $this->fireModelEvent('validated');

        return true;
    }

    protected function validateMakeRules()
    {
        //..
    }

    /**
     * Executar validacao no model.
     *
     * @throws \Exception
     *
     * @return bool
     */
    private function validateRules()
    {
        $this->validateMakeRules();

        // Verificar se foi definido alguma validacao
        if (count($this->validates) == 0) {
            return true;
        }

        // Carregar valores para validacao
        $values = $this->toArray();
        $values['table'] = $this->table;
        $values['collection'] = $this->collection;

        // Carregar lista de regras com as variaveis
        $rules = $this->getRules($values);

        // Processar regras
        $validator = app('validator')->make($values, $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $items = $messages->toArray();

            throw new ExceptionValidator(app('translator')->get('Erro ao validar campos.'), 1400, $items);
        }

        return true;
    }

    /**
     * Retorna lista de regras para validacao com variaveis.
     *
     * @param $values
     *
     * @return array
     */
    private function getRules($values)
    {
        $rules = $this->validates;
        $list = [];

        // Tratar variaveis da regra
        foreach ($rules as $field => $expr) {
            preg_match_all('/{([a-zA-Z0-9_]+)+}/', $expr, $vars, PREG_PATTERN_ORDER);
            foreach ($vars[1] as $i => $var_id) {
                $var_default = (preg_match('/^[0-9]+$/', $var_id)) ? sprintf('{%s}', $var_id) : 'null';
                $var_old = $vars[0][$i];
                $var_new = array_key_exists($var_id, $values) ? $values[$var_id] : $var_default;
                $expr = str_replace($var_old, $var_new, $expr);
            }

            $list[$field] = $expr;
        }

        return $list;
    }

    /**
     * Registra o evento validating no dispatcher do model.
     *
     * @param \Closure|string $callback
     *
     * @return void
     */
    public static function validating($callback)
    {
        static::registerModelEvent('validating', $callback);
    }

    /**
     * Registra o evento validating no dispatcher do model.
     *
     * @param  \Closure|string $callback
     *
     * @return void
     */
    public static function validated($callback)
    {
        static::registerModelEvent('validated', $callback);
    }
}