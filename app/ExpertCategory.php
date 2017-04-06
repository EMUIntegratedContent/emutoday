<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\ExpertCategory;

class ExpertCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expertscategory';

  protected $fillable = [
    'category',
  ];

    public function experts()
    {
      return $this->belongsToMany('Emutoday\Expert');
    }

    /**
     * Associations between categories can exist. For example, "Astronomy" can be related to "Physics" or "Space Science"
     */
    public function associations()
	{
		return $this->belongsToMany('Emutoday\ExpertCategory', 'expertcategory_associations', 'cat_id', 'assoc_id');
	}

	public function addAssociation(ExpertCategory $category)
	{
		$this->associations()->attach($category->id);
	}

	public function removeAssociation(ExpertCategory $category)
	{
		$this->associations()->detach($category->id);
	}
}
