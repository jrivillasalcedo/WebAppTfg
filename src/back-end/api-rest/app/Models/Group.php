<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * 
 * @property int $idGroup
 * @property string $groupName
 * @property int $groupState
 * @property int|null $active
 * 
 * @property Collection|Class[] $classes
 *
 * @package App\Models
 */
class Group extends Model
{
	protected $table = 'groups';
	protected $primaryKey = 'idGroup';
	public $timestamps = false;

	protected $casts = [
		'groupState' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'groupName',
		'groupState',
		'active'
	];

	public function classes()
	{
		return $this->hasMany(Class::class, 'idGroup');
	}
}
