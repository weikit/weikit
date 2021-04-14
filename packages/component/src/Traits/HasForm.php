<?php


namespace Weikit\Component\Traits;

use Illuminate\Http\Request;
use Weikit\Component\Forms\Form;

trait HasForm
{
    private $form;

    public function validate(Request $request = null, $rules = null, $messages = [], $attributes = [])
    {
        if (is_null($request)) {
            $request = request();
        }

        [$rules, $messages, $attributes] = $this->providedOrGlobalRulesMessagesAndAttributes($rules, $messages, $attributes);

        return parent::validate($request, $rules, $messages, $attributes);
    }

    protected function providedOrGlobalRulesMessagesAndAttributes($rules, $messages, $attributes)
    {
        $rules = is_null($rules) ? $this->getRules() : $rules;
        $messages = empty($messages) ? $this->getMessages() : $messages;
        $attributes = empty($attributes) ? $this->getValidationAttributes() : $attributes;

        return [$rules, $messages, $attributes];
    }

    public function getRules()
    {
        $rules = $this->getForm()->getRules();

        return $rules;
    }

    public function getValidationAttributes(): array
    {
        $attributes = $this->getForm()->getValidationAttributes();

        return $attributes;
    }

    protected function getMessages(): array
    {
        if (method_exists($this, 'messages')) return $this->messages();
        if (property_exists($this, 'messages')) return $this->messages;

        return [];
    }

    public function getForm(): Form
    {
        if (!method_exists($this, 'form')) {
            throw new \Exception('Missing form method.');
        }

        if ($this->form === null) {
            $this->form = $this->form();
        }

        return $this->form;
    }
}
