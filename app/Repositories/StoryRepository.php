<?php

namespace Emutoday\Repositories;

use Emutoday\Repositories\Interfaces\IStoryRepository;
use Illuminate\Support\Facades\DB;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StoryRepository implements IStoryRepository{
    
    public function search($query = "") {
        return DB::table('storys')->paginate(10);
    }

}
