<?php namespace Anomaly\SelectFieldType;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class SelectFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SelectFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var SelectFieldType
     */
    protected $object;

    /**
     * Return the currency symbol.
     *
     * @return string|null
     */
    public function symbol()
    {
        if (!$currency = $this->currency()) {
            return null;
        }

        return Arr::get($currency, 'symbol');
    }

    /**
     * Return the currency information.
     *
     * @return array|null
     */
    public function currency()
    {
        if (!$key = $this->key()) {
            return null;
        }

        return config('streams::currencies.supported.' . $key);
    }

    /**
     * Return the selection key.
     *
     * @return string|null
     */
    public function key()
    {
        return $this->object->getValue();
    }

    /**
     * Return the contextual human value.
     *
     * @return null|string
     */
    public function __print()
    {
        return $this->value();
    }

    /**
     * Return the selection value.
     *
     * @return string|null
     */
    public function value()
    {
        $options = $this->object->getOptions();

        if (($key = $this->object->getValue()) === null) {
            return null;
        }

        if (!Str::contains($value = Arr::get($options, $key), '::')) {
            return $value;
        }

        return trans($value);
    }
}
