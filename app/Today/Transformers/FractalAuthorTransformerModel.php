<?php

namespace Emutoday\Today\Transformers;

use Emutoday\Author;
use League\Fractal;

class FractalAuthorTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Author $author)
    {
        return [
            'id'          => (int) $author->id,
            'first_name'  => $author->first_name,
            'last_name'   => $author->last_name,
            'email'       => $author->email,
            'phone'       => $author->phone,
            'is_contact'  => $author->is_contact,
            'is_principal_contact' => $author->is_principal_contact,
            'is_principal_magazine_contact' => $author->is_principal_magazine_contact,
            'user_id' => $author->user_id,
						'hidden' => $author->hidden
        ];
    }
}
