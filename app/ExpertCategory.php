<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

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

    /**
     * We need associations to be stored both ways (for example, if Astronomy relates to Physics, Physics must be related to Astronomy...so we make two records)
     */
    public function associationsOtherway()
	{
		return $this->belongsToMany('Emutoday\ExpertCategory', 'expertcategory_associations', 'assoc_id', 'cat_id');
	}

	public function addAssociation(ExpertCategory $category)
	{
		$this->associations()->attach($category->id);
        $this->associationsOtherway()->attach($category->id);
	}

	public function removeAssociation(ExpertCategory $category)
	{
		$this->associations()->detach($category->id);
        $this->associationsOtherway()->detach($category->id);
	}
}
