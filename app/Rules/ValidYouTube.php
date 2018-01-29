<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidYouTube implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        //
        $rx = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?([^&]{11})?/";
        $match;
                                    
        if(preg_match($rx, $value, $match)){
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'رابط فيديو اليوتيوب ليس صحيحاً';
    }
}
