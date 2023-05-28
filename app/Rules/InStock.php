<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InStock implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $amount;
    protected $stock;

    public function __construct($amount, $stock)
    {
        $this->amount = $amount;
        $this->stock = $stock;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->amount <= $this->stock;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Jumlah tidak boleh melebihi stok';
    }
}
