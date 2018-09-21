<?php
namespace Emutoday\Today\Transformers;
use Emutoday\Expert;
use League\Fractal;
class FractalExpertTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Expert $expert)
    {
        return [
            'id'                        => (int) $expert->id,
            'display_name'              => $expert->display_name,
            'first_name'                => $expert->first_name,
            'last_name'                 => $expert->last_name,
            'title'                     => $expert->title,
            'biography'                 => $expert->biography,
            'teaser'                    => $expert->teaser,
            'is_community_speaker'      => $expert->is_community_speaker,
            'is_media_expert'           => $expert->is_media_expert,
            'do_print_interviews'       => $expert->do_print_interviews,
            'do_broadcast_interviews'   => $expert->do_broadcast_interviews,
            'office_phone'              => $expert->office_phone,
            'cell_phone'                => $expert->cell_phone,
            'email'                     => $expert->email,
            'is_approved'               => $expert->is_approved,
            'release_cell_phone'        => $expert->release_cell_phone,
            'submitter_name'            => $expert->submitter_name,
            'submitter_phone'           => $expert->submitter_phone,
            'submitter_email'           => $expert->submitter_email,
            'accept_policies'           => $expert->accept_policies,
            'categories'                => $expert->expertCategories()->select('category', 'id as value')->get(),
            'education'                 => $expert->education()->select('education', 'id as value')->get(),
            'expertise'                 => $expert->expertise()->select('expertise', 'id as value')->get(),
            'languages'                 => $expert->languages()->select('language', 'id as value')->get(),
            'social'                    => $expert->socialMediaLinks()->select('title', 'url', 'id as value')->get(),
            'titles'                    => $expert->previousTitles()->select('title', 'id as value')->get()
        ];
    }
}
