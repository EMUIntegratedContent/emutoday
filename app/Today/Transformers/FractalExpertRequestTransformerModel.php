<?php

namespace Emutoday\Today\Transformers;

use Emutoday\ExpertRequest;
use League\Fractal;

class FractalExpertRequestTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(ExpertRequest $expertRequest)
    {
        return [
            'id'                        => (int) $expertRequest->id,
            'name'                      => $expertRequest->name,
            'title'                     => $expertRequest->title,
            'media_outlet'              => $expertRequest->media_outlet,
            'city'                      => $expertRequest->city,
            'state'                     => $expertRequest->state,
            'phone'                     => $expertRequest->phone,
            'email'                     => $expertRequest->email,
            'deadline'                  => $expertRequest->deadline,
            'interview_type'            => $expertRequest->interview_type,
            'description'               => $expertRequest->description,
            'expert_id'                 => $expertRequest->expert()->select('last_name', 'first_name', 'id as value')->get(),
        ];
    }
}
